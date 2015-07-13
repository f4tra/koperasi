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
	
	<?php echo $template['js_header']['beckend']; ?>
</head>
<body>

	<?php echo $this->load->view('beckend_partial/header',$template); ?>		
	
	
	<!-- PAGE -->
	<section id="page">
		<?php echo $this->load->view('beckend_partial/sidebar',$template); ?>				
		<div id="main-content">
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12">
						<?php echo $this->load->view('beckend_partial/broudcoum',$template); ?>				
						<?php echo $template['content']; ?>
						
					</div><!-- /CONTENT-->
				</div>
			</div>
		</div>
	</section>
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<?php  echo $template['js_footer']['beckend']; ?>
	<script>
		<?php 

		//if($this->uri->segment(1) != null):?>
		jQuery(document).ready(function() {		
			App.setPage("fixed_header_sidebar");  //Set current page			
			App.init(); //Initialise plugins and elements
		});
		<?php //endif;?>
	</script>
</body>
</html>
