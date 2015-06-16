	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-reorder"></i> Pengajuan | <?php echo $purchasing->code;?></h4> 					
				</div>
				<div class="box-body">
					<!-- Form-->
						<table class="table">
							<thead>
								<th>No</th>								
								<th>Name</th>
								<th>Qty</th>
								<th>Satuan</th>
								<th>Harga</th>
								<th>Total</th>
								<th>Status</th>
								<th>Option</th>
							</thead>
							<tbody>
							<?php 

							$no=1;foreach ($purchasing_detail as $key => $value) { ?>
								<tr>
									<td><?php echo $no;?></td>
																	
									<td><span id="code_update_<?php echo $value->id; ?>"><?php echo $value->name;?></span></td>									
									<td>
										<?php echo $value->qty;?>	
									</td>
									<td>
										<?php echo $value->pcs;?>	
									</td>
									<td>
										<?php echo $value->price;?>
									</td>
									<td>Rp. <?php echo number_format($value->price*$value->qty);?></td>
									<td>
										<?php 
										if($value->check==0){
											echo "Belum Di Check";
										}elseif($value->check==1){
											echo "Tidak Sesuai";
										}elseif($value->check==2){
											echo "Sesuai";
										}

										?>
									</td>
									<td>
										<input type="hidden" value="2" name="check_sesuai" id="check_sesuai">
										<input type="hidden" value="1" name="check_tidak_sesuai" id="check_tidak_sesuai">
										<input type="hidden" value="<?php echo $value->id;?>" name="idx" id="idx<?php echo $value->id;?>">								
										<input type="hidden" value="<?php echo $purchasing->id;?>" name="purchasing_id" id="purchasing_id">								
										<input type="hidden" name="name_update" id="name_update">
										<button										
										title="Update" 
										class="btn btn-info btn-xs" 
										onclick="update_sesuai(<?php echo $value->id;?>);">
										Sesuai</button>
										<button
										title="Delete" class="btn btn-danger btn-xs" 
										onclick="update_tidak(<?php echo $value->id;?>);">
										Tidak Sesuai</button>
									</td>
								</tr>
							<?php $no++;}	?>
							<tr>
							
								<tr>									
									<td colspan="8" scope="row"><center><h4><b>Total Rp.<?php echo number_format($purchasing_detail_jum->total,2); ?></b></h4></center></td>
								</tr>
							</tbody>
						</table>
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

function update_sesuai(btn){
	var idx =$("#idx"+btn).val(),		
		check_sesuai =$("#check_sesuai").val();
	var data =  "id="+idx+"&check_sesuai="+check_sesuai;

	$.ajax({
		url: "<?php echo site_url();?>purchasing/barang/execute/update_detail/",
		type: "POST",
		dataType:"json",
		data: data,
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
}
function update_tidak(btn){
	var idx =$("#idx"+btn).val(),		
		check_sesuai =$("#check_tidak_sesuai").val();
	var data =  "id="+idx+"&check_sesuai="+check_sesuai;

	$.ajax({
		url: "<?php echo site_url();?>purchasing/barang/execute/update_detail/",
		type: "POST",
		dataType:"json",
		data: data,
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