		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo site_url('/'); ?>"><?php echo $title ?></a>
				</div>
				<div class="collapse navbar-collapse">
					<?php 
					$menus = $this->config->item('main_nav');
					?>
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
			<?php if (isset($auth_user)): ?>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<?php
					$name = $auth_user['first_name'] . ' ' . $auth_user['last_name'];
					if (strlen(trim($name)) == 0)
						$name = $auth_user['username'];
					?>
					<a href="<?php echo site_url('authorize/user/profile'); ?>"><?php echo $name; ?></a>
				</li>
				<li class="divider-vertical"></li>
				<li>
					<a href="<?php echo site_url('authorize/logout'); ?>"><?php echo lang('logout'); ?></a>
				</li>
			</ul>
			<?php else: ?>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="<?php echo site_url('authorize'); ?>"><?php echo lang('login'); ?></a>
				</li>
			</ul>
			<?php endif; ?>
		</div><!--/.nav-collapse -->
	</div>
</div>