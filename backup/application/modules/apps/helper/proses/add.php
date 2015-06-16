	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-reorder"></i><?php //echo $this->uri->segment(2); ?></h4> 					
				</div>
				<div class="box-body">
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form">
						<div class="form-group">
							<label class="col-md-2 control-label">No. <?php echo $type_name;?> :</label> 
							<div class="col-md-4">
								<input type="text" name="code" id="code" value="<?php echo $code; ?>" readonly="readonly" class="form-control" placeholder="<?php echo $type_name;?>" />
							</div>							
                            <div class="col-md-3">
                            	<div class="input-group">
                                	<input type="text" name="start_date" id="start_date" class="form-control" data-mask="99/99/9999"><span class="input-group-btn"> <button class="btn btn-primary" id="btndp" type="button"><i class="fa fa-calendar" ></i> Date</button> </span>
                                </div>                                                                                                                   
                            </div>
						</div>
						<?php 
						if($ipo_id == 1 and $type_id > 1){?>
						<div class="form-group">
							<label class="col-md-2 control-label">No. <?php echo $type_name_one;?>:</label> 
							<div class="col-md-4">
						
								<select  size="1" name="prev"  id="prev" class="select2-01 col-md-12">
						 		<option selected  value="0">-= UNIDENTIFY =-</option>
						 		<?php
						 			$result = $this->mgeneral->getwhere(array('ipo_id'=>$ipo_id,'type_id'=>$type_id1,'parent_id'=>0),"tt_proses"); 
						 			
						 			foreach ($result as $key => $value) {
						 				echo "<option value='".$value->id."'>".$value->code."</option>";
						 			}
						 		?>
						 		</select>
							</div>
						</div>
						<?php }elseif ($ipo_id == 1 and $type_id ==1) { ?>
						<div class="form-group">
							<label class="col-md-2 control-label">Costomer Name:</label> 
							<div class="col-md-4">
								<select class="form-control" name="custom_id" id="custom_id">
									<option value="0">Not Spesicification</option>
									<?php 
									$variable = $this->mgeneral->getwhere(array('grp_id'=>3),'tr_company');
									foreach ($variable as $key => $value) {
										echo "<option value='".$value->id."'>".$value->name."</option>";
									}?>
								</select>
							</div>
						</div>
						<?php }elseif ($ipo_id > 1 and $type_id ==1) {
						?>
						<div class="form-group">
							<label class="col-md-2 control-label">No. <?php echo $type_name_one;?>:</label> 
							<div class="col-md-4">
								
								<select  size="1" name="prev"  id="prev" class="select2-01 col-md-12">
						 		<option selected value="0">-= UNIDENTIFY =-</option>
						 		<?php
						 			$result = $this->mgeneral->getwhere(array('ipo_id'=>$ipo_id1,'type_id'=>3,'prev_id <>'=>0),"tt_proses"); 
						 			
						 			foreach ($result as $key => $value) {
						 				echo "<option value='".$value->id."'>".$value->code."</option>";
						 			}
						 		?>
						 		</select>
							</div>
						</div>
						<?php }else{ ?>
						<div class="form-group">
							<label class="col-md-2 control-label">No. <?php echo $type_name_one;?>:</label> 
							<div class="col-md-4">
								<select  size="1" name="prev"  id="prev" class="select2-01 col-md-12">
						 		<option selected value="0">-= UNIDENTIFY =-</option>
						 		<?php
						 			$result = $this->mgeneral->getwhere(array('ipo_id'=>$ipo_id,'type_id'=>$type_id1,'prev_id <> '=>0),"tt_proses"); 
						 			foreach ($result as $key => $value) {
						 				echo "<option value='".$value->id."'>".$value->code."</option>";
						 			}
						 		?>
						 		</select>
							</div>
						</div>
						<?php } ?>
						<div class="form-group">
							<label class="col-md-2 control-label">Description:</label> 
							<div class="col-md-4">
								<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"></textarea>
							</div>
						</div>						
						<div class="form-group">
							<label class="col-md-2 control-label">Active:</label> 
							<div class="col-md-4">
								<select class="form-control" name="active" id="active">
									<option selected value="1">Active</option>
									<option value="0">Inctive</option>
								</select>
							</div>
						</div>
						<input type="hidden" value="<?php echo $ipo_id;?>" name="ipo_id" id="ipo_id">
						<input type="hidden" value="<?php echo $type_id;?>" name="type_id" id="type_id">
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
$(function() {
    
    $( "#start_date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });   
    $("#btndp").click(function () {
       $("#start_date" ).datepicker("show");
    });
    
            
  });
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
				//INPUT.ASP?Act=Save&vId=&GUI=35&Tab=0&IPOId=1&TypeId=1
				url: "<?php echo site_url();?>apps/ajax_proses/index/save/",
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
						window.location = "<?php echo site_url('apps/proses/index/list').'/'.$ipo_id.'/'.$type_id;?>";
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