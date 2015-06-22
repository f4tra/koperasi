<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-cog"></i>Users </h4> 
					
				</div>
				<div class="box-body">


					<?php echo messages(); ?>
					<form class="form-horizontal box" method="post">
						<fieldset>
							<legend><?php echo lang('account'); ?></legend>
							<?php echo $form->fields(); ?>
						</fieldset>
						<?php echo form_actions(array(
							array(
								'id'	=> 'save-button',
								'value' => lang('save'),
								'class' => 'btn-primary'
							),
							array(
								'id'	=> 'cancel-button',
								'value'	=> lang('cancel')
							)
						)); ?>
					</form>
				</div>
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
