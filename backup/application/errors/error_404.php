<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8" />
	<title>Cloud Admin | Error 404</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="assets/css/cloud-admin.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" />
	
	<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<!-- DATE RANGE PICKER -->
	<link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<!-- FONTS -->
	<link href='assets/google_font.css' rel='stylesheet' type='text/css' />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>	
	<!-- PAGE -->
	<section id="page">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="divide-100"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 not-found text-center">
				   <div class="error">
					  404
				   </div>
				</div>
				<div class="col-md-4 col-md-offset-4 not-found text-center">
				   <div class="content">
					  <h3><?php echo $heading; ?></h3>
					  <p>
						<?php echo $message; ?>, <a href="http://localhost/workflow">goto home</a>.
					  </p>
					  <form action="#" />
						 <div class="input-group">
							<input type="text" class="form-control" placeholder="search here..." />
							<span class="input-group-btn">                   
								<button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
							</span>
						 </div>
					  </form>
				   </div>
				</div>
			</div>
		</div>
	</section>
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="assets/js/jquery/jquery-2.0.3.min.js"></script>
	<!-- JQUERY UI-->
	<script src="assets/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
	<!-- BOOTSTRAP -->
	<script src="assets/bootstrap-dist/js/bootstrap.min.js"></script>
	
		
	<!-- DATE RANGE PICKER -->
	<script src="assets/js/bootstrap-daterangepicker/moment.min.js"></script>
	
	<script src="assets/js/bootstrap-daterangepicker/daterangepicker.min.js"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="assets/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="assets/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js"></script>
	<!-- COOKIE -->
	<script type="text/javascript" src="assets/js/jQuery-Cookie/jquery.cookie.min.js"></script>
	<!-- CUSTOM SCRIPT -->
	<script src=">assets/js/script.js"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("widgets_box");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
	<!-- /JAVASCRIPTS -->
</body>
</html>

