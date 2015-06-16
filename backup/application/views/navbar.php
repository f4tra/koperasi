<!-- .navbar -->
<nav class="navbar navbar-inverse navbar-static-top">
    <!-- Brand and toggle get grouped for better mobile display -->
    <header class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
      </button>
      <a href="index.html" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo.png" alt=""></a>
  </header>
    
	<?php 
			$menus = $this->config->item('main_nav');
		?>
    <div class="topnav">
	<?php if (isset($auth_user)): ?>
		
        <div class="btn-toolbar">
            <div class="btn-group">
                <a data-placement="bottom" data-original-title="Show / Hide Sidebar" data-toggle="tooltip" class="btn btn-success btn-sm" id="changeSidebarPos">
                    <i class="icon-resize-horizontal"></i>
                </a>
            </div>
            <div class="btn-group">
                <a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip" class="btn btn-default btn-sm">
                    <i class="icon-envelope"></i>
                    <span class="label label-warning">5</span>
                </a>
                <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                    <i class="icon-comments"></i>
                    <span class="label label-danger">4</span>
                </a>
            </div>
            <div class="btn-group">
                <a data-placement="bottom" data-original-title="Document" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                    <i class="icon-file"></i>
                </a>
                <a data-toggle="modal" data-original-title="Help" data-placement="bottom" class="btn btn-default btn-sm" href="#helpModal">
                    <i class="icon-question-sign"></i>
                </a>
            </div>
            <div class="btn-group">
                
				<a href="<?php echo site_url('auth/logout'); ?>" data-toggle="tooltip" data-original-title="<?php echo lang('logout'); ?>" data-placement="bottom" class="btn btn-metis-1 btn-sm">
		  <i class="icon-off"></i>
                </a>
            </div>
        </div>
		
		 <?php endif; ?>
    </div>

    <!-- /.topnav -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <!-- .nav -->
		
        <ul class="nav navbar-nav">
            <?php
				foreach($menus as $url => $label):
				if (!$this->acl->is_allowed($url)) continue;
				if (is_array($label)):
			?>
			<li class="dropdown<?php if (substr(uri_string(), 0, strlen($url)) == $url) echo ' active'; ?>">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ucwords($url); ?><b class="caret"></b></a>
				<ul class="dropdown-menu">
					<?php foreach($label as $sub_url => $sub_label): ?>
						<?php if (!$this->acl->is_allowed($sub_url)) continue; ?>
						<li <?php if (substr(uri_string(), 0, strlen($sub_url)) == $sub_url) echo 'class="active"'; ?>>
							<a href="<?php echo site_url($sub_url); ?>"><?php echo $sub_label; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
			</li>
				<?php
				else:
				?>
				<li <?php if (substr(uri_string(), 0, strlen($url)) == $url) echo 'class="active"'; ?>>
				<a href="<?php echo site_url($url); ?>"><?php echo $label; ?></a>
				</li>
				<?php endif; ?>
				<?php endforeach; ?>
		</ul>
        
        <!-- /.nav -->
    </div>
</nav>
<!-- /.navbar -->