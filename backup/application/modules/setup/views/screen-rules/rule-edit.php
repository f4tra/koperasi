
	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Role GUI </h4> 
					<div class="tools hidden-xs">
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
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form">
						<?php foreach($edit as $e):?>
						<div class="form-group">
							<label class="col-md-2 control-label">Name:</label> 
							<div class="col-md-4">
								<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?php echo $e->name;?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Role:</label> 
							<div class="col-md-4">
								<select class="form-control" name="role_id" id="role_id" class="select2-01 col-md-12">
								<?php foreach($role as $r){ 
									if($r->id == $e->role_id){
										$mm ="selected";
									}else{
										$mm= "";
									}
								?>
									<option <?php echo $mm;?> value="<?=$r->id;?>"><?=$r->code;?> <?=$r->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">GUI:</label> 
							<div class="col-md-4">
								<select class="select2-01 col-md-12 full-width-fix" name="gui_id" id="gui_id">
								<?php foreach($gui as $g){
									if($g->id == $e->gui_id){
										$m ="selected";
									}else{
										$m= "";
									}
								?>
									<option <?php echo $m;?> value="<?=$g->id;?>"><?=$g->code;?> - <?=$g->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Active:</label> 
							<div class="col-md-4">
								<select class="form-control" name="active" id="active" class="select2-01 col-md-12">
									<option <?php if($e->active == 1){echo "selected";}else{echo "";}?> value="1">Active</option>
									<option <?php if($e->active == 0){echo "selected";}else{echo "";}?> value="0">Inctive</option>
								</select>
							</div>
						</div>
						<input type="submit" class="btn btn-info btn-lg pull-right" onclick="save(this);" value="Save"/>
					<?php endforeach;?>
					</form>
					<hr />
					<div id="msg"></div>
					<!-- /Form-->
				</div>
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
		
	
	</div>
</div>
<script type="text/javascript">

// Fungsi Untuk Tambah Data
function save(){
	$('#form').validate({
	    rules: {
	      role_id: {
	        
	        required: true
	      },
	      gui_id: {
	        required: true,
	      },
	    },
		highlight: function(element) {
			$(element).closest('.control-group').removeClass('success').addClass('error');
		},
		success: function(element) {
			element
			.text('OK!').addClass('valid')
			.closest('.control-group').removeClass('error').addClass('success');
		},
		submitHandler: function(form){
			$.ajax({
				url: '<?php echo base_url();?>index.php/setup/rule/execute/update/<?=$e->id;?>',
				type: "POST",
				dataType:"json",
				data: $("#form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
				
					$.pnotify({
								title: 'Rule Edited',
								text: 'Rule Edited',
								animation: {
									effect_in: 'show',
									effect_out: 'slide'
								},
								type : "success",
							});
							
							setInterval(function() {
								
								window.location = "../";
							}, 1000);
					
				},
				error: function(){
					$("#msg").slideDown();
				}
			}); 
		},			
		debug:true
	});	
} 
</script>

<style type="text/css">
	label.valid {
		width: 24px;
		height: 24px;
		display: inline-block;
		text-indent: -9999px;
	}
	label.error {
		font-weight: bold;
		color: red;
		padding: 2px 8px;
		margin-top: 2px;
	}
</style>