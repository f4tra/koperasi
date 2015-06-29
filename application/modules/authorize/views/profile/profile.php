
<div class="row">
	 <div class="col-md-12">
		<div class="box border">
			<div class="box-title">
				<h4><i class="fa fa-reorder"></i>General Information</h4>
			</div>
			<div class="box-body big">						
			<form class="form-horizontal" id="form" method="post" />
				<div class="form-group">
					<label class="col-md-2 control-label">Name *)</label>
					<div class="col-md-6">
						First name <input  value="<?php echo $user->first_name;?>"type="text" class="form-control" placeholder="Enter First Name" name="first_name" id="first_name">					
						Last name	<input  value="<?php echo $user->last_name;?>"type="text" class="form-control" placeholder="Enter Last Name" name="last_name" id="last_name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Email *)</label>
					<div class="col-md-6">						
						<input  value="<?php echo $user->email;?>"type="text" class="form-control" placeholder="Email" name="email" id="email">
					</div>
					
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Registered </label>
					<div class="col-md-6">						
						<input  value="<?php echo $user->registered;?>" type="text" disabled class="form-control" placeholder="Email" name="" id="">
					</div>					
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Role </label>
					<div class="col-md-6">						
						<input  value="<?php echo $auth_user['role_name'];?>" type="text" disabled class="form-control" placeholder="Email" name="role" id="role">
					</div>
				</div>
				<div class="form-actions clearfix">
					<input onclick="save(this);" type="submit" value="Update Account" class="btn btn-primary pull-right" />
				</div>
			</form>
			</div>
		</div>
	</div>
</div>


<!-- /PAGE table -->		
<div class="separator"></div>
<div class="footer-tools">
	<span class="go-top">	
								<i class="fa fa-chevron-up"></i> Top
							</span>
						</div>
					</div><!-- /CONTENT-->
				</div>

<script type="text/javascript">

// Fungsi Untuk Tambah Data
function save(){
	$('#form').validate({
	    rules: {
		
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
				url: '<?php echo site_url();?>authorize/profile/action',
				type: "POST",
				dataType:"json",
				data: $("#form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
					location.reload();
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