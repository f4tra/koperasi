
<!-- TREE VIEW -->
						<div class="row">
							<div class="col-md-6">
								<!-- BOX -->
								<div class="box border red">
									<div class="box-title">
										<h4><i class="fa fa-sitemap"></i>	<?php echo lang('rule_page_name'); ?></h4>
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
<?php echo messages(); ?>
										<?php
			function display_tree($tree, $acl)
			{
				foreach($tree as $node)
				{
					echo '<li>';
					if (isset($node['children']))
						echo '<span class="toggle"></span>';
						if($acl->is_allowed('acl/rule/edit'))
						{
							echo '<a href="' . site_url('acl/rule/edit') . '/' . $node['id'] . '?redirect=' . urlencode(current_url_params()) . '" class="users">';
							echo '<span>' . $node['name'] . '</span>';
							echo '</a>';
						} else {
							echo '<span>' . $node['name'] . '</span>';
						}
					if (isset($node['children']))
					{
						echo '<ul>';
						display_tree($node['children'], $acl);
						echo '</ul>';
					}
					echo '</li>';
				}
			}
		?>
		<ul class="arbo">
			<?php display_tree($role_tree, $acl); ?>
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
