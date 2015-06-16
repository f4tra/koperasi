<!-- LOGIN -->
			<section id="login" class="visible">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="login-box-plain">
								<h2 class="bigintro">Sign In</h2>
								<div class="divide-40"></div>
								<!-- messsage -->
								
								<form role="form" id="signinform" class="signinform" method="post"/>
								  <div class="form-group">
									<label for="exampleInputEmail1">Username or Email address</label>
									<i class="fa fa-envelope"></i>
									<input type="text" class="form-control"  name="username" id="username" value="<?php echo (isset($username)) ? $username : ''; ?>"/>
									<span class="error-span"></span>
								  </div>
								  <div class="form-group"> 
									<label for="exampleInputPassword1">Password</label>
									<i class="fa fa-lock"></i>
									<input type="password" class="form-control" name="password" id="password" />
									<span class="error-span"></span>
								  </div>
								  <div class="form-actions">
								
									<label class="checkbox"> <input type="checkbox" class="uniform" name="remember" value="1" <?php echo (isset($remember)) ? 'checked="checked"' : ''; ?> /> Remember me</label>
									<button type="submit" onclick="login(this);" class="btn btn-danger">Submit</button>
										<div id="loading">
										<center>
											<img src="<?php echo base_url();?>assets/img/loaders/11.gif">	
										</center>
										</div>
										
								  </div>
								</form>
								<!--
								<div class="login-helpers">
									<a href="#" onclick="swapScreen('forgot');return false;">Forgot Password?</a> <br />
									Don't have an account with us? <br /> <br />
									<div class="row">
									<div class="col-md-12">
									<a href="#"class="btn btn-info col-md-12" onclick="swapScreen('register');return false;">Register now!</a>
									</div>
									</div>
								</div>
								-->
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/LOGIN -->
			<!-- REGISTER -->
			<!--
			<section id="register">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="login-box-plain">
								<h2 class="bigintro">Register</h2>
								<div class="divide-40"></div>
								<form role="form" method="post" id="my-form"/>
								  <div class="form-group">
									<label for="exampleInputName">Full Name</label>
									<i class="fa fa-font"></i>
									<input type="text" class="form-control" placeholder="Enter Full Name" name="name" id="name">
								  </div>
								 
								  <div class="form-group">
									<label for="exampleInputEmail1">Email address</label>
									<i class="fa fa-envelope"></i>
									<input type="email" class="form-control" placeholder="Enter Email" name="email" id="email">
									<span id="availability_status"></span> 
								  </div>
								  <div class="form-actions">
									<label class="checkbox">
									<input name="cek" id="cek" type="checkbox" class="uniform" value="" />I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
									<button  onclick="save(this);" type="submit" class="btn btn-success">Sign Up</button>
									<div id="loading-2">
										<center>
											<img src="<?php echo base_url();?>assets/img/loaders/11.gif">	
										</center>
										</div>
								  </div>
								</form>
								
								<div class="login-helpers">
									<a href="#" onclick="swapScreen('login');return false;"> Back to Login</a> <br />
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>-->
			<!--/REGISTER -->
			
			<!-- FORGOT PASSWORD -->
			<!--
			<section id="forgot">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="login-box-plain">
								<h2 class="bigintro">Reset Password</h2>
								<div class="divide-40"></div>
								<form role="form" id="f" />
								  <div class="form-group">
									<label for="exampleInputEmail1">Enter your Email address</label>
									<i class="fa fa-envelope"></i>
									<input type="email" class="form-control" id="email" name="email" />
								  </div>
								  <div class="form-actions">
									<button type="submit" class="btn btn-info" onclick="forgot(this);">Send Me Reset Instructions</button>
								  <div id="loading-3">
										<center>
											<img src="<?php echo base_url();?>assets/img/loaders/11.gif">	
										</center>
										</div>
								  </div>
								</form>
								<div class="login-helpers">
									<a href="#" onclick="swapScreen('login');return false;">Back to Login</a> <br />
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			-->
			<!-- FORGOT PASSWORD -->
<script type="text/javascript">

$("#loading").hide();
$("#loading-2").hide();
$("#loading-3").hide();
function login(){
	//alert('sdfsd');
	$("#signinform").validate({
		//onfocusout: false,onkeyup: false,onclick: false,
		rules: {
			username: {
				required: true,
			},
			password: {
				required: true,
			}
		},
		
		submitHandler: function(form) { 
			
			$.ajax({
				url: "<?php echo site_url('auth/login/action');?>",
				type: "POST",
				data: $("#signinform").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success: function(data) {
					console.log(data.url);
					//alert(data.returl);
					//alert(data.ResStatus);
					if(data.retcode === "100"){
						//alert(data.ResMsg);
						//form.submit();
						//$("#signinform input").val('');	
						//$("signinemaillbl,#signinmainlbl").hide();
						//window.location = data.url ;
						window.setTimeout( function(){ window.location = data.url;}, 300 );
					}
					else if(data.retcode === "200"){
						//alert(data.ResMsg);
						//form.submit();
						//$("#signinform input").val('');	
						//$("signinemaillbl,#signinmainlbl").hide();
						//window.location = data.url ;
						window.setTimeout( function(){ window.location = data.url;}, 300 );
					}
					else{
						$.pnotify({
							title: 'Wrong Username and Password',
							text: 'Wrong Username and Password.',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "error",
						});
						$("#loading").hide();
					}
				},
				error: function (xhr){
							$("#msg").html("<i class='icon-exclamation-sign icon-white' ></i>System is busy now, please try again.");
							$("#msg").removeClass('label-important label-success label-warning').addClass('label-info');
							$("#msg").slideDown();
				}
			});
		},
		debug:true
	});
}
function validateEmail(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if( !emailReg.test( email ) ) {
        return false;
        } else {
        return true;
       }
}
$("#email").change(function()
{
		//if theres a change in the email textbox
		var email = $("#email").val();//Get the value in the email textbox
		//var email = 'emails='+ $(this).val();
		if(validateEmail(email))//if the lenght greater than 3 characters
		{
			$("#availability_status").html('Checking availability...');
			//Add a loading image in the span id="availability_status"
			$.ajax({
				//Make the Ajax Request
				type: "POST",
				url: "<?php echo base_url();?>index.php/auth/register/cek_email",
				data: "email="+email,
				success: function(server_response){
					console.log(server_response);
					//$("#availability_status").ajaxComplete(function(event, request){
						if(server_response == '0')
						{
							$("#availability_status").html('<font color="Green">Tersedia </font>');
							
						}
						else if(server_response == '1')//if it returns "1"
						{
							$("#availability_status").html('<font color="red">Sudah Digunakan </font>');
							
						}
					//});
				}
			});
		}
	return false;
});

$("#loading").hide();
function save(){
	$("#my-form").validate({
		rules:{	
			name: {
				required:true,
				//email	:true
			},
			email: {
				required:true,
				email	:true
			},
			cek: {
				required:true,
				//email	:true
			},
		},
		highlight: function(element) {
			$(element).closest('input').removeClass('success').addClass('error');
		},
		unhighlight:function(element){
			$(element).closest('input').removeClass('error').addClass('success');
		},
		success: function(element) {
			element
			.addClass('valid')
			.closest('input').removeClass('error').addClass('success');
		},
		errorPlacement: function(error, element){if (element.is(':checkbox')) {
        $(element).parent('div').addClass('checkbox-error');

    }
    return true;},
		submitHandler: function(form){
				
			$.ajax({
			url: '<?=site_url('auth/register/execute');?>',				
			type: "POST",
			dataType:"json",
			data: $("#my-form").serialize(),
			beforeSend: function(){
				$("#loading-2").show();				
			},				
			success:function(data){
				console.log(data);
					if(data.retcode==="10"){
						$.pnotify({
							title: 'Invalid Parameter',
							text: 'Invalid Parameter.',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "notice",
						});
					$("#loading-2").hide();
					//form.reset("#my-form");
					}else if(data.retCode==="20"){
						$.pnotify({
							title: 'Email Not Available',
							text: 'Email Not Available',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "notice",
						});
					$("#loading-2").hide();
					}
					else if(data.retCode==="001"){
						$.pnotify({
							title: 'Registration Not Success',
							text: 'Registration Not Successs',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "notice",
						});
					$("#loading-2").hide();
					}else if(data.retCode==='00'){
						$.pnotify({
							title: 'Sukses',
							text: 'Cek Your Email For Activation. Thks',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "success",
						});
					$("#loading-2").hide();
					form.reset("#my-form");
					//window.setTimeout( function(){ window.location = data.url;}, 3000 );
					}else{
						$.pnotify({
							title: 'Error',
							text: 'Error System.',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "error",
						});
						$("#loading-2").hide();
					}
			},
			error: function (request, status, error) {
				//show_stack_bottomright('error');				
					$.pnotify({
						title: 'System Bussy',
						text: 'System Bussy.',
						animation: {
								effect_in: 'show',
								effect_out: 'slide'
						},
						type : "info",
					});
					$("#loading-2").hide();
			}, 	
			});
		}
	});		    
}

function forgot(){
	$("#f").validate({
		rules:{
			email: {
				required:true,
				email	:true
			},
		},
		highlight: function(element) {
			$(element).closest('input').removeClass('success').addClass('error');
		},
		unhighlight:function(element){
			$(element).closest('input').removeClass('error').addClass('success');
		},
		success: function(element) {
			element
			.addClass('valid')
			.closest('input').removeClass('error').addClass('success');
		},
		errorPlacement: function(error, element){if (element.is(':checkbox')) {
        $(element).parent('div').addClass('checkbox-error');

    }
    return true;},
		submitHandler: function(form){
				
			$.ajax({
			url: '<?=site_url('auth/forgot/execute');?>',				
			type: "POST",
			dataType:"json",
			data: $("#f").serialize(),
			beforeSend: function(){
				$("#loading-3").show();				
			},				
			success:function(data){				
					if(data.retcode==="10"){
						$.pnotify({
							title: 'Invalid Parameter',
							text: 'Invalid Parameter.',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "notice",
						});
					$("#loading-3").hide();					
					}else if(data.retCode==="20"){
						$.pnotify({
							title: 'Email Not Available',
							text: 'Email Not Available',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "notice",
						});
						$("#loading-3").hide();
					}
					else if(data.retCode==='00'){
						$.pnotify({
							title: 'Sukses',
							text: 'Cek Your Email For Reset Password. Thks',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "success",
						});
					$("#loading-3").hide();
					form.reset("#my-form");
					//window.setTimeout( function(){ window.location = data.url;}, 3000 );
					}
			},
			error: function (request, status, error) {
				//show_stack_bottomright('error');				
					$.pnotify({
						title: 'System Bussy',
						text: 'System Bussy.',
						animation: {
								effect_in: 'show',
								effect_out: 'slide'
						},
						type : "info",
					});
					$("#loading-2").hide();
			}, 	
			});
		}
	});		    
}
</script>
	
<style type="text/css">
.error {
    border: 1px solid red;
}
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