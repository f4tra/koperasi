<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8" />
	<title>PPOB PT. Link Data Solusindo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/cloud-admin.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/responsive.css" />
	
	<link href="<?=base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<!-- DATE RANGE PICKER -->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<!-- FONTS -->
	<link href='<?=base_url();?>assets/css/css-google-font.css' rel='stylesheet' type='text/css' />
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
			<?php echo $template['content']; ?>  	
		</div>
	</section>
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="<?=base_url();?>assets/js/jquery/jquery-2.0.3.min.js"></script>
	<!-- JQUERY UI-->
	<script src="<?=base_url();?>assets/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
	<!-- BOOTSTRAP -->
	<script src="<?=base_url();?>assets/bootstrap-dist/js/bootstrap.min.js"></script>
	
		
	<!-- DATE RANGE PICKER -->
	<script src="<?=base_url();?>assets/js/bootstrap-daterangepicker/moment.min.js"></script>
	
	<script src="<?=base_url();?>assets/js/bootstrap-daterangepicker/daterangepicker.min.js"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="<?=base_url();?>assets/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js"></script>
	<!-- COOKIE -->
	<script type="text/javascript" src="<?=base_url();?>assets/js/jQuery-Cookie/jquery.cookie.min.js"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="<?=base_url();?>assets/js/script.js"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("widgets_box");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
	<!-- /JAVASCRIPTS -->
</body>
</html>