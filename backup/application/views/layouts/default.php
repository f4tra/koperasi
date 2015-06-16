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

<body >
	<header class="navbar clearfix navbar-fixed-top" id="header">	
		<?php $this->load->view('header', $template); ?>
		<!-- 
		Start Right Sidebar
				-->
				<div id="slide-panel">
					<a href="#" class="btn btn-danger" id="opener"><i class="fa fa-reorder"></i>
					</a>
					<?php $this->load->view('right', $template); ?> 
				</div>
				<!-- 
					Start Right Sidebar
				-->
	</header>
	<section id="page">
		<!-- SIDEBAR -->
		<div id="sidebar" class="sidebar ">

			<?php
			$uri_segment = $this->uri->segment(2);
			
			if($uri_segment == "group")
				$this->load->view('side_wf', $template); 
			else
				$this->load->view('side', $template); 
			?>

		</div>

		<!-- END SIDEBAR -->
		<div id="main-content">

			<div class="container">
				<?php $this->load->view('broadcoum',$template); ?>  	
				<?php echo $template['content']; ?> 
			</div>		
			<div class="footer-tools">
				<span class="go-top"><i class="fa fa-chevron-up"></i> Top</span>
			</div>
			<br>
		</div>
		<!-- SAMPLE BOX CONFIGURATION MODAL FORM-->
		<div class="modal fade" id="box-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					  <h4 class="modal-title">Installation Setting</h4>
					</div>
					<div class="modal-body">
					  Are You soure Install This Apps?
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  <button type="button" onclick="apps(this);" class="btn btn-primary">Install</button>
					</div>
				  </div>
				</div>
			  </div> 
			<!-- /SAMPLE BOX CONFIGURATION MODAL FORM-->
	</section>
	<center>
		<button id="market" type="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo">
		Marketplace
		</button>
	</center>
	<div id="demo" class="collapse">
		<div class="tabbable tabbable-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1_1" data-toggle="tab"><i class="fa fa-home"></i> All</a></li>
			<li class=""><a href="#tab_1_2" data-toggle="tab"><i class="fa fa-envelope"></i> Reports</a></li>
			<li class=""><a href="#tab_1_3" data-toggle="tab">Component</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_1_1">
				<p><div id="grid" class="row">
  				<?php
      				$warna = array("btn-danger","btn-primary","btn-info","btn-success","btn-warning","btn-default");
      				$rand_warna = shuffle($warna);
      				$variable = $this->mgeneral->getAll('tr_marketplace');
      				foreach ($variable as $key => $value) {
      					
  				?>
	    			<div class="col-xs-3 col-sm-3 col-md-2">
	      				<a class="btn <?php echo $warna[$rand_warna];?> btn-icon input-block-level"  data-toggle="modal" href="#box-config<?php //echo site_url($value->link);?>">
	        				<i class="fa fa-bar-chart-o fa-2x"></i>
	        				<div><?php echo $value->name;?> <br/>Rp. <?php echo number_format($value->price,2);?></div>
	      				</a>
	       			</div>
	       			<?php } ?>
       			</div></p>       		
			</div>
			<div class="tab-pane" id="tab_1_2">
				<p><div id="grid" class="row">
  				<?php
      				$warna = array("btn-danger","btn-primary","btn-info","btn-success","btn-warning","btn-default");
      				$rand_warna = shuffle($warna);
      				$variable = $this->mgeneral->getWhere(array('type'=>1),'tr_marketplace');
      				foreach ($variable as $key => $value) {
      					
  				?>
	    			<div class="col-xs-3 col-sm-3 col-md-2">
	      				<a class="btn <?php echo $warna[$rand_warna];?> btn-icon input-block-level"  data-toggle="modal" href="#box-config<?php //echo site_url($value->link);?>">
	        				<i class="fa fa-bar-chart-o fa-2x"></i>
	        				<div><?php echo $value->name;?> <br/>Rp. <?php echo number_format($value->price,2);?></div>
	      				</a>
	       			</div>
	       			<?php } ?>
       			</div></p>       
			</div>
			<div class="tab-pane" id="tab_1_3">
			<p>
			<div id="grid" class="row">
  				<?php
      				$warna = array("btn-danger","btn-primary","btn-info","btn-success","btn-warning","btn-default");
      				$rand_warna = shuffle($warna);
      				$variable = $this->mgeneral->getWhere(array('type'=>2),'tr_marketplace');
      				foreach ($variable as $key => $value) {
      					
  				?>
	    			<div class="col-xs-3 col-sm-3 col-md-2">
	      				<a class="btn <?php echo $warna[$rand_warna];?> btn-icon input-block-level"  data-toggle="modal" href="#box-config<?php //echo site_url($value->link);?>">
	        				<i class="fa fa-bar-chart-o fa-2x"></i>
	        				<div><?php echo $value->name;?> <br/>Rp. <?php echo number_format($value->price,2);?></div>
	      				</a>
	       			</div>
	       			<?php } ?>
			</div>
			</div>
		</div>
	</div>
	<br/>
	
	<style type="text/css">
		body {
	    	overflow-x: hidden;
		}
		#slide-panel {
		    width:400px;
		    
		   	padding-top: 10px;   
		    background:#eee;
		    margin-left:100%;
		    position: absolute;		    
		    right: -400px;
		}
		#opener {
		    float:left;
		  	top:0;
		    margin:-10px -50px 0px -50px;
		    border-radius:0;

		}
		#slide-panel-bawah {
		    width:300px;
		   	padding-top: 10px;   
		    background:#eee;
		    margin-bottom:100%;
		    position: absolute;		    
		    /*bottom: -300px;*/
		}
		#opener-bawah {
		    
		  	top:0;
		    margin:-10px -50px 0px -50px;
		    border-radius:0;
		}
</style>
	<?php echo $template['js_footer']; ?>
	<script>
	function apps () {
		$.ajax({
		url: "<?php echo site_url();?>marketplace/apps/execute/",
		type: "POST",
		dataType:"json",
	
		success:function(data){
			$.pnotify({
				title: data.message,
				text: data.message,
				animation: {
					effect_in: 'show',
					effect_out: 'slide'
				},
				type : "success",
			});
			setInterval(function() {
				window.location.reload();
			}, 1000);
		},
		error: function(){
			$("#msg").slideDown();
		}
	}); 
	}
	$('#market').on('click', function () {
		jQuery("html,body").scrollTop();
           
	});
	 $('#opener').on('click', function () {
     var panel = $('#slide-panel');
     if (panel.hasClass("visible")) {
         panel.removeClass('visible').animate({
             'right': '-400px'
         });
     } else {
         panel.addClass('visible').animate({
             'right': '0'
         });
     }
     return false;
 });
	 	$('#opener-bawah').on('click', function () {
	    	var panel = $('#slide-panel-bawah');
	     if (panel.hasClass("visible")) {
	         panel.removeClass('visible').animate({
	             'bottom': '-300px'
	         });
	     } else {
	         panel.addClass('visible').animate({
	             'bottom': '0'
	         });
	     }
	     return false;
	 });
		jQuery(document).ready(function() {		
			App.setPage("forms");  //Set current page
			/*App.setPage("others"); 
			App.setPage("flot_charts");*/
			App.init(); //Initialise plugins and elements
			
		})
	</script>
</body>
</html>