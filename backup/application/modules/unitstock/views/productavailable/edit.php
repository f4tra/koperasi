
	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-preorder"></i><?php echo $this->uri->segment(2); ?> </h4> 
				
				</div>
				<div class="box-body">
					<div class="tabbable box-tabs">
                	<ul class="nav nav-tabs">
                    	<li>
                    		<a href="#box_tab6" data-toggle="tab"><i class="fa fa-desktop"></i>Owner</a>
                    	</li>
                    	<li>
                    		<a href="#box_tab5" data-toggle="tab"><i class="fa fa-desktop"></i>Price</a>
                    	</li>
                        
                        
                        <li >
                        	<a href="#box_tab4" data-toggle="tab">Specification</a>
                        </li>
                        <li class="active">
                        	<a href="#box_tab3" data-toggle="tab">Description</a>
                        </li>
                    </ul>
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form">
                	<div class="tab-content">
                		<!--START TAB4-->        
                        
                        <div class="tab-pane active" id="box_tab3">
                        <div class="form-group">
							<label class="col-md-2 control-label">Item:</label> 
							<div class="col-md-4">
								<select name="item" id="item" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php 
								foreach($item as $g){
									if($g->id == $edit->item_id){
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
							<label class="col-md-2 control-label">Status:</label> 
							<div class="col-md-4">
								<select name="status" id="status" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php 
								foreach($status as $g){
									if($g->id == $edit->status_id){
										$a = "selected";
									}else{
										$a = "";
									}
								?>
									<option  <?php echo $a?> value="<?php echo $g->id;?>"><?php echo " ".$g->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
                            <label class="col-md-2 control-label">Start Date</label>
                            <div class="col-md-3">
	                            <div class="input-group">
	                            	<input type="text" value="<?php echo $edit->start_date; ?>" name="start_date" id="start_date" class="form-control" data-mask="99/99/9999"><span class="input-group-btn"> <button class="btn btn-primary" id="start_date_btn" type="button"><i class="fa fa-calendar" ></i> Date</button> </span>
	                            </div>                                                                                                                   
                       		</div>
                       </div>                                                                                                
                            <div class="form-group">
                                <label class="col-md-2 control-label">End Date</label>
                               	<div class="col-md-3">
                                            <div class="input-group">
                                                <input value="<?php echo $edit->end_date; ?>" type="text" name="end_date" id="end_date"  class="form-control" data-mask="99/99/9999"><span class="input-group-btn"> <button class="btn btn-primary" id="end_date_btn" type="button"><i class="fa fa-calendar" ></i> Date</button> </span>
                                            </div>                                                                                                                   
                                        </div>
                                                                         
                            </div>	
                        		<div class="form-group">
							<label class="col-md-2 control-label">Code:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->code; ?>" type="text" name="code" id="code" class="form-control" placeholder="Code" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Name:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->name; ?>"  type="text" name="name" id="name" class="form-control" placeholder="Name" />
							</div>
						</div>
						<div class="form-group">
								<label class="col-md-2 control-label">Description:</label> 
								<div class="col-md-4">
									<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"><?php echo $edit->descr; ?></textarea>
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
                        </div>
                        <div class="tab-pane" id="box_tab4">
	                        <div class="form-group">
								<label class="col-md-2 control-label">Dimensi 1:</label> 
								<div class="col-md-4">
									<input value="<?php echo $item_reff->dim1; ?>" type="text" name="dim1" id="dim1" class="form-control" placeholder="Dimensi 1" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Dimensi 2:</label> 
								<div class="col-md-4">
									<input value="<?php echo $item_reff->dim2; ?>"type="text" name="dim2" id="dim2" class="form-control" placeholder="Dimensi 2" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Group:</label> 
								<div class="col-md-4">
								<?php echo $grp->name;?>	
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Type:</label> 
								<div class="col-md-4">
								<?php echo $type->name;?>	
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Category:</label> 
								<div class="col-md-4">
								<?php echo $ctg->name;?>	
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Wing:</label> 
								<div class="col-md-4">							
									<?php echo $wing->name;?>	
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Floor:</label> 
								<div class="col-md-4">							
									<?php echo $floor->name;?>	
								</div>
							</div>	
							<div class="form-group">
								<label class="col-md-2 control-label">Tower:</label> 
								<div class="col-md-4">							
									<?php echo $tower->name;?>	
								</div>
							</div>	
                        </div>
                        <div class="tab-pane" id="box_tab5">

                        	<div class="form-group">
								<label class="col-md-2 control-label">Harga Beli:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->price1; ?>" type="text" name="price1" id="price1" class="form-control" placeholder="Price 1" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Harga Price List:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->price2; ?>" type="text" name="price2" id="price2" class="form-control" placeholder="Price 2" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Harga Transaksi:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->price3; ?>" type="text" name="price3" id="price2" class="form-control" placeholder="Price 3" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Total Pembayaran:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->price4; ?>" type="text" name="price4" id="price4" class="form-control" placeholder="Price 4" />
								</div>
							</div>		
                        </div>
                        <div class="tab-pane" id="box_tab6">
                        	<div class="form-group">
								<label class="col-md-2 control-label">Owner:</label> 
								<div class="col-md-4">							
									<select  name="owner" id="owner" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($user as $key => $value) {
												if($value->id == $edit->owner_id){
													$a = "selected";
												}else{
													$a = "";
												}
												print '<option '.$a.' value="'.$value->id.'">'.$value->code." - ".$value->nick_name.'</option>';
											}
										?>									
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Seller:</label> 
								<div class="col-md-4">							
									<select  name="seller" id="seller" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($user as $key => $value) {
												if($value->id == $edit->seller_id){
													$a = "selected";
												}else{
													$a = "";
												}
												print '<option '.$a.' value="'.$value->id.'">'.$value->code." - ".$value->nick_name.'</option>';
											}
										?>									
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Buyer:</label> 
								<div class="col-md-4">							
									<select  name="buyer" id="buyer" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($user as $key => $value) {
												if($value->id == $edit->buyer){
													$a = "selected";
												}else{
													$a = "";
												}
												print '<option '.$a.' value="'.$value->id.'">'.$value->code." - ".$value->nick_name.'</option>';
											}
										?>									
									</select>
								</div>
							</div>
                        </div>                        
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
$(function() {
    
    $( "#start_date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });   
    $("#start_date_btn").click(function () {
       $("#start_date" ).datepicker("show");
    });
    $( "#end_date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });   
    $("#end_date_btn").click(function () {
       $("#end_date" ).datepicker("show");
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
				url: '<?php echo base_url();?>index.php/unitstock/productavailable/execute/update/<?php echo $edit->id;?>',
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