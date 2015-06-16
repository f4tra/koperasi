	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>User </h4> 
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
						<div class="form-group">
							<label class="col-md-2 control-label">Nomor Pegawai:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->code; ?>" class="form-control" type="text" name="code" id="code"  placeholder="Nomor Pegawai">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Name:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->first_name; ?>"class="form-control" type="text" name="first_name" id="first_name"  placeholder="First Name">
								<br/>
								<input value="<?php echo $edit->mid_name; ?>" class="form-control" type="text" name="mid_name" id="mid_name"  placeholder="Midle Name">
								<br/>
								<input value="<?php echo $edit->last_name; ?>" class="form-control" type="text" name="last_name" id="last_name"  placeholder="Last Name">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nick Name:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->nick_name; ?>" class="form-control" type="text" name="nick_name" id="nick_name"  placeholder="Nick Name">								
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Username:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->username; ?>" class="form-control" type="text" name="username" id="username" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password:</label> 
							<div class="col-md-4">
								<input class="form-control" type="password" name="password" id="password" placeholder="Password">
								<span>Kosongkan Jika tidak ingin dirubah</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Email:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->email1; ?>" class="form-control" type="email" name="email" id="email" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Role:</label> 
							<div class="col-md-4">
								<select name="role_id" id="role_id" class="select2-01 col-md-12 full-width-fix">
								<?php foreach($role as $r){
									if($r->id == $edit->role_id){
										$a = "selected";
									}
									else{$a="";}
								?>
									<option <?php echo $a;?> value="<?=$r->id;?>"><?=$r->name;?></option>
									<?php } ?>
								</select>								
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Node Locator:</label> 
							<div class="col-md-4">
								<select name="node_id" id="node_id" class="select2-01 col-md-12 full-width-fix">
									<option value="0">Unidentify</option>
								<?php 
								foreach($node as $r){
									if($r->id == $edit->node_id){
										$a = "selected";
									}
									else{$a="";}
								?>
									<option <?php echo $a;?> value="<?=$r->id;?>"><?=$r->code;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label">Divisi:</label> 
							<div class="col-md-4">
								<select name="divisi" id="divisi" class="select2-01 col-md-12 full-width-fix">
									<option value="0">Unidentify</option>
									<?php 									
									foreach($divisi as $r){
										if($r->id == $edit->div_id){
											$a = "selected";
										}
										else{$a="";}
								?>
									<option <?php echo $a;?> value="<?=$r->id;?>"><?=$r->code;?> - <?=$r->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Notes:</label> 
							<div class="col-md-4">
								<textarea class="form-control" name="descr" id="descr"><?php echo $edit->descr;?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Active:</label> 
							<div class="col-md-4">
								<select class="form-control" name="active" id="active" class="select2-01 col-md-12">
									<option <?php if($edit->active == 1){echo "selected";}else{echo "";}?> value="1">Active</option>
									<option <?php if($edit->active == 0){echo "selected";}else{echo "";}?> value="0">Inctive</option>
								</select>
							</div>
						</div>	

						<input type="submit" class="btn btn-info btn-lg pull-right" onclick="edit(this);" value="Save"/>
					</form>
					<div class="row"></div>
					<br />
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
function edit(){
	$('#form').validate({
	    rules: {
	       nick_name: {
	        minlength: 4,
	        required: true
	      },
	      username: {
	        required: true,
	        minlength: 4
	      },
		  
		  email: {
	        required: true,	        
			email:true,
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
				url: '<?php echo base_url();?>index.php/setup/user/execute/update/<?=$edit->id;?>',
				type: "POST",
				dataType:"json",
				data: $("#form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
					$.pnotify({
								title: 'User Edited',
								text: 'User Edited',
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