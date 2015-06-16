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

<body>
	<header class="navbar clearfix" id="header">	
		<?php $this->load->view('header', $template); ?>
	</header>
	<section id="page">
		<!-- SIDEBAR -->
		
			<?php $this->load->view('side-dealer', $template); ?> 
		
		<!-- END SIDEBAR -->
		<div id="main-content">
			<div class="container">
				<?php echo $template['content']; ?>  	
			</div>
		</div>
	<section>
		
	<?php echo $template['js_footer']; ?>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("widgets_box");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
</body>
</html>