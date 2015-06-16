<!-- CALENDAR -->
						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border">
									<div class="box-title">
										<h4><i class="fa fa-calendar"></i>Calendar</h4>
										<div class="tools">
											<a href="#box-config" data-toggle="modal" class="config">
												<i class="fa fa-cog"></i>
											</a>
											<a href="javascript:;" class="reload">
												<i class="fa fa-refresh"></i>
											</a>
											<a href="javascript:;" class="collapse">
												<i class="fa fa-chevron-up"></i>
											</a>
											<a href="javascript:;" class="remove">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-md-3">
												<div class="input-group">
													 <input type="text" value="" class="form-control" placeholder="Event Event Title..." id="event-title" />
													 <span class="input-group-btn">
														<a href="javascript:;" id="add-event" class="btn btn-success">Add Event</a>
													 </span>
											    </div>
												<div class="divide-20"></div>
												<div id='external-events'>
													<h4>Draggable Events</h4>
													<div id="event-box">
														<?php 
														/*foreach ($event_data as $key => $value) {
															print  "<div class='external-event' data-id=".$value->id.">".$value->name."</div>";
															# code...
														}*/
														?>														
													</div>
													<!--<p>
													<input type='checkbox' id='drop-remove' class="uniform" /> <label for='drop-remove'>remove after drop</label>
													</p>-->
												</div>
											</div>
											<div class="col-md-9">
												<div id='calendar'></div>
											</div>
										</div>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
						<!-- /CALENDAR -->
<script type="text/javascript">

$('#external-events .external-event').each(function(){
	// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
	// it doesn't need to have a start or end
	var eventObject = {
		title: $.trim($(this).text()), // use the element's text as the event title
		//ids: $.trim($('.external-event').val('data-id')) // use the element's text as the event title
	};
	//alert(eventObject.data_id);
	// store the Event Object in the DOM element so we can get to it later
	$(this).data('eventObject', eventObject);
		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
});
var i = new Date;
    n = i.getDate();
    o = i.getMonth();
    a = i.getFullYear();
    $("#calendar").fullCalendar({
    	header: {
        	left: "prev,next today",
            center: "title",
            right: "month,agendaWeek,agendaDay"
        },
       	droppable: true, // this allows things to be dropped onto the calendar !!!
		drop: function(date, t) { 
			var originalEventObject = $(this).data('eventObject');
			var copiedEventObject = $.extend({}, originalEventObject);
			copiedEventObject.start = date;
			copiedEventObject.end = date;
			$.ajax({
				url: '<?php echo base_url();?>index.php/widget/calender/save_event',
				type: "POST",
				dataType:"json",
				data: {name:originalEventObject.title,start_date:copiedEventObject.start,end_date:copiedEventObject.end},				
				success:function(data){
					//alert(data.id);
					copiedEventObject.id = data.id;
				},
				error: function(){
				
				}
			});
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			$(this).remove();				
		},
        selectable: true,
		selectHelper: true,  		
   		select: function(start, end, allDay) {
   			var title = prompt('Event Title:');   			
   			if(title){   				
   				var start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
   				var end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
   				$.ajax({
					url: '<?php echo base_url();?>index.php/widget/calender/save_event',
					type: "POST",
					dataType:"json",
					data: {name:title,start_date:start,end_date:end},				
					success:function(data){
						//alert('success');
						//copiedEventObject.id = data.id;

					},
					error: function(){
					
					}
				});
				$('#calendar').fullCalendar('renderEvent',{
   					title: title,
   					start: start,
   					end: end
   				} , true);
   			
   				
   			}
   			//calendar.fullCalendar('unselect');
   		},           
        editable: true,
        durationEditable: true,
        events: {
        	url: "<?php echo site_url().'widget/calender/load_event'?>",
        	cache: true
        },
        eventDrop: function(event, delta, revertFunc) {
        	$.ajax({
				url: '<?php echo base_url();?>index.php/widget/calender/update_event',
				type: "POST",
				dataType:"json",
				data: {id:event.id,start_date:event.start,end_date:event.end},				
				success:function(data){
										
				},
				error: function(){
				
				}
			});
		},
		eventResize: function(event) {
	   		var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
	   		var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
	   		$.ajax({
				url: '<?php echo base_url();?>index.php/widget/calender/update_event',
				type: "POST",
				dataType:"json",
				data: {id:event.id,start_date:event.start,end_date:event.end},				
				success:function(data){
										
				},
				error: function(){
				
				}
			});
		} 
    
    });
</script>
