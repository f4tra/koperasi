var base_url = 'http://localhost/jeffresource/';
var i = new Date;
    n = i.getDate();
    o = i.getMonth();
    a = i.getFullYear();

function calender(param){
	$('#external-events .external-event').each(function(){
		var eventObject = {
			title: $.trim($(this).text()),		
		};
		$(this).data('eventObject', eventObject);
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
	});
    $("#calendar").fullCalendar({
    	defaultView: 'year',
    	header: {
        	left: "prev,next, prevYear,nextYear, today",
            center: "title",
            right: "year,month,agendaWeek,agendaDay"
        },
        firstDay: 0,
       	droppable: true, // this allows things to be dropped onto the calendar !!!
		drop: function(date, t) { 
			var originalEventObject = $(this).data('eventObject');
			var copiedEventObject = $.extend({}, originalEventObject);
			copiedEventObject.start = $.fullCalendar.formatDate(date, "yyyy-MM-dd HH:mm:ss");
			copiedEventObject.end = $.fullCalendar.formatDate(date, "yyyy-MM-dd HH:mm:ss");;
			$.ajax({
				url: base_url+'schedule/calender/save_event/',
				type: "POST",
				dataType:"json",
				data: {name:originalEventObject.title,start_date:copiedEventObject.start,end_date:copiedEventObject.end},				
				success:function(data){					
					copiedEventObject.id = data.id;
				}
			});
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			$(this).remove();				
		},		         
        editable: true,
        durationEditable: true,
        events: {
        	url: base_url+'schedule/calender/load_event/'+param+"/",
        	cache: true
        },
        eventDrop: function(event, delta, revertFunc) {
        	var originalEventObject = $(this).data('eventObject');
			var copiedEventObject = $.extend({}, originalEventObject);
        	var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
	   		var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
        	$.ajax({
				url: base_url+'schedule/calender/update_event',
				type: "POST",
				dataType:"json",
				data: {id:event.id,start_date:start,end_date:end},				
				success:function(data){
					copiedEventObject.id = data.id;			
				},
				error: function(){
				
				}
			});
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
		},
		eventResize: function(event) {
			var originalEventObject = $(this).data('eventObject');
			var copiedEventObject = $.extend({}, originalEventObject);
	   		var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
	   		var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
	   		//console.debug(end);
	   		$.ajax({
				url: base_url+'schedule/calender/update_event',
				type: "POST",
				dataType:"json",
				data: {id:event.id,start_date:start,end_date:end},				
				success:function(data){
					copiedEventObject.id = data.id;					
				},				
			});
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			}
    });	
}
function gantchart(params){
	function filters(value){
    	switch (value) {
    		case "1":
		        gantt.config.scale_unit = "day";
		        gantt.config.step = 1;
		        gantt.config.date_scale = "%d %M";
		        gantt.config.subscales = [];
		        gantt.config.scale_height = 27;
		        gantt.templates.date_scale = null;
		        break;
    		case "2":
        		var weekScaleTemplate = function(date){
          			var dateToStr = gantt.date.date_to_str("%d %M");
          			var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
          			return dateToStr(date) + " - " + dateToStr(endDate);
        		};
		        gantt.config.scale_unit = "week";
        		gantt.config.step = 1;
        		gantt.templates.date_scale = weekScaleTemplate;
        		gantt.config.subscales = [
          			{unit:"day", step:1, date:"%D" }
        		];
        		gantt.config.scale_height = 50;
        		break;
      		case "3":
		        gantt.config.scale_unit = "month";
		        gantt.config.date_scale = "%F, %Y";
		        gantt.config.subscales = [
		          {unit:"day", step:1, date:"%j, %D" }
		        ];
		        gantt.config.scale_height = 50;
		        gantt.templates.date_scale = null;
		        break;
     		case "4":
		        gantt.config.scale_unit = "year";
		        gantt.config.step = 1;
		        gantt.config.date_scale = "%Y";
		        gantt.config.min_column_width = 50;
		        gantt.config.scale_height = 90;
		        gantt.templates.date_scale = null;
		        var monthScaleTemplate = function(date){
		          var dateToStr = gantt.date.date_to_str("%M");
		          var endDate = gantt.date.add(date, 2, "month");
		          return dateToStr(date) + " - " + dateToStr(endDate);
		        };
        		gantt.config.subscales = [
          			{unit:"month", step:3, template:monthScaleTemplate},
          			{unit:"month", step:1, date:"%M" }
        		];
        		break;
    	}
  	}
	function dates(date){
  		var s = new Date(date);
  		return s.getFullYear()+"-"+("0" + (s.getMonth() + 1)).slice(-2)+"-"+s.getDate();
	}
	gantt.attachEvent("onAfterTaskAdd", function(id,item){
  		$.ajax({
    		url: base_url+'schedule/ganttchart/save/'+params,
    		type: "POST",
    		dataType:"json",
    		data:{
		        id:id,
		        start_date:dates(item.start_date),
		        end_date:dates(item.end_date),
		        text:item.text,
		        duration:item.duration,
		        parent:item.parent,
      		},       
		    success:function(data){
		    
		    },
		    error: function(){
		    }
		});
	});
	gantt.attachEvent("onAfterTaskUpdate", function(id,item){
  		$.ajax({
		    url: base_url+'schedule/ganttchart/update/'+params,
		    type: "POST",
		    dataType:"json",
		    data: {
		        id:id,
		        start_date:dates(item.start_date),
		        end_date:dates(item.end_date),
		        text:item.text,
		        duration:item.duration,
		        parent:item.parent,
		      },       
		    success:function(data){
		    
		    },
		    error: function(){
		    }
		});
	});
	gantt.attachEvent("onAfterTaskDelete", function(id,item){
	    $.ajax({
		    url: base_url+'schedule/ganttchart/delete/'+params,
		    type: "POST",
		    dataType:"json",
		    data: {
		    	id:id,
		    	start_date:dates(item.start_date),
		    	end_date:dates(item.end_date),
		    	text:item.text,
		    	duration:item.duration,
		    	parent:item.parent,
		    },       
		    success:function(data){
		    
		    },
		   
		});
	});
	gantt.attachEvent("onAfterLinkAdd", function(id,item){
    	//any custom logic here
    	alert('after link add id='+id)
	});
	gantt.attachEvent("onAfterLinkDelete", function(id,item){
	    //any custom logic here
	    alert('after link update id='+id)
	});
	filters('2');
	gantt.config.xml_date = "%Y-%m-%d %H:%i:%s"+30;
	gantt.init("gantt_here");
	data = base_url+'schedule/ganttchart/load/'+params;
	gantt.load(data,'json');
	var func = function(e) {
  		e = e || window.event;
  		var el = e.target || e.srcElement;
  		var value = el.value;
    	filters(value);
    	gantt.render();
	};
	var els = document.getElementsByName("scale");
	for (var i = 0; i < els.length; i++) {
	  els[i].onclick = func;
	}
}
/*************************************************************************************************************/
//call function calender

