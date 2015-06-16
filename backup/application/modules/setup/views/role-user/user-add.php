	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Users </h4> 
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
								<input class="form-control" type="text" name="code" id="code"  placeholder="Nomor Pegawai">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Name:</label> 
							<div class="col-md-4">
								<input class="form-control" type="text" name="first_name" id="first_name"  placeholder="First Name">
								<br/>
								<input class="form-control" type="text" name="mid_name" id="mid_name"  placeholder="Midle Name">
								<br/>
								<input class="form-control" type="text" name="last_name" id="last_name"  placeholder="Last Name">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nick Name:</label> 
							<div class="col-md-4">
								<input class="form-control" type="text" name="nick_name" id="nick_name"  placeholder="Nick Name">								
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Username:</label> 
							<div class="col-md-4">
								<input class="form-control" type="text" name="username" id="username" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password:</label> 
							<div class="col-md-4">
								<input class="form-control" type="password" name="password" id="password" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Email:</label> 
							<div class="col-md-4">
								<input class="form-control" type="email" name="email" id="email" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Role:</label> 
							<div class="col-md-4">
								<select name="role_id" id="role_id" class="select2-01 col-md-12 full-width-fix">
								<?php foreach($role as $r){ ?>
									<option selected value="<?=$r->id;?>"><?=$r->code;?> - <?=$r->name;?></option>
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
									foreach($node as $r){ ?>
									<option selected value="<?=$r->id;?>"><?php echo $r->code; ?></option>
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
										foreach($divisi as $r){ ?>
										<option selected value="<?=$r->id;?>"><?php echo $r->code." ".$r->name; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Notes:</label> 
							<div class="col-md-4">
								<textarea class="form-control" name="descr" id="descr"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Active:</label> 
							<div class="col-md-4">
								<select class="form-control" name="active" id="active" class="select2-01 col-md-12">
									<option selected value="1">Active</option>
									<option value="0">Inctive</option>
								</select>
							</div>
						</div>						
						<input type="submit" class="btn btn-info btn-lg pull-right" onclick="save(this);" value="Save"/>
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

/* $(function() {
	$("#role").change(function() {
		var provinsi =$(this).val();
		var dataString = 'account='+provinsi;
		$.ajax({
			type: "POST",
			url: '<?php echo base_url();?>index.php/setup/user/GetAcount',
			data: dataString,
			cache: false,
			success: function(html) {
				$("#kasnet").html(html);
			} 
		});
	});
}); */

// Fungsi Untuk Tambah Data
function save(){
	$('#form').validate({
	    rules: {
	      nick_name: {
	        minlength: 4,
	        required: true
	      },
	      username: {
	        required: true,
	        minlength: 5
	      },
		  password: {
	        required: true,
	        minlength: 6
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
				url: '<?php echo base_url();?>index.php/setup/user/execute/save',
				type: "POST",
				dataType:"json",
				data: $("#form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
					$.pnotify({
								title: 'User Created',
								text: 'User Created',
								animation: {
									effect_in: 'show',
									effect_out: 'slide'
								},
								type : "success",
							});
							
							setInterval(function() {
								
								window.location = "./";
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