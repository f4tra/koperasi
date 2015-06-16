	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-reorder"></i> Operasional | <?php echo $finance->code;?></h4> 					
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
								<th>Sub Total</th>
								
							</thead>
							<tbody>
							<?php $no=1;foreach ($finance_detail as $key => $value) { ?>
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
										<?php echo $value->price;?>
									</td>
									
									<td>Rp. <?php echo number_format($value->price*$value->qty);?></td>
									
								</tr>
							<?php $no++;}	?>
							<tr>									
									<td colspan="7" scope="row"><center><h4><b>Total Rp.<?php echo number_format($finance_detail_jum->total,2); ?></b></h4></center></td>
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
$(function() {
    
    $( "#start_date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });   
    $("#btndp").click(function () {
       $("#start_date" ).datepicker("show");
    });
});

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