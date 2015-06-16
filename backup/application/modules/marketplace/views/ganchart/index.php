	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Test Ganchart</h4> 					
				</div>
				<div class="box-body">
					<input type="radio" id="scale1" name="scale" value="1" checked /><label for="scale1" >Day scale</label>	
<input type="radio" id="scale2" name="scale" value="2" /><label for="scale2"> Week scale</label>
<input type="radio" id="scale3" name="scale" value="3" /><label for="scale3"> Month scale</label>
<input type="radio" id="scale4" name="scale" value="4" /><label for="scale4"> Year scale</label>

					<div id="gantt_here" style='width:100%; height:700px;'></div>
					<script type="text/javascript">
    					function setScaleConfig(value){
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

	setScaleConfig('1');

    					gantt.config.xml_date = "%Y-%m-%d %H:%i:%s"+30;
						gantt.init("gantt_here");
						gantt.load("<?php echo site_url().'/widget/ganchart/store';?>", "json");
						var dp = new dataProcessor("<?php echo site_url().'/widget/ganchart/store';?>");
						dp.init(gantt);
						dp.action_param = "dhx_editor_status";
						var func = function(e) {
		e = e || window.event;
		var el = e.target || e.srcElement;
		var value = el.value;
		setScaleConfig(value);
		gantt.render();
	};

	var els = document.getElementsByName("scale");
	for (var i = 0; i < els.length; i++) {
		els[i].onclick = func;
	}


					</script>
				</div>
				
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
		
	
	</div>
</div>
