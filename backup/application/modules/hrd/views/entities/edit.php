
	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-preorder"></i>Entities </h4> 
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
							<label class="col-md-2 control-label">Code:</label> 
							<div class="col-md-4">
								<input type="text" value="<?php echo $edit->code;?>" name="code" id="code" class="form-control" placeholder="Code" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Name:</label> 
							<div class="col-md-4">
								<input type="text" value="<?php echo $edit->name;?>" name="name" id="name" class="form-control" placeholder="Code" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Category:</label> 
							<div class="col-md-4">
								<select name="ctg" id="ctg" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php 
								foreach($ctg as $g){
									if($g->id == $edit->ctg_id){
										$a = "selected";
									}else{
										$a = "";
									}
								?>
									<option  <?php echo $a?> value="<?php echo $g->id;?>"><?php echo $g->code." ".$g->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Group / Type:</label> 
							<div class="col-md-4">
								<?php
									if(empty($grp_id) and empty($type_id)){

									//echo $grp_id->name." / ".$type_id->name;
									}else{
										
									echo $grp_id->name." / ".$type_id->name;
									} 	
								?>
									
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Company ID:</label> 
							<div class="col-md-4">
								<select name="parent" id="parent" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php 
								foreach($company as $g){
									if($g->id == $edit->parent_id){
										$a = "selected";
									}else{
										$a = "";
									}
								?>
									<option  <?php echo $a?> value="<?php echo $g->id;?>"><?php echo $g->code." ".$g->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Key Person:</label> 
							<div class="col-md-4">
								<select name="user" id="user" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Not Specified</option>
								<?php 
								foreach($user as $g){
									if($g->id == $edit->pic_id){
										$a = "selected";
									}else{
										$a = "";
									}
								?>
									<option  <?php echo $a?> value="<?php echo $g->id;?>"><?php echo $g->first_name." ".$g->mid_name." ".$g->last_name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Phone 1:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->phone1; ?>" type="text" name="phone1" id="phone1" class="form-control" placeholder="Phone 1" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Phone 2:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->phone2; ?>" type="text" name="phone2" id="phone2" class="form-control" placeholder="Phone 2" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Fax 1:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->fax1; ?>" type="text" name="fax1" id="fax1" class="form-control" placeholder="Fax 1" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Fax 2:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->fax2; ?>"  type="text" name="fax2" id="fax2" class="form-control" placeholder="Fax 2" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Zip 1:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->zip1; ?>"  type="text" name="zip1" id="zip1" class="form-control" placeholder="Zip 1" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Zip 2:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->zip2; ?>" type="text" name="zip2" id="zip2" class="form-control" placeholder="Zip 2" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Email 1:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->email1; ?>" type="email" name="email1" id="email1" class="form-control" placeholder="Email 1" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Email 2:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->email2; ?>" type="email" name="email2" id="email2" class="form-control" placeholder="Email 2" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Address 1:</label> 
							<div class="col-md-4">
								<textarea name="addr1" id="addr1" cols="30" rows="10" class="form-control"><?php echo $edit->address1; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Address 2:</label> 
							<div class="col-md-4">
								<textarea name="addr2" id="addr2" cols="30" rows="10" class="form-control"><?php echo $edit->address2; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Description:</label> 
							<div class="col-md-4">
								<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"><?php echo $edit->descr;?> </textarea>
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

// Fungsi Untuk Tambah Data
function save(){
	$('#form').validate({
	    rules: {
	      code: {	        
	        required: true
	      },
	      name: {
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
				url: '<?php echo base_url();?>index.php/organization/entities/execute/update/<?php echo $edit->id;?>',
				type: "POST",
				dataType:"json",
				data: $("#form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
				
					$.pnotify({
						title: data.message,
						text: data.message,
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