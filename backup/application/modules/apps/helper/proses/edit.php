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
								<input type="text" name="code" id="code" value="<?php echo $edit->code; ?>" readonly="readonly" class="form-control" placeholder="<?php echo $type_name;?>" />
							</div>							
                            <div class="col-md-3">
                            	<div class="input-group">
                                	<input type="text" value="<?php echo $edit->start_date; ?>"name="start_date" id="start_date" class="form-control" data-mask="99/99/9999"><span class="input-group-btn"> <button class="btn btn-primary" id="btndp" type="button"><i class="fa fa-calendar" ></i> Date</button> </span>
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
						 			$result = $this->mgeneral->getwhere(array('ipo_id'=>$ipo_id,'type_id'=>$type_id1,'parent_id'=>0),"tt_input"); 
						 			
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
						 			$result = $this->mgeneral->getwhere(array('ipo_id'=>$ipo_id1,'type_id'=>3,'prev_id <>'=>0),"tt_input"); 
						 			
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
						 			$result = $this->mgeneral->getwhere(array('ipo_id'=>$ipo_id,'type_id'=>$type_id1,'prev_id <> '=>0),"tt_input"); 
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
								<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"><?php echo $edit->descr;?> </textarea>
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
					<!-- Start Table Bawah -->
					<?php if($ipo_id ==1 and $type_id ==1){?>
						<div class="box border inverse">
							<div class="box-title">
								<h4><i class="fa fa-money"></i><?php echo $type_name; ?></h4>
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
								  <div class="sparkline-row">
										<form method="post" name="bawah" id="bawah" action="">
							          <table border="1" width="100%" cellpadding="0" cellspacing="0">
							            <tr bgcolor="#999999"> 
							              <td   valign="middle" align="center" >No. </td>
							              <td  valign="middle" align="center" >Items</td>
							              <td  align="center"  valign="middle" >Harga Jual</td>
							              <td  align="center"  valign="middle" >Harga Promo</td>
							              <td  align="center"  valign="middle" >UOM</td>
							              <td  align="center"  valign="middle" >QTY</td>
							              <td align="center"  valign="middle" >Total</td>
							              <td  align="center"  valign="middle" >Option</td>
							            </tr>
							            <?php
							            	$no = 1;
							            	$result = $this->mgeneral->getwhere(array('ipo_id'=>$ipo_id,'parent_id'=>$idx,'type_id'=>$type_id),'tt_proses');
							            	foreach ($result as $key => $value) {
							            		$id2 	 = $value->id;
							            		$qty 	 = $value->qty;
							            		$item_id = $value->item_id;
							            		$price_2 = $value->price2;
							            		$price_3 = $value->price3;
							            		$price_5 = $value->price5;
							            		$no++;
							            	}
							            ?>

							            <tr>
							            	<td   valign="middle" align="center" ><?php //echo $no; ?></td>
							              	<td  valign="middle" align="center" >
							        		
							              		<select class="select2-01 col-md-10" name="item_id" id="item_id">
													<option value="0">Select Product</option>
													<?php 
														$variable = $this->mgeneral->getwhere(array('ipo_id'=>$ipo_id),'tr_item');
														foreach ($variable as $key => $value) {
														echo "<option value='".$value->id."'>".$value->code."</option>";
													}?>
												</select>						
							              	</td>
							              	<td  align="center"  valign="middle" ></td>
								            <td  align="center"  valign="middle" ></td>
								            <td  align="center"  valign="middle" ></td>
								            <td  align="center"  valign="middle" ><input size="5" type="text" name="qty" class="form-control" id="qty" /></td>
								            <td align="center"  valign="middle" >
								            <?php 
								            	if($type_id >1){
								              		echo "<input type='text' name='price4' id='price4'/>";
								              	}
								            ?>
								            </td>
								            <td  align="center"  valign="middle" ><input onclick="bawah(this);" type="submit" value="Save" class="btn btn-xs btn-success"/></td>	
								        </tr>
							           </table>
								           </form>
           						
           						</div>
           					</div>
           				</div>
					<?php } ?>
					<!-- End Table Bawah -->
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
function bawah(){
	alert("sdf");
}
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
				url: '<?php echo base_url();?>index.php/apps/ajax/index/save/<?php //echo $edit->id;?>',
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