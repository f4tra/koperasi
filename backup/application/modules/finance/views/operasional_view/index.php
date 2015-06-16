	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Operasional</h4> 					
				</div>
				<div class="box-body">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
				<thead>
					<tr>						
						<th>No</th>
						<th>Tanggal</th>
						<th>Code</th>															
						<th>Status</th>
						<th>Role</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
				<?php $no = 1; foreach ($data as $key => $value) { ?>
					
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $value->create_date;?></td>
						<td><?php echo $value->code;?></td>
						<td><?php 
							if($value->status == 1)
								echo "<span class='label label-info'>Baru<span>";
							elseif($value->status == 2)
								echo "<span class='label label-warning'>Revisi<span>";
							elseif($value->status == 3)
								echo "<span class='label label-success'>Diterima<span>";
						?></td>
						<td><?php echo $value->role_id;?></td>
						<td><?php 
							if($value->status == 1){
								echo "<a href='".site_url('finance/operasional/form/'.$value->id)."' class='btn btn-warning btn-xs'>Item</a>";
								if($user->role_id == 10 or $user->id == 1){
									echo "
									<button onclick=cheked(this); data-id='".$value->id."' data-status='2' class='btn btn-info btn-xs'>Revisi</button>
									<button onclick=cheked(this);  data-id='".$value->id."' data-status='3' class='btn btn-purple btn-xs'>Terima</button>";
								}
							}
							elseif($value->status == 2){
								echo "<a href='".site_url('finance/operasional/form/'.$value->id)."' class='btn btn-info btn-xs'>Item</a>";								
								if($user->role_id == 10 or $user->id == 1){
									echo "
									<button onclick=cheked(this); data-id='".$value->id."' data-status='2' class='btn btn-info btn-xs'>Revisi</button>
									<button onclick=cheked(this); data-id='".$value->id."' data-status='3' class='btn btn-purple btn-xs'>Terima</button>";
								}
							}
							elseif($value->status == 3){
								echo "<a href='".site_url('finance/operasional/detail/'.$value->id)."' class='btn btn-success btn-xs'>Detail</a>";								

							}
						?></td>
					</tr>
					<?php $no++;} ?>
				</tbody>
				</table>
					<a class="btn btn-warning" href="<?php echo site_url('finance/operasional/form');?>">Add New</a>
				</div>				
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
		
	
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#data').dataTable({
		'sPaginationType': 'bs_full',
		"bProcessing": true,
		"aaSorting": [[0, "asc"]],
		"iDisplayLength": 10			
		
	});
	$('#data').each(function(){
		var datatable = $(this);
		var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
		search_input.attr('placeholder', 'Search');
		search_input.addClass('form-control input-sm');
		var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
		length_sel.addClass('form-control input-sm');
	});
});
function del(btn)
{
	var cek = confirm("Apakah anda yakin akan menghapus??");
	if(cek==false)
	{
		return false;
	}
	else
	{
		var id = $(btn).attr('data-id');		
		$.ajax({
			url: "<?php echo site_url('finance/operasional/execute/delete/');?>",
			type: "POST",
			data:{data_id:id},
			crossDomain:true,
			beforeSend: function(){
				$("#msg").html("loading"); 
			},
			complete : function(){
				$("#msg").html("delete Sukses"); 
			}, 
			success: function(data) {				
				location.reload();
			},	
		});
		return false;
	}
}
function cheked(btn)
{
	var cek = confirm("Apakah anda yakin akan Memvalidasi data ini??");
	if(cek==false)
	{
		return false;
	}
	else
	{
		var id = $(btn).attr('data-id');
		var status = $(btn).attr('data-status');
		var data ="id="+id+"&status="+status;
		$.ajax({
			url: "<?php echo site_url('finance/operasional/execute/approve/');?>",
			type: "POST",
			data:data,
			dataType:"json",
			crossDomain:true,
			success: function(data) {				
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
		});
		return false;
	}
}
</script>