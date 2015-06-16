<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8" />
	<title><?php echo $template['title']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php echo $template['metas']; ?>
	<?php echo $template['css']['beckend']; ?>
	
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css' />
	<?php echo $template['js_header']['beckend']; ?>
</head>
<body>
	<!-- PAGE -->
	<section id="page">
		<?php echo $template['content']; ?>		
	</section>

	<?php  echo $template['js_footer']['beckend']; ?>
	
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
	<!-- /JAVASCRIPTS -->
</body>
</html>
