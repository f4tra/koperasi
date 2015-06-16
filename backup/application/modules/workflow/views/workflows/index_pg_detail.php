<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i><?php //echo $this->uri->segment(2); ?></h4> 					
				</div>
					
				<div class="box-body" id="dropzone" >
					<!-- demo -->		           
					<button id="saveButton" class="btn btn-m btn-info pull-right">Save</button>
					
					<div class="demo statemachine-demo" id="statemachine-demo">
		            <?php		                
		                foreach ($data as $key => $value) {
		            ?>
		                <div  class="w" id="c<?php echo $value->id; ?>">
		                <a id="form_edit"
		                	data-id="<?php echo $value->id; ?>"
		                	data-caption="<?php echo $value->caption; ?>"
		                	data-code="<?php echo $value->code; ?>"
		                	data-name="<?php echo $value->name; ?>"
		                	data-descr="<?php echo $value->descr; ?>"
		                	data-a="<?php echo $value->parameter_a; ?>"
		                	data-b="<?php echo $value->parameter_b; ?>"
		                	data-c="<?php echo $value->parameter_c; ?>"
		                	data-d="<?php echo $value->parameter_d; ?>"
		                	data-e="<?php echo $value->parameter_e; ?>"
		                	href="#box-edit" 
		                	data-toggle="modal"
		                	class="btn btn-warning btn-xs" ><i class="fa fa-pencil"></i>
		                </a>		                	
		                <button class="btn btn-danger btn-xs" data-id="<?php echo $value->id; ?>" onclick="delete_node(this);">
		                <i class="fa fa-trash-o"></i>
		                </button>
		                <img  width="30px"  src="<?php echo base_url('assets/wf/'.$value->icons.''); ?>" />
		               	<br/>
		               		<a href="<?php echo site_url('workflow/group/flowchart/'.$value->id); ?>
		               		"><?php echo $value->name;?></a><br/>
		                <div class="ep"></div></div>
		                	
		            <?php }?>		                                      
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
				<h4 class="modal-title">Form Editeds</h4>
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
						<label class="col-md-2 control-label">Aplikasi:</label> 
						<div class="col-md-6">
							<select name="link" id="link" class="form-control">
								<option value="#">Unidentify</option>
								<?php foreach ($apps as $key => $value) { ?>
									<option value="<?php echo $value->link; ?>"><?php echo $value->name; ?></option>
								<?php }?>	
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Parameter A:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="parameter_a" id="parameter_a" class="form-control" placeholder="parameter A" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Parameter B:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="parameter_b" id="parameter_b" class="form-control" placeholder="parameter B" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Parameter C:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="parameter_c" id="parameter_c" class="form-control" placeholder="parameter C" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Parameter D:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="parameter_d" id="parameter_d" class="form-control" placeholder="parameter D" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Parameter E:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="parameter_e" id="parameter_e" class="form-control" placeholder="parameter E" />
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
				<button type="button" onclick="execute('edit_node');" class="btn btn-primary">Save changes</button>
				
			</div>
			</form>
		</div>
	</div>
</div>
		
<div class="modal fade" id="box-connect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Form Edited</h4>
			</div>
			<form class="form-horizontal row-border"  method="post" id="box_connect">
			<div class="modal-body">	
				<div class="form-group">
					<label class="col-md-2 control-label">Code:</label> 
					<div class="col-md-4">
						<input type="text" class="form-control" readonly="readonly" id="code_con">
						<input type="hidden" class="form-control" name="code" id="code_con" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Name:</label> 
					<div class="col-md-4">
						<input type="text" class="form-control"  name="name" id="name_con" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Description:</label> 
					<div class="col-md-4">
						<textarea id="descr_con" name="descr" class="form-control"></textarea>
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

#dropzone {
	overflow: hidden;
	transition: background .15s linear, border-color .15s linear;
}

#dropzone.-drop-over {
	
}
.draggable {
	position: relative;
}
.draggable.-drop-possible { background-color: #42bd41; }
</style>
<script type="text/javascript">
(function (interact){
	'use strict';
	var transformProp;
		interact.maxInteractions(Infinity);
		// setup draggable elements.
		interact('span.js-drag')
			.draggable({ max: Infinity })
			.on('dragstart', function (event){
				event.interaction.x = parseInt(event.target.getAttribute('data-x'), 10) || 0;
				event.interaction.y = parseInt(event.target.getAttribute('data-y'), 10) || 0;
				event.interaction.code = parseInt(event.target.getAttribute('data-code'))
			})
			.on('dragmove', function (event) {
				event.interaction.x += event.dx;
				event.interaction.y += event.dy;
				if (transformProp) {
					event.target.style[transformProp] =
						'translate(' + event.interaction.x + 'px, ' + event.interaction.y + 'px)';
				}
				else {
					event.target.style.left = event.interaction.x + 'px';
					event.target.style.top = event.interaction.y + 'px';
				}
			})
			.on('dragend', function (event) {
				event.target.setAttribute('data-x', event.interaction.x);
				event.target.setAttribute('data-y', event.interaction.y);
			});
	setupDropzone('#dropzone', '#drag');
	function setupDropzone(el, accept) {
		interact(el)
		.dropzone({
			accept: accept,
			ondropactivate: function (event) {

			},
			ondropdeactivate: function (event) {

			}
		})
		.on('dropactivate', function (event) {
			
		})
		.on('dropdeactivate', function (event) {
			var active = event.target.getAttribute('active')|0;
			if (active === 1){
				removeClass(event.target, '-drop-possible');
			}
			event.target.setAttribute('active', active - 1);
		})
		.on('dragenter', function (event) {

		})
		.on('dragleave', function (event) {
			
		})
		.on('drop', function (event) {
			var icon = event.relatedTarget.dataset.icon;
			var ortype = event.relatedTarget.dataset.ortype;
			var group = event.relatedTarget.dataset.group;
			$.ajax({
				url: '<?php echo site_url();?>workflow/ajax/execute/save_detail',
				type: "POST",
				data: {icon:icon,or_type_id:ortype,group:group},
				success:function(data){
					$.pnotify({
						title: "Data Tersimpan",
						text: "Data Tersimpan",
						animation: {
							effect_in: 'show',
							effect_out: 'slide'
						},
						type : "success",
					});
					setInterval(function() {
						window.location.reload()
					}, 1000);
				},
			});		
			
		});
	}
	interact(document).on('ready', function () {
		transformProp = 'transform' in document.body.style
		? 'transform': 'webkitTransform' in document.body.style
		? 'webkitTransform': 'mozTransform' in document.body.style
		? 'mozTransform': 'oTransform' in document.body.style
		? 'oTransform': 'msTransform' in document.body.style
		? 'msTransform': null;
	});
}(window.interact));
$(document).on("click", "#form_edit", function () {
	var id = $(this).data('id');
	var code = $(this).data('code');
	var caption = $(this).data('caption');
	var name = $(this).data('name');
	var descr = $(this).data('descr');
	var a = $(this).data('a');
	var b = $(this).data('b');
	var c = $(this).data('c');
	var d = $(this).data('d');
	var e = $(this).data('e');
    $(".modal-body #id").val(id);
    $(".modal-body #code").val(code);
    $(".modal-body #name").val(name);
    $(".modal-body #caption").val(caption);
    $(".modal-body #parameter_a").val(a);
    $(".modal-body #parameter_b").val(b);
    $(".modal-body #parameter_c").val(c);
    $(".modal-body #parameter_d").val(d);
    $(".modal-body #parameter_e").val(e);
    $(".modal-body #descr").text(descr);
});
$(document).on("click", "#box_connects", function () {
	var code_con = $(this).data('code_con');
	var name_con = $(this).data('name_con');
	var descr_con = $(this).data('descr_con');
	//alert(code);
    $(".modal-body #code_con").val(code_con);
    $(".modal-body #name_con").val(name_con);
    $(".modal-body #descr_con").text(descr_con);
});
function delete_node(btn){
	var id = $(btn).data('id');
	$.ajax({
		url: "<?php echo site_url('workflow/ajax/delete'); ?>",
		type:"POST",
		data: {data_id:id},
		success: function(data ) {				    
			window.location.reload();
		}
	});
}
function execute(type){
	switch(type){
		/*
		 * act connection
		 * Case Edit and 
		*/
		case 'edit':
			$.ajax({
	  			url: "<?php echo site_url('workflow/ajax/push_con_update'); ?>",
	  			type:"POST",
	  			data: $("#box_connect").serialize(),
				success: function(data) {				    
					window.location.reload();				
				}
			});
		break;
		case 'delete':
			var code = $("#code_con").val();
			$.ajax({
	  			url: "<?php echo site_url('workflow/ajax/push_con_del'); ?>",
	  			type:"POST",
	  			data: {code:code},
				success: function(data ) {				    
					window.location.reload();
				}
			});
		break;
		case 'edit_node':
			$.ajax({
	  			url: "<?php echo site_url('workflow/ajax/edit'); ?>",
			  	type:"POST",
			  	data: $("#form_edit_node").serialize(),
				success: function(data) {				    
					window.location.reload();			
					$("#form_edit_node")[0].reset();
				}
			});
		break;
		default:
			alert('not method');
		break;
	}	
}

jsPlumb.ready(function() {	
	var instance = jsPlumb.getInstance({
		DragOptions : { cursor: 'pointer', zIndex:2000 },
		Endpoint : ["Dot", {radius:2}],
		maxConnections: -1,

		HoverPaintStyle : {strokeStyle:"#1e8151", lineWidth:2 },
		ConnectionOverlays : [
			[ "Arrow", { 
				location:1,
				id:"arrow",
	    		length:14,
	            foldback:0.8
			}],
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
		
		instance.bind("connection", function(info, originalEvent) {
			info.connection.getOverlay("label").setLabel('');
			//console.log(info.connection);
			//alert(info.connection.sourceId+"-"+info.connection.targetId)
			/*$.ajax({
		  		url: "<?php echo site_url('workflow/ajax/push_point'); ?>",
		  		type:"POST",
		  		data: {
		    		source: info.connection.sourceId,
		    		target: info.connection.targetId,
		    		code : info.connection.sourceId+info.connection.targetId,
		    		type : '<?php //echo $l;?>'
		  		},
				success: function(data ) {
				    //window.location.reload();
				}
			});*/
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
					maxConnections:-1,
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
						maxConnections:-1,
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
						label : "<a data-descr_con='<?php echo $value->descr;?>' data-name_con='<?php echo $value->name;?>' data-code_con='<?php echo $value->code;?>' href='#box-connect' data-toggle='modal' class='btn btn-xs btn-primary' id='box_connects'><i class='fa fa-pencil'></i></a>",
						location: 0.7,
					}],
				],
				
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
   				$.ajax({
		  			url: "<?php echo site_url('workflow/ajax/push'); ?>",
		  			type:"POST",
		  			data: {
		    			source: str_one,
		    			target: str_two,
		    			code : connection.sourceId+connection.targetId,
		    			type : '<?php echo $this->uri->segment(4);?>'
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
