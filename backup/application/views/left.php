<?php if (isset($auth_user)): ?>
<div class="media user-media">
    <a class="user-link" href="">
        <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url();?>assets/img/user.gif">
        <span class="label label-danger user-label">16</span>
    </a>

    <div class="media-body">
        <h5 class="media-heading">Archie</h5>
        <ul class="list-unstyled user-info">
            <?php
				$name = $auth_user['first_name'] . ' ' . $auth_user['last_name'];
				if (strlen(trim($name)) == 0)
					$name = $auth_user['username'];
			?>
			<li><a href="<?php echo site_url('auth/user/profile'); ?>"><?php echo $name; ?></a></li>			
            <li>Last Access : <br>
                <small><i class="icon-calendar"></i> 16 Mar 16:32</small>
            </li>
        </ul>
    </div>
</div>
<?php endif; ?>
<!-- #menu -->
<ul id="menu" class="collapse">
    <li class="nav-header">Menu</li>
    <li class="nav-divider"></li>
	<?php
		$menus = $this->config->item('main_nav');
		foreach($menus as $url => $label):
				if (!$this->acl->is_allowed($url)) continue;
				if (is_array($label)):
			?>
			<li class="panel<?php if (substr(uri_string(), 0, strlen($url)) == $url) echo ' active'; ?>">
			<a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#<?php echo ucwords($url); ?>-nav">
				<b class="icon-pencil"><?php echo ucwords($url); ?>
				<span class="pull-right"><i class="icon-angle-left"></i></span>
				</b>
			</a>
				<ul class="collapse" id="<?php echo ucwords($url); ?>-nav">
					<?php foreach($label as $sub_url => $sub_label): ?>
						<?php if (!$this->acl->is_allowed($sub_url)) continue; ?>
						<li <?php if (substr(uri_string(), 0, strlen($sub_url)) == $sub_url) echo 'class="active"'; ?>>
							
							<a href="<?php echo site_url($sub_url); ?>"><i class="icon-angle-right"></i><?php echo $sub_label; ?></a>
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
				
   
    <li class="nav-divider"></li>
	<?php 
	//var_dumps($auth_users);
	if(isset($auth_user)){?>
	<li><a href="<?php echo site_url('auth/logout'); ?>"><i class="icon-signin"></i> <?php echo lang('logout'); ?></a></li>
	<?php }else{ ?>
    <li><a href="<?php echo site_url('auth/login'); ?>"><i class="icon-signin"></i> <?php echo lang('login'); ?></a></li>
	<?php } ?>
</ul>
<!-- /#menu -->