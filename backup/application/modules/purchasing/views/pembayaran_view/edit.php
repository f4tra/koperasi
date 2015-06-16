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
					<form class="form-horizontal row-border"  method="post" id="form" name="form">
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
						<?php }elseif ($ipo_id == 1 and $type_id ==1) {
							# code...
						}elseif ($ipo_id > 1 and $type_id ==1) {
						?>
						<div class="form-group">
							<label class="col-md-2 control-label">No. <?php echo $type_name_one;?>:</label> 
							<div class="col-md-4">
								<select  size="1" name="prev"  id="prev" class="select2-01 col-md-12">
						 		<option selected value="0">-= UNIDENTIFY =-</option>
						 		<?php
						 			$result = $this->mgeneral->getwhere(array('ipo_id'=>$ipo_id1,'type_id'=>3,'prev_id <>'=>0),"tt_input"); 
						 			
						 			foreach ($result as $key => $value) {
						 				if($edt->prev_id == $value->id)
						 					$a = "selected";
						 				else
						 					$a = "";
						 				echo "<option ".$selected." value='".$value->id."'>".$value->code."</option>";
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
							<label class="col-md-2 control-label">Notes:</label> 
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
					<!-- 
					/* Start Table Bawah
					/* Awal dari start table
					 -->
					<?php if($ipo_id ==1 and $type_id ==1){?>
						<form action="f" name="form_atas" method="GET" id="form_atas">
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
									<span class="title">
            					
            						
							          <table border="1" width="100%" cellpadding="0" cellspacing="0">
							     		<tr bgcolor="#999999"> 
              								<td width="5%" rowspan="2" align="center"  valign="middle" >No.</td>
              								<td width="20%" rowspan="2" align="center" valign="middle" >Items</td>
              								<td width="5%" rowspan="2" align="center" valign="middle" >Unit Qty</td>
              								<td width="10%" rowspan="2" align="center"  valign="middle" >Retail Price</td>
			   								<td width="5%" rowspan="2" align="center"  valign="middle" >UOM</td>
              								<td width="5%" rowspan="2" align="center"  valign="middle" >Qty</td>
            								<td  width="20%" colspan="2" align="center"  valign="middle" >Cost</td>
              								<td width="5%" rowspan="2" align="center" valign="middle" >Option</td>
            							</tr>
            							<tr bgcolor="#999999"> 
              								<td  width="10%" align="center"  valign="middle" >Plan</td>
              								<td  width="10%" align="center"  valign="middle" >Actual</td>
            							</tr>
            							<?php 
            							$no = 1;
            							$result_a = $this->mgeneral->getWhere(array('ipo_id'=>$ipo_id,'parent_id'=>$edit->id,'type_id'=>$type_id),"tt_input");
            							/*echo "<pre>";
            							print_r($result_a);*/
            							foreach ($result_a as $key => $value_a) {
            								$id 	= $value_a->id;
											$qty 	= $value_a->qty;
											$item_id= $value_a->item_id;											
											$price_2= $value_a->price2;
											$price_4= $value_a->price4;
											$result_b = $this->mgeneral->getWhere(array('id'=>$item_id),"tr_item");
            								
            							?>
            							<tr>
            								<td><?php echo $no;?></td>
            								<td><a href="#"><?php echo $result_b[0]->code;?> - <?php echo $result_b[0]->name;?></a></td>
            								<td><?php //echo $qty;?></td>
            								<td><?php echo $price_2;?></td>
            								<td>-<?php //echo $price_2;?></td>
            								<td><?php echo $qty;?></td>
            								<td><?php //echo $qty;?></td>
            								<td><?php //echo $qty;?></td>
            								<td align="center">Approve || <a href="#" class="btn btn-xs btn-danger"data-id="<?php echo $qty;?>"><i class="fa fa-trash-o"></i></td>
            							</tr>
            							<?php $no++;} ?>
            							<tr>
            								<td><?=$no;?></td>
            								<td>            									
            									<select  name="item" class="select2-01 col-md-10">
                    								<option value="0">-= Select Product =-</option>
                    								<?php 
            											$sel_item = $this->mgeneral->getWhere(array('p1_id'=>2),"tr_item");
            											foreach ($sel_item as $key => $value) {
            												echo "<option value='".$value->id."'>".$value->name."</option>";
            											}
            										?>
                    							</select>
            								</td>
            								<td></td>
            								<td></td>
            								<td></td>
            								<td><input type="text" name="qty" id="qty" size="15" value="" /></td>
            								<td></td>
            								<td></td>
            								<td>
            								<input type="hidden" name="idx" value="<?php echo $edit->id;?>"/>
            								<input type="hidden" name="ipo_id" value="<?php echo $ipo_id;?>"/>
            								<input type="hidden" name="type_id" value="<?php echo $type_id;?>"/>
            								<input type="submit" id="atas" value="Save" /></td>
            							</tr>
							           </table>
            						
           							</span>
            						</form>
            					</div>
            				</div>
            			</div>
					<?php } ?>
					<?php if($ipo_id ==1 and $type_id >1){?>
						
						<div class="box border inverse">
							<div class="box-title">
								<h4><i class="fa fa-money"></i><?php echo $type_name_one; ?></h4>
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
									<span class="title">
            					
            						
							          <table border="1" width="100%" cellpadding="0" cellspacing="0">
							     		  <tr bgcolor="#999999"> 
								              <td width="5%" align="center"  valign="middle" >No.</td>
								              <td width="20%" align="center" valign="middle" >Items</td>								           
								              <td width="10%" align="center"  valign="middle" >Vendor</td>
								              <td width="5%" align="center"  valign="middle" >Qty</td>
								              <td width="5%" align="center" valign="middle" >Option</td>
								           </tr>
            							<?php 
            							$no = 1;
            							$result_a = $this->mgeneral->getWhere(array('ipo_id'=>1,'parent_id'=>$edit->prev_id,'type_id'=>1),"tt_input");
            							foreach ($result_a as $key => $value_a) {
            								$id 	= $value_a->id;
											$qty 	= $value_a->qty;
											$item_id= $value_a->item_id;											
											$price_2= $value_a->price2;
											$price_4= $value_a->price4;
											$result_b = $this->mgeneral->getWhere(array('id'=>$item_id),"tr_item");
            								
            							?>
            							<tr>
            								<td><?php echo $no;?></td>
            								<td><a href="#"><?php echo $result_b[0]->code;?> - <?php echo $result_b[0]->name;?></a></td>           								
            								<td><?php //echo $qty;?></td>
            								<td><input type="text" name="qty" id="qty" size="15" value="<?php echo $qty;?>" /></td>            								
            								<td align="center"><a href="#" class="btn btn-xs btn-success" data-id="<?php echo $id;?>"><i class="fa fa-pencil"></i></td>
            							</tr>
            							<?php $no++;} ?>            							
							           </table>
            						
           							</span>
            						</form>
            					</div>
            				</div>
            			</div>
            			<div class="separator"></div>
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
									<span class="title">
            					
            						
							          <table border="1" width="100%" cellpadding="0" cellspacing="0">
							     		  <tr bgcolor="#999999"> 
								              <td width="5%" align="center"  valign="middle" >No.</td>
								              <td width="20%" align="center" valign="middle" >Items</td>
								              <td width="5%" align="center" valign="middle" >Unit Qty</td>
								              <td width="10%" align="center"  valign="middle" >Vendor</td>
								              <td width="5%" align="center"  valign="middle" >UOM</td>
								              <td width="5%" align="center"  valign="middle" >Qty</td>
								              <td width="5%" align="center" valign="middle" >Option</td>
            							  </tr>
            							<?php 
            							$no = 1;
            							$result_a = $this->mgeneral->getWhere(array('ipo_id'=>$ipo_id,'parent_id'=>$idx,'type_id'=>$type_id),"tt_input");
            							foreach ($result_a as $key => $value_a) {
            								$id 	= $value_a->id;
											$qty 	= $value_a->qty;
											$item_id= $value_a->item_id;											
											$price_2= $value_a->price2;
											$price_4= $value_a->price4;
											$result_b = $this->mgeneral->getWhere(array('id'=>$item_id),"tr_item");
            							?>
            							<tr>
            								<td><?php echo $no;?></td>
            								<td><a href="#"><?php echo $result_b[0]->code;?> - <?php echo $result_b[0]->name;?></a></td>           								
            								<td><?php //echo $qty;?></td>
            								<td><input type="text" name="qty" id="qty" size="15" value="<?php echo $qty;?>" /></td>            								
            								<td align="center"><a href="#" class="btn btn-xs btn-success" data-id="<?php echo $id;?>"><i class="fa fa-pencil"></i></td>
            							</tr>
            							<?php $no++;} ?>            							
							           </table>
            						
           							</span>
            						</form>
            					</div>
            				</div>
            			</div>
					<?php } ?>
					<!-- 
					/* Start Table Bawah
					/* akhir dari sebuah kondisi
					 -->
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
$( "#form_atas" ).on( "submit", function( event ) {
	$.ajax({
		url: '<?php echo base_url();?>index.php/apps/ajax/boom/save/<?php //echo $edit->id;?>',
		type: "POST",
		data: $("#form_atas").serialize(),
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
				window.location.reload();
			}, 1000);
		},
		error: function(){
			$("#msg").slideDown();
		}
	}); 
	event.preventDefault();
	console.log( $( this ).serialize() );
});

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
						window.location = "<?php echo site_url().'apps/input/list/'.$ipo_id.'/'.$type_id;?>";
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