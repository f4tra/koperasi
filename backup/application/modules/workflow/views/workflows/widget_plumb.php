	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i><?php
					/*$f = $this->uri->segment(4);
					$l = $this->uri->segment(5);
					$h = $this->db->query("select name from tr_wf_type where id = '".$f."'")->row();
					echo $h->name." "; 
					$ref = $this->db->query("select name from tr_wf_reff where id = '".$l."'")->row();
					echo $ref->name;*/
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
		                	
		                	echo '
		                	<div  class="w" id="c'.$value->id.'" >
		                	<img  width="50%" height="50%" src="'.base_url('assets/uml/Actor.svg').'" >
		                	<br/><a href="'.site_url('setup/atype/form_child/').'/'.$value->type_id.'/'.$value->id.'">'.$value->code." - ".$value->name.'</a><br/><br/>';
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
               
            </div>
			<!-- /demo -->
				</div>
				
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
		
<div class="modal fade" id="box-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Form Edited</h4>
			</div>
			<form class="form-horizontal row-border"  method="post" id="form_edit_act">
			<div class="modal-body">	
				<div class="form-group">
					<label class="col-md-2 control-label">Code:</label> 
					<div class="col-md-4">
						<input type="text" class="form-control" disabled="disabled" name="code" id="code" >
						<input type="hidden" class="form-control" name="code" id="code" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Name:</label> 
					<div class="col-md-4">
						<input type="text" class="form-control"  name="name" id="name" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Description:</label> 
					<div class="col-md-4">
						<textarea id="descr" name="descr" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" onclick="execute('edit');" class="btn btn-primary">Save changes</button>
				<button type="button" onclick="execute('delete');" class="btn btn-danger pull-left">Delete</button>
			</div>
			</form>
		</div>
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
function execute(type){
	switch(type){
		case 'edit':
			$.ajax({
	  			url: "<?php echo site_url('workflow/workflow/push_con_update'); ?>",
	  			type:"POST",
	  			data: $("#form_edit_act").serialize(),
				success: function(data ) {				    
					window.location.reload();				
				}
			});
		break;
		case 'delete':
			var code = $("#code").val();
			//alert(code);
			$.ajax({
	  			url: "<?php echo site_url('workflow/workflow/push_con_del'); ?>",
	  			type:"POST",
	  			data: {code:code},
				success: function(data ) {				    
					window.location.reload();
				}
			});
		break;
		default:
			alert('not method')
		break;
	}	
}

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
	  				url: "<?php echo site_url('workflow/workflow/push_dragble'); ?>",
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
		$(document).on("click", "#form_edit", function () {
			var code = $(this).data('code');
			var name = $(this).data('name');
			var descr = $(this).data('descr');
     	    $(".modal-body #code").val(code);
     	    $(".modal-body #name").val(name);
     	    $(".modal-body textarea#descr").val(descr);
     		//alert(code);
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
				overlays : [
					["Label", {													   					
						//cssClass:"l1 component label",
						//label : "<br><br>"+"<a href='<?php echo site_url('setup/atype/connector').'/c'.$value->from_id.'c'.$value->to_id; ?>' > <?php echo $s->code." ".$t->code;?></a>", 
						//label : "Details", 
						label : "<a data-descr='<?php echo $value->descr;?>' data-name='<?php echo $value->name;?>' data-code='<?php echo $value->code;?>' href='#box-config' data-toggle='modal' class='btn btn-primary' id='form_edit'><i class='fa fa-pencil'></i> Details</a>", 
						location: 0.7,
					}],
				],
				//endpoint:[ "Image", { src:"http://morrisonpitt.com/jsPlumb/img/endpointTest1.png" } ],
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
	  			url: "<?php echo site_url('workflow/workflow/push'); ?>",
	  			type:"POST",
	  			data: {
	    			source: str_one,
	    			target: str_two,
	    			code : connection.sourceId+connection.targetId,
	    			type : '<?php //echo $l;?>'
	  			},
				success: function(data ) {
				    window.location.reload();
				}
				});
				
    		});
			
		});
		jsPlumb.fire("jsPlumbDemoLoaded", instance);

});

</script>

