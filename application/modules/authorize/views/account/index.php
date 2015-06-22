<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-cog"></i>Acount Setting </h4> 
					
				</div>
				<div class="box-body">
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form">
						<div class="form-group">
							<label class="col-md-2 control-label">Username Lama:</label> 
							<div class="col-md-4">
								<input class="form-control" type="text" disabled="" value="<?php echo $account->username; ?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Username Baru:</label> 
							<div class="col-md-4">
								<input class="form-control" type="text" name="username" id="username"  placeholder="Username baru" >
								<span id="availability_status"></span> 
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label">Password Baru:</label> 
							<div class="col-md-4">
								<input class="form-control" type="password" name="password" id="password" placeholder="*****">
							</div>
								
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label">Konfirmasi Password Baru:</label> 
							<div class="col-md-4">
								<input class="form-control" type="password" name="password_c" id="password_c" placeholder="*****">
								<br />
								<label for="" class="label label-danger">Jika tidak ingin dirubah maka biarkan kosong</label>
							</div>
						</div>						
						<div class="form-actions clearfix">
						<div class="col-md-6">
							
						<input type="submit" class="btn btn-primary pull-right" onclick="save(this);" value="Save"/>						
						</div>

				</div>
					</form>					
					<!-- /Form-->
				</div>
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
<script type="text/javascript">
$("#username").change(function()
{
	var email = $("#username").val();//Get the value in the email textbox
	$("#availability_status").html('Checking availability...');
		$.ajax({
			type: "POST",
			url: "<?php echo site_url();?>authorize/account/cek_username",
			data: "username="+email,
			success: function(server_response){
				if(server_response == '0')
				{
					$("#availability_status").html('<font color="Green">Tersedia </font>');
				}
				else if(server_response == '1')//if it returns "1"
				{
					$("#availability_status").html('<font color="red">Sudah Digunakan </font>');
				}
			}
		});
});
$("#loading").hide();
function save(){
	
	
	var user 	 = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	
	if(user == '' && password == ''){
		$('#form').validate({
			submitHandler: function(form){
				$.pnotify({
					title: 'Your Account has Updated',
					text: 'Your Account has Updated',
					animation: {
						effect_in: 'show',
						effect_out: 'slide'
					},
					type : "success",
				});
				//$("#loading").hide();
			},			
			
		});
	}
	else if(user != '' && password == '')
	{
		jQuery.validator.addMethod("noSpace", function(value, element) { 
			return value.indexOf(" ") < 0 && value != ""; 
		},"username password tidak boleh ada spasi");
		$('#form').validate({
			rules: {
				username: {
					minlength: 4,
					noSpace: true
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
					url: '<?php echo site_url();?>authorize/account/action',
					type: "POST",
					dataType:"json",
					data: $("#form").serialize(),
					beforeSend: function(){
						$("#loading").show(); 
					},
					success:function(data){
						/*  */
						if(data.rescode == 'USD'){
							$.pnotify({
								title: 'Username Sudah Digunakan',
								text: 'Username Sudah Digunakan',
								animation: {
									effect_in: 'show',
									effect_out: 'slide'
								},
								type : "info",
							});														
							
						}else if(data.rescode == 'USN'){
							$.pnotify({
								title: 'Username telah dirubah',
								text: 'Username telah dirubah',
								animation: {
									effect_in: 'show',
									effect_out: 'slide'
								},
								type : "success",
							});							
							setInterval(function() {
								location.reload();
							}, 2000);
						}
					},
					error: function(){
						$("#msg").slideDown();
					}
				}); 
			},
		});
	}
	else if(user != '' && password != '')
	{
		jQuery.validator.addMethod("noSpace", function(value, element) { 
			return value.indexOf(" ") < 0 && value != ""; 
		},"username password tidak boleh ada spasi");
		$('#form').validate({
			rules: {
				password: {
					minlength: 5,
					noSpace: true					
				},
				password_c: {
					minlength: 5,
					noSpace: true,
					equalTo: "#password"
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
					url: '<?php echo site_url();?>authorize/account/action',
					type: "POST",
					dataType:"json",
					data: $("#form").serialize(),
					beforeSend: function(){
						$("#loading").show(); 
					},
					success:function(data){
						//alert(data.rescode);
						if(data.rescode === 'UPN'){
							$.pnotify({
								title: 'Username Sudah Digunakan',
								text: 'Username Sudah Digunakan',
								animation: {
									effect_in: 'show',
									effect_out: 'slide'
								},
								type : "info",
							});
							$("#loading").hide();
							//$('#load').load('<?=base_url().'index.php/auth/account';?>');
						}else{
							$.pnotify({
								title: 'username dan password telah dirubah',
								text: 'username dan password telah dirubah',
								animation: {
									effect_in: 'show',
									effect_out: 'slide'
								},
								type : "success",
							});
							$("#loading").hide();
							setInterval(function() {
								location.reload();
							}, 2000);
						}
					},
					error: function(){
						$("#msg").slideDown();
					}
				}); 
			},
		});
	}
	else if(user == '' && password != '')
	{
		jQuery.validator.addMethod("noSpace", function(value, element) { 
			return value.indexOf(" ") < 0 && value != ""; 
		},"username password tidak boleh ada spasi");
		$('#form').validate({
			rules: {
				password: {
					minlength: 4,
					noSpace: true
					//equalTo: "#password"
				},
				password_c: {
					minlength: 4,
					noSpace: true,
					equalTo: "#password"
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
					url: '<?php echo site_url();?>authorize/account/action',
					type: "POST",
					dataType:"json",
					data: $("#form").serialize(),
					beforeSend: function(){
						$("#loading").show(); 
					},
					success:function(data){
						//alert(data.rescode);
						if(data.rescode == 'PASS'){
							$.pnotify({
								title: 'Password Sudah dirubah',
								text: 'password sudah dirubah',
								animation: {
									effect_in: 'show',
									effect_out: 'slide'
								},
								type : "success",
							});
							$("#loading").hide();
							setInterval(function() {
								location.reload();
							}, 2000);
						}
					},
					error: function(){
						$("#msg").slideDown();
					}
				}); 
			},
		});
	}
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