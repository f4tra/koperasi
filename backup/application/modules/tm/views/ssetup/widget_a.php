	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Chart Connection</h4> 					
				</div>
				<div class="box-body">
					<!-- demo -->		           
					<button id="saveButton" class="button menu_button">Save</button>
					<div class="demo statemachine-demo" id="statemachine-demo">
		                <?php foreach ($data as $key => $value) {
		                	# code...
		                	echo '<div  class="w" id="c'.$value->id.'" >'.$value->name.'<div class="ep"></div></div>';
		                }
		                ?>		                                      
		            </div>
                <div id="list"></div>
            </div>
			<!-- /demo -->
				</div>
				
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
		
	
	</div>
</div>
<style type="text/css">
	<?php
		foreach ($data as $key => $value) {
			echo "#c".$value->id."{left:".$value->p_left."em;top:".$value->p_top."em;width:".$value->p_width."em;}";
		}
	?>
</style>
<script type="text/javascript">
jsPlumb.ready(function() {
	
	var instance = jsPlumb.getInstance({
			DragOptions : { cursor: 'pointer', zIndex:2000 },
			Endpoint : ["Dot", {radius:2}],
			HoverPaintStyle : {strokeStyle:"#1e8151", lineWidth:2 },
			ConnectionOverlays : [
				[ "Arrow", { 
					location:1,
					id:"arrow",
	                length:14,
	                foldback:0.8
				} ],
	            [ "Label", { label:"FOO", id:"label", cssClass:"aLabel" }]
			],
			Container:"statemachine-demo"
		});

	var windows = jsPlumb.getSelector(".statemachine-demo .w");
	instance.draggable(windows);
		instance.bind("click", function(c) { 
			instance.detach(c); 		
			alert('ini adalah function delete id conn')
		});
		instance.bind("connection", function(info, originalEvent) {
			//updateConnections(info.connection);
			info.connection.getOverlay("label").setLabel(info.connection.id);
			
		});
		instance.bind("connectionDetached", function(info, originalEvent) {
			updateConnections(info.connection, true);
			
		});
		instance.bind("connectionMoved", function(info, originalEvent) {
			updateConnections(info.connection, true);
		});
		// suspend drawing and initialise.
		instance.doWhileSuspended(function() {
			var isFilterSupported = instance.isDragFilterSupported();
			if (isFilterSupported) {
				instance.makeSource(windows, {
					filter:".ep",
					anchor:"Continuous",
					connector:[ "StateMachine", { curviness:20 } ],
					connectorStyle:{ strokeStyle:"#5c96bc", lineWidth:2, outlineColor:"transparent", outlineWidth:4 },
					maxConnections:5,
					onMaxConnections:function(info, e) {
						alert("Maximum connections (" + info.maxConnections + ") reached");
					}
				});
			}
			else {
				var eps = jsPlumb.getSelector(".ep");
				for (var i = 0; i < eps.length; i++) {
					var e = eps[i], p = e.parentNode;
					instance.makeSource(e, {
						parent:p,
						anchor:"Continuous",
						connector:[ "StateMachine", { curviness:20 } ],
						connectorStyle:{ strokeStyle:"#5c96bc",lineWidth:2, outlineColor:"transparent", outlineWidth:4 },
						maxConnections:5,
						onMaxConnections:function(info, e) {
							alert("Maximum connections (" + info.maxConnections + ") reached");
						}
					});
				}
			}		

		});

		// initialise all '.w' elements as connection targets.
		instance.makeTarget(windows, {
			dropOptions:{ hoverClass:"dragHover" },
			anchor:"Continuous"	
		});
		<?php 
		foreach ($cnt as $key => $value) {
		?>
			instance.connect({ source:"c<?php echo $value->from_id; ?>", target:"c<?php echo $value->to_id; ?>"});
		
		<?php
		}?>
		$('#saveButton').click(function(){
			alert('Connection Created');
			$.each(instance.getConnections(),function (idx, connection) {
        		var str_one = connection.sourceId;
        		var str_two = connection.targetId;
				str_one = str_one.replace("c", "");
				str_two = str_two.replace("c", "");
			
   				console.log(connection.sourceId+" "+connection.targetId);
   				$.ajax({
	  			url: "<?php echo site_url('tm/ssetup/push'); ?>",
	  			type:"POST",
	  			data: {
	    			source: str_one,
	    			target: str_two,
	  			},
				success: function(data ) {
				    console.log(data);
				}
				});
				
    		});
			
		});
		jsPlumb.fire("jsPlumbDemoLoaded", instance);

});

</script>

