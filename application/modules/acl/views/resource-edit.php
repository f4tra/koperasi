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

			<?php if (!$isAjax): ?>

			
			<?php if($acl->is_allowed('acl/resource/add')){ ?>
			<a href="<?php echo site_url('acl/resource/add') ?>?redirect=<?php echo urlencode(current_url_params()); ?>"  title="<?php echo lang('resource_add_title'); ?>">
				<i class="fa fa-plus"></i> <?php echo lang('resource_add_title'); ?>
			</a>
			<?php 
			} 
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

<?php endif; ?>
			</div>
		</div>
		<!-- /BOX -->		
	</div>
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
			<?php echo form_open_multipart(uri_string(), array('class' => 'form-horizontal', 'id' => 'resource-form', 'name' => 'resource-form')); ?>
			<?php 
			echo form_hidden(array('id' => set_value('id', isset($resource->id) ? $resource->id : '')));
			if (isset($redirect))
				echo form_hidden(array('redirect' => $redirect));
			?>
			<fieldset>
				<legend><?php echo lang('resource_page_name'); ?></legend>
				<div class="form-group">
					<?php echo form_label(lang('resource_name'), 'name', array('class' => 'col-sm-2 control-label required')); ?>
					<div class="col-sm-10">
						<?php echo form_input(array(
							'name'		=> 'name',
							'id'		=> 'name',
							'value'		=> set_value('name', isset($resource->name) ? $resource->name : ''),
							'maxlength'	=> '255',
							'class'		=> 'form-control' . (form_error('name') ? ' error' : '')
						)); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo form_label(lang('resource_type'), 'type', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-10">
						<?php
						echo form_dropdown('type', 
							array(
								'module'		=> 'Module',
								'controller'	=> 'Controller',
								'action'		=> 'Action',
								'other'			=> 'Other'
							),
							set_value('type', isset($resource->type) ? $resource->type : 'other'),
							'class="form-control"'
						);
						?>
					</div>
				</div>
				<div class="form-group">
					<?php echo form_label(lang('resource_parent'), 'parent', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-10">
					<?php
					function generate_options($tree, $sep = '')
					{
						$result = array();
						foreach($tree as $node)
						{
							$result[$node['id']] = $sep . $node['name'];
							if (isset($node['children']))
								$result = $result + generate_options($node['children'], $sep . '&nbsp;&nbsp;');
						}
						return $result;
					}
					$parents = array(0 => '(' . lang('resource_parent_none') . ')') + generate_options($resource_tree);
					if (isset($resource->id) && isset($parents[$resource->id]))
						unset($parents[$resource->id]);
					echo form_dropdown('parent', 
						$parents, 
						set_value('parent', isset($resource->parent) ? $resource->parent : 0),
						'class="form-control"'
					);
					?>
					</div>
				</div>
			</fieldset>
			<?php if (!$isAjax): ?>
			<div class="form-actions">
				<?php 
				if($acl->is_allowed('acl/resource/edit')){
					echo form_button(array(
						'type' => 'submit',
						'name' => 'save_task',
						'value' => 'save',
						'content' => lang('save'),
						'class' => 'btn btn-primary'
					));
				}
				?>
				<?php
				if (isset($resource->id) && $acl->is_allowed('acl/resource/delete'))
				{
					$delete_url = site_url('acl/resource/delete/' . $resource->id) . '?redirect=' . urlencode($redirect);
					echo form_confirmwindow('delete-confirm', lang('delete'), lang('delete'), lang('resource_delete_confirm'), $delete_url);
				}
				?>
				<a href="<?php echo site_url('acl/resource'); ?>" class="btn btn-default"><?php echo lang('cancel') ?></a>
			</div>
			<?php endif; ?>
		<?php echo form_close(); ?>
<?php if (! $isAjax): ?>
	
<?php endif; ?>
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
