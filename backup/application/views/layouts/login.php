<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
	<meta name="description" content="" />
	<title><?php echo $template['base_title']; ?></title>
	<?php echo $template['metas']; ?>
	<?php echo $template['css']; ?>
	<?php echo $template['js_header']; ?>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body class="login">
	
	<section id="page">
		<!-- HEADER -->
			<header>
				<!-- NAV-BAR -->
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div id="logo">
								<!--<a href="index.html"><img src="img/logo/logo-alt.png" height="40" alt="logo name" /></a>-->
							</div>
						</div>
					</div>
				</div>
				<!--/NAV-BAR -->
			</header>
			<!--/HEADER -->
			<?php echo $template['content']; ?>
	</section>
		
	<?php echo $template['js_footer']; ?>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("login");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
	<script type="text/javascript">
		function swapScreen(id) {
			jQuery('.visible').removeClass('visible animated fadeInUp');
			jQuery('#'+id).addClass('visible animated fadeInUp');
		}
	</script>
</body>
</html>