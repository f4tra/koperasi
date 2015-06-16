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
								<th>Option</th>
							</thead>
							<tbody>
							<?php $no=1;foreach ($finance_detail as $key => $value) { ?>
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo $value->name;?></td>									
									<td>
										<div class="col-lg-5"><input value="<?php echo $value->qty;?>" type="text"  name="qty_update" id="qty_update" class="form-control"  /></div>	
									</td>
									<td>
										<div class="col-lg-8"><input value="<?php echo $value->pcs;?>" type="text"  name="pcs_update" id="pcs_update" class="form-control"  /></div>	
									</td>
									<td>
										<div class="col-lg-10"><input value="<?php echo $value->price;?>" type="text"  name="price_update" id="price_update" class="form-control"  /></div>	
									</td>
									
									<td>Rp. <?php echo number_format($value->price*$value->qty);?></td>
									<td>
										<input type="hidden" value="<?php echo $value->id;?>" name="idx" id="idx">								
										<button										
										title="Update" 
										class="btn btn-info btn-xs" 
										onclick="update(this);">
										<i class="fa fa-pencil"></i></button>
										<button
										title="Delete" class="btn btn-danger btn-xs" 
										onclick="hapus(this);">
										<i class="fa fa-trash-o"></i></button>
									</td>
								</tr>
							<?php $no++;}	?>
							<tr>
							<form class="form-horizontal row-border"  method="post" id="form">
								<td >
									<div class="col-lg-8">
										<?php echo $no;?>
									</div>
								</td>
								<td >
									<div class="col-lg-12">
										<input type="text" name="name" id="name" class="form-control"  />
									</div>
								</td>
								<td>
									<div class="col-lg-5"><input type="text"  name="qty" id="qty" class="form-control"  /></div>	
								</td>
								<td>
									<div class="col-lg-8"><input type="text"  name="pcs" id="pcs" class="form-control"  /></div>	
								</td>
								<td>
									<div class="col-lg-10"><input type="text"  name="price" id="price" class="form-control"  /></div>	
								</td>
								<td>
									
								</td>
								<td>
									<input type="hidden" value="<?php echo $finance->id;?>" name="finance_id" id="finance_id">
									<button
										title="Save" class="btn btn-warning btn-xm" 
										onclick="save(this);">
										<i class="fa fa-pencil"></i></button>
									
								</td>
								</tr>
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
function hapus(){
	var idx =$("#idx").val();
	var data =  "id="+idx;
	$.ajax({
		url: "<?php echo site_url();?>finance/operasional/execute/delete_detail/",
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
function update(){
	var idx =$("#idx").val(),
		pcs =$("#pcs_update").val(),
		price =$("#price_update").val(),
		qty =$("#qty_update").val();
	var data =  "id="+idx+"&pcs="+pcs+"&price="+price+"&qty="+qty;
	$.ajax({
		url: "<?php echo site_url();?>finance/operasional/execute/update_detail/",
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
// Fungsi Untuk Tambah Data
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
				
				url: "<?php echo site_url();?>finance/operasional/execute/save_detail/",
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