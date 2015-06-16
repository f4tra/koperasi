
	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-table"></i><?php echo ucfirst($this->uri->segment(2)); ?> </h4> 
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
								<input type="text" value="<?php echo $edit->name;?>" name="name" id="name" class="form-control" placeholder="Name" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Parent:</label> 
							<div class="col-md-4">
								<select name="parent_id" id="parent_id" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php 
								foreach($parent_id as $g){
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
							<label class="col-md-2 control-label">PIC:</label> 
							<div class="col-md-4">
								<select name="user_id" id="user_id" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Not Specified</option>
								<?php 
								foreach($pic as $p){
									if($p->id == $edit->user_id){
										$pp = "selected";
									}else{
										$pp = "";
									}
								?>
									<option  <?php echo $pp;?> value="<?php echo $p->id;?>"><?php echo $p->first_name." ".$p->mid_name." ".$p->last_name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Structural:</label> 
							<div class="col-md-4">							
								<select  name="stc_id" id="stc_id" class="select2-01 col-md-12 full-width-fix">
									<option selected value="0">Unidentify</option>
									<?php 
								foreach($hr_stc as $p){
									if($p->id == $edit->stc_id){
										$pp = "selected";
									}else{
										$pp = "";
									}
								?>
									<option  <?php echo $pp;?> value="<?php echo $p->id;?>"><?php echo $p->code." ".$p->name;?></option>
									<?php } ?>								
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Divisi:</label> 
							<div class="col-md-4">							
								<select  name="div_id" id="div_id" class="select2-01 col-md-12 full-width-fix">
									<option selected value="0">Unidentify</option>
									<?php 
								foreach($hr_div as $p){
									if($p->id == $edit->div_id){
										$pp = "selected";
									}else{
										$pp = "";
									}
								?>
									<option  <?php echo $pp;?> value="<?php echo $p->id;?>"><?php echo $p->code." ".$p->name;?></option>
									<?php } ?>								
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Functional:</label> 
							<div class="col-md-4">							
								<select  name="fnc_id" id="fnc_id" class="select2-01 col-md-12 full-width-fix">
									<option selected value="0">Unidentify</option>
									<?php 
								foreach($hr_fnc as $p){
									if($p->id == $edit->fnc_id){
										$pp = "selected";
									}else{
										$pp = "";
									}
								?>
									<option  <?php echo $pp;?> value="<?php echo $p->id;?>"><?php echo $p->code." ".$p->name;?></option>
									<?php } ?>									
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">WF Type:</label> 
							<div class="col-md-4">							
								<select  name="wf_type_id" id="wf_type_id" class="select2-01 col-md-12 full-width-fix">
									<option selected value="0">Unidentify</option>
									<?php 
										foreach($stc_id as $key => $value) {
											print '<option value="'.$value->id.'">'.$value->code." ".$velue->name.'</option>';
										}
									?>									
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Left:</label> 
							<div class="col-md-4">							
								<input type="text" value="<?php echo $edit->p_left;?>" name="p_left" id="p_left" class="form-control" placeholder="Left" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Top:</label> 
							<div class="col-md-4">							
								<input type="text" value="<?php echo $edit->p_top;?>" name="p_top" id="p_top" class="form-control" placeholder="Top" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Width:</label> 
							<div class="col-md-4">							
								<input type="text" value="<?php echo $edit->p_width;?>" name="p_width" id="p_width" class="form-control" placeholder="Width" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Link:</label> 
							<div class="col-md-4">							
								<input type="text" value="<?php echo $edit->link;?>" name="link" id="link" class="form-control" placeholder="Link" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Tab:</label> 
							<div class="col-md-4">							
								<input type="text" value="<?php echo $edit->tab;?>"name="tab" id="tab" class="form-control" placeholder="Tab" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Duration:</label> 
							<div class="col-md-4">							
								<input type="text" value="<?php echo $edit->durr;?>"name="durr" id="durr" class="form-control" placeholder="Duration" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Icons:</label> 
							<div class="col-md-4">							
								<input type="text" value="<?php echo $edit->icons;?>" name="icons" id="icons" class="form-control" placeholder="ICON" />
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
				url: '<?php echo base_url();?>index.php/organization/structure/execute/update/<?php echo $edit->id;?>',
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
						window.location = "../../index/<?php echo $or_type;?>";
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