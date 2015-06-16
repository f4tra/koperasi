	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-reorder"></i> Konfirmasi | <?php echo $purchasing->code;?></h4> 					
				</div>
				<div class="box-body">
					<!-- Form-->
						<form action="" id="form" name="form" method="POST">
							<div class="form-group">
								<label class="col-md-2 control-label">No. PO :</label> 
								<div class="col-md-4">
									<input type="text" name="code" id="code" value="<?php echo $purchasing->code;?>" readonly="readonly" class="form-control" placeholder="<?php //echo $type_name;?>" />
								</div>	
								<label class="col-md-2 control-label">Tanggal PO :</label> 						
	                            <div class="col-md-3">
	                            	<div class="input-group">
	                                	<input type="text" value=" <?php echo $purchasing->create_date;?>" readonly="readonly" class="form-control"/>
	                                </div>                                                                                                                   
	                            </div>
							</div>
							<br/>
							<div class="form-group">
								<label class="col-md-2 control-label">Status Barang</label> 
								<div class="col-md-4">
									<?php 
										/*if($purchasing->status_id==6){
											echo "Lunas";
										}elseif($purchasing->status_id==4){
											echo "Belum Lunas";

										}*/
									?>
								</div>	
								<label class="col-md-2 control-label">Tanggal Simpan :</label> 						
	                            <div class="col-md-3">
	                            	<div class="input-group">
	                            		<input type="hidden" name="status_id" id="status_id" value="6">
	                                	<input type="text" value=" <?php echo $purchasing->tgl_simpan;?>"name="start_date" id="start_date" class="form-control" data-mask="99/99/9999"><span class="input-group-btn"> <button class="btn btn-primary" id="btndp" type="button"><i class="fa fa-calendar" ></i> Date</button> </span>
	                                </div>                                                                                                                   
	                            </div>
							</div>
						<table class="table">
							<thead>
								<th>No</th>
								<th>Name</th>
								<th>Qty</th>
								<th>Satuan</th>
								<th>Gudang</th>
								<th>Kode Rak</th>
								
							</thead>
							<tbody>
							<?php $no=1;foreach ($purchasing_detail as $key => $value) { ?>
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo $value->name;?></td>									
									<td>
										<?php echo $value->qty;?>
									</td>
									<td>
										<?php echo $value->pcs;?>
									</td>
									<td>
										<div class="col-md-8">
										<select name="gudang" id="gudang" class="form-control">
										<?php
										foreach ($gudang as $key => $value) {
											echo "<option value='".$value->id."'>".$value->name."</option>";
											# code...
										}

										?>
										</select>
										</div>
									</td>
									<td>
									<div class="col-md-8">
										
									<select name="gudang" id="gudang" class="form-control">
										<?php

										foreach ($rak as $key => $value) {
											echo "<option value='".$value->id."'>".$value->name."</option>";
											# code...
										}

										?>
										</select>
									</div>
									<td>
										
									</td>
									
								</tr>
							<?php $no++;}	?>
							
							
							</tbody>
						</table>						
						<input type="submit" class="btn btn-info btn-lg pull-right" onclick="save(this);" value="Save"/>
					<div class="row"></div>
					<br />
					<div id="msg"></div>
						</form>
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
function save(){
	$('#form').validate({
	    rules: {
	      code: {	        
	        required: true
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
				
				url: "<?php echo site_url();?>gudang/konfirmasi/execute/update/<?php echo $purchasing->id;?>",
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
						window.location.reload();
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