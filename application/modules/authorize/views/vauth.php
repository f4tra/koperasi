<!-- HEADER -->
	<header>
	<!-- NAV-BAR -->
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div id="logo">
					<a href="index.html"><img src="img/logo/logo-alt.png" height="40" alt="logo name" /></a>
				</div>
			</div>
		</div>
	</div>
	<!--/NAV-BAR -->
</header>
<!--/HEADER -->
<!-- LOGIN -->
<section id="login" class="visible">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-box-plain">
					<h2 class="bigintro"><?php echo lang('login'); ?></h2>
					<div class="divide-40"></div>
					<?php echo messages(); ?>
					<form role="form"  method="post"/>
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('username'); ?></label>
							<i class="fa fa-envelope"></i>							
							<input type="text" name="username" id="username" value="<?php echo (isset($username)) ? $username : ''; ?>" class="form-control"/>
						</div>
						<div class="form-group"> 
							<label for="exampleInputPassword1"><?php echo lang('password'); ?></label>
							<i class="fa fa-lock"></i>							
							<input type="password" name="password" id="password" class="form-control">
						</div>
						<div class="form-actions">
							<label class="checkbox">								
								<input type="checkbox" name="remember" class="uniform" value="1" <?php echo (isset($remember)) ? 'checked="checked"' : ''; ?> />
								<?php echo lang('remember_me'); ?>
							</label>		
							<input type="hidden" name="type" id="type" value="<?php echo base64_encode('login');?>">	
							<button type="submit" name="login-button" id="login-button"   class="btn btn-danger"><?php echo lang('login'); ?></button>				
						</div>
					</form>
					<!-- SOCIAL LOGIN -->
					<div class="divide-20"></div>
					<div class="center">
						<strong>Or login using your social account</strong>
					</div>
					<div class="divide-20"></div>
					<div class="social-login center">
						<a class="btn btn-primary btn-lg"><i class="fa fa-facebook"></i></a>
						<a class="btn btn-info btn-lg"><i class="fa fa-twitter"></i></a>
						<a class="btn btn-danger btn-lg"><i class="fa fa-google-plus"></i></a>
					</div>
					<!-- /SOCIAL LOGIN -->
					<div class="login-helpers">
						<a href="#" onclick="swapScreen('forgot');return false;" >Forgot Password?</a> <br />
						Don't have an account with us? <a href="#" onclick="swapScreen('register');return false;">Register	now!</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/LOGIN -->
<!-- REGISTER -->
			<section id="register">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="login-box-plain">
								<h2 class="bigintro">Register</h2>
								<div class="divide-40"></div>
								<form role="form" />
								  <div class="form-group">
									<label for="exampleInputName">Full Name</label>
									<i class="fa fa-font"></i>
									<input type="text" class="form-control" id="exampleInputName" />
								  </div>
								  <div class="form-group">
									<label for="exampleInputUsername">Username</label>
									<i class="fa fa-user"></i>
									<input type="text" class="form-control" id="exampleInputUsername" />
								  </div>
								  <div class="form-group">
									<label for="exampleInputEmail1">Email address</label>
									<i class="fa fa-envelope"></i>
									<input type="email" class="form-control" id="exampleInputEmail1" />
								  </div>
								  <div class="form-group"> 
									<label for="exampleInputPassword1">Password</label>
									<i class="fa fa-lock"></i>
									<input type="password" class="form-control" id="exampleInputPassword1" />
								  </div>
								  <div class="form-group"> 
									<label for="exampleInputPassword2">Repeat Password</label>
									<i class="fa fa-check-square-o"></i>
									<input type="password" class="form-control" id="exampleInputPassword2" />
								  </div>
								  <div class="form-actions">
									<label class="checkbox"> <input type="checkbox" class="uniform" value="" /> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
									<button type="submit" class="btn btn-success">Sign Up</button>
								  </div>
								</form>
								<!-- SOCIAL REGISTER -->
								<div class="divide-20"></div>
								<div class="center">
									<strong>Or register using your social account</strong>
								</div>
								<div class="divide-20"></div>
								<div class="social-login center">
									<a class="btn btn-primary btn-lg">
										<i class="fa fa-facebook"></i>
									</a>
									<a class="btn btn-info btn-lg">
										<i class="fa fa-twitter"></i>
									</a>
									<a class="btn btn-danger btn-lg">
										<i class="fa fa-google-plus"></i>
									</a>
								</div>
								<!-- /SOCIAL REGISTER -->
								<div class="login-helpers">
									<a href="#" onclick="swapScreen('login');return false;"> Back to Login</a> <br />
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/REGISTER -->
			<!-- FORGOT PASSWORD -->
			<section id="forgot">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="login-box-plain">
								<h2 class="bigintro">Reset Password</h2>
								<div class="divide-40"></div>
								<form role="form" />
								  <div class="form-group">
									<label for="exampleInputEmail1">Enter your Email address</label>
									<i class="fa fa-envelope"></i>
									<input type="email" class="form-control" id="exampleInputEmail1" />
								  </div>
								  <div class="form-actions">
									<button type="submit" class="btn btn-info">Send Me Reset Instructions</button>
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
			<!-- FORGOT PASSWORD -->