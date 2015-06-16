	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i><?php 
					
					$l = $this->uri->segment(4);
					
					$ref = $this->db->query("select name from tr_wf_reff where id = '".$l."'")->row();
					echo $ref->name;
					//echo $f;
					 ?></h4> 					
				</div>
				<div class="box-body">
					<!-- demo -->		           
					<button id="saveButton" class="btn btn-m btn-info pull-right">Save</button>
					<div class="demo statemachine-demo" id="statemachine-demo">
		                
		                <?php 
		                //print_r($count_par);
		                //print_r($data);
		                foreach ($data as $key => $value) {
		                	# code...
		                	
		                	echo '<div  class="w" id="c'.$value->id.'" ><a href="'.site_url('setup/atype/form_child/').'/'.$value->type_id.'/'.$value->id.'">'.$value->code." - ".$value->name.'</a><br/><br/>';
		                	$count_par = $this->db->query('select count(*) as jums from tr_wf_reff where parent_id="'.$value->id.'"')->row();
		                	//print_r($count_par);
		                	if($count_par->jums > 0){
		                		echo '<a title="Show Data List '.$type->name." ".$value->name.' " href="'.site_url('setup/atype/child').'/'.$value->type_id.'/'.$value->id.'"" ><i class="fa fa-list-ol"></i> </a>';
		                		echo '<a title="Show Work Flow '.$type->name." ".$value->name.' " href="'.site_url('setup/atype/widget_a').'/'.$value->type_id.'/'.$value->id.'""  ><i class="fa fa-sitemap"></i> </a>';
		                	}
		                	echo '<div class="ep"></div></div>';
		                	
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
	            [ "Label", { label:"Connect", id:"label", cssClass:"aLabel" }]
			],
			Container:"statemachine-demo"
		});

		var windows = instance.getSelector(".statemachine-demo .w");
		instance.draggable(instance.getSelector(".statemachine-demo .w"), { 
			/*start:function(event, ui){ 
				alert("obj: " + ui.helper.attr('id') + "\npos: " + ui.position.top + " , " + ui.position.left + "\noff: " +  ui.offset.top + " , " + ui.offset.left );
			},*/
			stop:function(event, ui){ 				
				var idx = ui.helper.attr('id');        		
				idx = idx.replace("c", "");
				
				$.ajax({
	  				url: "<?php echo site_url('setup/atype/push_dragble'); ?>",
	  				type:"POST",
	  				data: {
	    				p_left: ui.position.left,
	    				p_top: ui.position.top,
	    				id: idx,
	  				},
					success: function(data ) {				    	
					
					}
				});
				//alert("obj: " + ui.helper.attr('id') + "\npos: top" + ui.position.top + " ,left " + ui.position.left + "\noff: " +  ui.offset.top + " , " + ui.offset.left ); 
			}
		});		
		instance.bind("click", function(c) { 
			
			var r = confirm('Your Delete Connection');
			if(r == true){
				instance.detach(c); 						
				//console.log(c.sourceId+c.targetId);
				var gj = c.sourceId+c.targetId;
				$.ajax({
	  				url: "<?php echo site_url('setup/atype/push_con_del'); ?>",
	  				type:"POST",
	  				data: {
	    				code : gj	    				
	  				},
					success: function(data ) {				    
					}
				});
			}else{

			}
			
		});
		instance.bind("connection", function(info, originalEvent) {
			//info.connection.getOverlay("label").setLabel(info.connection.id);
			//info.connection.getOverlay("label").setLabel(info.connection.sourceId + "-" + info.connection.targetId);
			info.connection.getOverlay("label").setLabel('');
			console.log(info.connection);
			//info.connection.sourceId.substring(6) + "-" + info.connection.targetId.substring(6)
		});
		instance.bind("connectionDetached", function(info, originalEvent) {
			//updateConnections(info.connection, true);
			
		});
		instance.bind("connectionMoved", function(info, originalEvent) {
			//updateConnections(info.connection, true);

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
			//alert('test');
		});
		<?php 
		foreach ($cnt as $key => $value) {
			//foreach ( as $key => $value) {
			$s = $this->db->query('select code,name from tr_wf_reff where id="'.$value->from_id.'"')->row();
			$t = $this->db->query('select code,name from tr_wf_reff where id="'.$value->to_id.'"')->row();
		?>
			instance.connect({
				source:"c<?php echo $value->from_id; ?>",
				target:"c<?php echo $value->to_id; ?>",
				//detachable:false
				//econnector:[ "Bezier", { curviness:100 }, common ],
				overlays : [
					["Label", {													   					
						//cssClass:"l1 component label",
						label : "<br><br>"+"<a href='<?php echo site_url('setup/sstype/connector').'/c'.$value->from_id.'c'.$value->to_id; ?>' > <?php echo $s->code." ".$t->code;?></a>", 
						//location:0.7,
						//id:"label",
						/*events:{
							"click":function(label, evt) {
								alert("clicked on label for connection " + label.component.id);
							}
						}*/
					}],
				],
				endpoint:[ "Image", { src:"http://morrisonpitt.com/jsPlumb/img/endpointTest1.png" } ],
			});
	
		<?php
		}?>
		$('#saveButton').click(function(){
			alert('Connection Created');
			$.each(instance.getConnections(),function (idx, connection) {
        		var str_one = connection.sourceId;
        		var str_two = connection.targetId;
				str_one = str_one.replace("c", "");
				str_two = str_two.replace("c", "");
			
   				//console.log(connection.sourceId+" "+connection.targetId);
   				$.ajax({
	  			url: "<?php echo site_url('setup/atype/push'); ?>",
	  			type:"POST",
	  			data: {
	    			source: str_one,
	    			target: str_two,
	    			code : connection.sourceId+connection.targetId,
	    			type : '<?php echo $l;?>'
	  			},
				success: function(data ) {
				    //console.log(data);
				}
				});
				
    		});
			
		});
		jsPlumb.fire("jsPlumbDemoLoaded", instance);

});

</script>

