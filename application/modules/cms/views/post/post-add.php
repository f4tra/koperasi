<!-- PAGE table -->
<form class="form-horizontal row-border"  method="post" id="form">
<div class="row">
	<div class="col-md-8">
		<!-- BASIC -->
		<div class="box border orange">
			<div class="box-title">
				<h4><i class="fa fa-reorder"></i>Post Management</h4>
				<div class="tools hidden-xs">
					
				</div>
			</div>
			<div class="box-body big">
				<div class="form-group">
					<div class="col-md-12">						
						<input  class="form-control" type="text" name="title" id="title"  placeholder="Title">
					</div>
				</div>					
				<div class="form-group">					
					<div class="col-md-12">
						<textarea name="post_content" id="post_content" cols="30" rows="10" class="form-control"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<!-- BASIC -->
		<div class="box border">
			<div class="box-title">
				<h4><i class="fa fa-tags"></i>Post Management</h4>
				<div class="tools hidden-xs">
					
				</div>
			</div>
			<div class="box-body big">
				<div class="form-group">
					<label class="col-md-5 control-label">Post Status:</label> 
					<div class="col-md-7">
						<select name="post_status" id="post_status" class="form-control">								
							<option value="0">Publish</option>
							<option value="1">Un Publish</option>							
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-5 control-label">Comment Status:</label> 
					<div class="col-md-7">
						<select name="comment_status" id="comment_status" class="form-control">								
							<option value="0">Open</option>
							<option value="1">Not Comment</option>							
						</select>
					</div>
				</div>
				<div class="form-actions">
					<div class="row">						
						<div class="col-md-12">								
							<input type="submit" class="btn btn-primary btn-ls pull-right" onclick="save(this);" value="Save"/>													
						</div>							
					</div>
				</div>										   				
			</div>
		</div>
	</div>
</div>
<!-- /BASIC -->
</form>
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
				url: url+'cms/post/execute/save',
				type: "POST",
				dataType:"json",
				data: $("#form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
					$.pnotify({
						title: 'Post Created',
						text: 'Post Created',
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