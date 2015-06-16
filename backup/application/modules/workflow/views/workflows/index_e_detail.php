	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i><?php echo $this->uri->segment(2); ?></h4> 					
				</div>
				<div class="box-body">
					<!-- demo -->		           
					<button id="saveButton" class="btn btn-m btn-info pull-right">Save</button>
					
					<div class="demo statemachine-demo" id="statemachine-demo">
		            <?php		                
		                foreach ($data as $key => $value) {
		                	echo '
		                	<div  class="w" id="c'.$value->id.'" >
		                	<img  width="90px"  src="'.base_url('assets/uml/').'/'.$value->icons.'" />
		                	<br/><a href="#">'.$value->name.'</a><br/>
		                	<a id="form_edit" data-id="'.$value->id.'" data-caption="'.$value->caption.'" data-code="'.$value->code.'" data-name="'.$value->name.'" data-descr="'.$value->descr.'" href="#box-edit" data-toggle="modal" class="btn btn-info btn-xs" ><i class="fa fa-pencil"></i></a>		                	
		                	<button class="btn btn-danger btn-xs" data-id="'.$value->id.'" onclick="delete_row(this);"><i class="fa fa-trash-o"></i></button>
		                	
		                	';
		                	
		                	echo '<div class="ep"></div></div>';
		                	
		                }
		                ?>		                                      
		            </div>
				</div>
				
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
	</div>
</div>
<!-- /Modal Box -->
<div class="modal fade" id="box-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Form Edited</h4>
			</div>
			<form class="form-horizontal row-border"  method="post" id="form_edit_node">
			<div class="modal-body">	
				<form class="form-horizontal row-border"  method="post" id="form">					
					<div class="form-group">
						<label class="col-md-2 control-label">Code:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="code" id="code" class="form-control" placeholder="Code" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Name:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="name" id="name" class="form-control" placeholder="Name" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Caption:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="caption" id="caption" class="form-control" placeholder="Caption" />
						</div>
					</div>
					<div class="form-group">
							<label class="col-md-2 control-label">Description:</label> 
							<div class="col-md-6">
								<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"></textarea>
							</div>
						</div>	
					<input type="hidden" name="id" id="id" value="">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" onclick="edit_row(this);" class="btn btn-primary">Save changes</button>
				
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
$(document).on("click", "#form_edit", function () {
	var id = $(this).data('id');
	var code = $(this).data('code');
	var caption = $(this).data('caption');
	var name = $(this).data('name');
	var descr = $(this).data('descr');
    $(".modal-body #id").val(id);
    $(".modal-body #code").val(code);
    $(".modal-body #caption").val(caption);
    $(".modal-body #name").val(name);
    $(".modal-body #descr").text(descr);
});
function delete_row(btn){
	var id = $(btn).attr('data-id');
	$.ajax({
	  	url: "<?php echo site_url('workflow/ajax/delete'); ?>",
	  	type:"POST",
	  	data: {data_id:id},
		success: function(data ) {				    
			window.location.reload();
		}
	});
}
function edit_row(){
	$.ajax({
	  	url: "<?php echo site_url('workflow/ajax/edit'); ?>",
	  	type:"POST",
	  	data: $("#form_edit_node").serialize(),
		success: function(data) {				    
			window.location.reload();
			//document.getElementById("form_edit_node").reset();
			$("#form_edit_node")[0].reset();
		}
	});
}
function execute(type){
	switch(type){
		case 'edit':
			$.ajax({
	  			url: "<?php echo site_url('workflow/workflow/push_con_update'); ?>",
	  			type:"POST",
	  			data: $("#form_edit_act").serialize(),
				success: function(data) {				    
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
		case 12:
			//var code = $("#code").val();
			var id = $(this).data('id');	
			//var id = $(type).attr('data-id');

			alert(id);
			/*$.ajax({
	  			url: "<?php echo site_url('workflow/workflow/push_con_del'); ?>",
	  			type:"POST",
	  			data: {code:code},
				success: function(data ) {				    
					window.location.reload();
				}
			});*/
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
	  				url: "<?php echo site_url('workflow/ajax/push_dragble'); ?>",
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
			$s = $this->db->query('select code,name from tr_wf where id="'.$value->from_id.'"')->row();
			$t = $this->db->query('select code,name from tr_wf where id="'.$value->to_id.'"')->row();
		?>
			instance.connect({
				source:"c<?php echo $value->from_id; ?>",
				target:"c<?php echo $value->to_id; ?>",
				overlays : [
					["Label", {													   					
						//cssClass:"l1 component label",
						
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
