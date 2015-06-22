<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-cog"></i>Users Management </h4> 
					<div class="tools hidden-xs">					
						<a href="<?php echo site_url('authorize/user/add'); ?>" class="btn btn-warning btn-xs"><?php echo lang('add'); ?></a>
						<br/>
					</div>	
				</div>
				<div class="box-body">		
					<?php echo $this->pagination->create_links(); ?>
					<div class="table-responsive">
						
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><?php echo lang('first_name'); ?></th>
								<th><?php echo lang('last_name'); ?></th>
								<th><?php echo lang('username'); ?></th>
								<th><?php echo lang('email'); ?></th>
								<th>Role</th>
								<th><?php echo lang('registered'); ?></th>
								<th style="width: 36px;"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$this->load->model('acl/role_model');
							?>
							<?php foreach($users as $user): ?>
							<tr>
								<td><?php echo $user->first_name ?></td>
								<td><?php echo $user->last_name ?></td>
								<td><a href="<?php echo site_url('authorize/user/edit/' . $user->id); ?>"><?php echo $user->username ?></a></td>
								<td><?php echo $user->email ?></td>
								<td>
									<?php
									$role = $this->role_model->get_by_id($user->role_id);
									if ($role)
										echo $role->name;
									else
										echo '-';
									?>
								</td>
								<td><?php echo date('d M Y H:i:s', strtotime($user->registered)); ?></td>
								<td><a href="<?php echo site_url('authorize/user/delete/' . $user->id); ?>" title="<?php echo lang('delete'); ?>" class="btn" data-button="delete"><i class="fa fa-trash-o"></i></a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					</div>
					<?php $this->load->view('delete-modal'); ?>
				</div>
			</div>		
		</div>
	</div>	
<!-- /PAGE table -->		
<div class="separator"></div>
<div class="footer-tools">
	<span class="go-top"><i class="fa fa-chevron-up"></i> Top </span>
</div>
	