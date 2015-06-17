<!-- TREE VIEW -->
<div class="row">
	<div class="col-md-6">
	<!-- BOX -->
	<div class="box border red">
		<div class="box-title">
		<h4><i class="fa fa-sitemap"></i>	<?php echo lang('resource_page_name'); ?></h4>
		<div class="tools">
											<a href="#box-config" data-toggle="modal" class="config">
												<i class="fa fa-cog"></i>
											</a>
											<a href="javascript:;" class="reload">
												<i class="fa fa-refresh"></i>
											</a>
											<a href="javascript:;" class="collapse">
												<i class="fa fa-chevron-up"></i>
											</a>
											<a href="javascript:;" class="remove">
												<i class="fa fa-times"></i>
											</a>
		</div>
		</div>
		<div class="box-body">

		<?php if($acl->is_allowed('acl/resource/add')){ ?>
		<a href="<?php echo site_url('acl/resource/add') ?>?redirect=<?php echo urlencode(current_url_params()); ?>" class="btn" title="<?php echo lang('resource_add_title'); ?>">
			<i class="fa fa-plus"></i> <?php echo lang('resource_add_title'); ?>
		</a>
		<?php } ?>
		<?php
		function display_tree($tree, $curr_id = 0, $acl)
		{
			foreach($tree as $node)
			{
				echo '<li>';
				if (isset($node['children']))
					echo '<span class="toggle"></span>';
				$class = $node['type'];
				if ($node['id'] == $curr_id)
					$class .= ' current';
					if($acl->is_allowed('acl/resource/edit')){
						echo '<a href="' . site_url('acl/resource/edit') . '/' . $node['id'] . '?redirect=' . urlencode(site_url('acl/resource')) . '" class="' . $class . '">';
						echo '<span>' . $node['name'] . '</span>';
						echo '</a>';
					}else{
						echo '<span>' . $node['name'] . '</span>';
					}
				if (isset($node['children']))
				{
					echo '<ul>';
					display_tree($node['children'], $curr_id, $acl);
					echo '</ul>';
				}
				echo '</li>';
			}
		}
		?>
		<ul class="arbo">
			<?php display_tree($resource_tree, (isset($resource->id) ? $resource->id : 0), $acl); ?>
		</ul>
						</div>
								</div>
								<!-- /BOX -->
							</div>
							
						</div>
						<!-- /TREE VIEW  -->
						<div class="separator"></div>
						<div class="footer-tools">
							<span class="go-top">
								<i class="fa fa-chevron-up"></i> Top
							</span>
						</div>

