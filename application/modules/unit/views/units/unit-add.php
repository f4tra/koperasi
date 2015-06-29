<!-- PAGE table -->
<div class="row">
	<div class="col-md-12">
		<!-- BASIC -->
		<div class="box border orange">
			<div class="box-title">
				<h4><i class="fa fa-reorder"></i>Menu</h4>
				<div class="tools hidden-xs">
					
				</div>
			</div>
			<div class="box-body big">
				<form class="form-horizontal row-border"  method="post" id="form">
					<div class="form-group">
						<label class="col-md-2 control-label">Code:</label> 
						<div class="col-md-4">
							<input  class="form-control" type="text" name="code" id="code"  placeholder="Code">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Name:</label> 
						<div class="col-md-4">
							<input  class="form-control" type="text" name="name" id="name" placeholder="Name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Description:</label> 
						<div class="col-md-4">
							<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-2 control-label">Active:</label> 
						<div class="col-md-4">
							<select name="active" id="active" class="form-control">								
								<option value="0">Active</option>
								<option value="1">Inactive</option>							
							</select>
						</div>
					</div>	
					<div class="form-actions">
						<div class="row">						
							<div class="col-md-6">								
								<input type="submit" class="btn btn-primary btn-lg pull-right" onclick="save(this);" value="Save"/>													
							</div>							
						</div>
					</div>										   
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /BASIC -->
<div class="separator"></div>

<script type="text/javascript">
var url = "<?php echo site_url(); ?>";
// Fungsi Untuk Tambah Data
function save(){
	$('#form').validate({
	    rules: {
	      code: {
	        minlength: 1,
	        required: true
	      },
	      name: {
	        required: true,
	        minlength: 2
	      },
		  captionn: {
	        required: true,
	        minlength: 2
	      },
		  link: {
	        required: true,	        
			
	      },
	    },
		highlight: function(element) {
			$(element).closest('.control-group').removeClass('success').addClass('error');
		},
		success: function(element) {
			element
			.text('OK!').addClass('valid')
			.closest('.control-group').removeClass('error').addClass('success');
		},
		submitHandler: function(form){
			$.ajax({
				url: url+'unit/unit/execute/save',
				type: "POST",
				dataType:"json",
				data: $("#form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
					$.pnotify({
						title: 'Unit Created',
						text: 'Unit Created',
						animation: {
							effect_in: 'show',
							effect_out: 'slide'
						},
						type : "success",
					});
						
					setInterval(function() {
						
						window.location = "./";
					}, 1000);
				},
				error: function(){
					$("#msg").slideDown();
				}
			}); 
		},			
		debug:true
	});	
} 
$("#parent").select2({
    allowClear: !0
});

$("#link").select2({
    allowClear: !0
});
</script>

<style type="text/css">
	label.valid {
		width: 24px;
		height: 24px;
		display: inline-block;
		text-indent: -9999px;
	}
	label.error {
		font-weight: bold;
		color: red;
		padding: 2px 8px;
		margin-top: 2px;
	}
</style>