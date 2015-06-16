	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Pengajuan Pengadaan</h4> 					
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
							if($value->status == 0)
								echo "<span class='label label-info'>Entry / New<span>";
							elseif($value->status == 1)
								echo "<span class='label label-warning'>Terkirim<span>";
							elseif($value->status == 2)
								echo "<span class='label label-success'>Tersimpan<span>";
							elseif($value->status == 3)
								echo "<span class='label label-success'>Revisi<span>";
							elseif($value->status == 4)
								echo "<span class='label label-success'>Baru<span>";
							elseif($value->status == 5)
								echo "<span class='label label-success'>Selesai<span>";
							elseif($value->status == 6)
								echo "<span class='label label-success'>Lunas<span>";
						?></td>
						<td><?php echo $value->role_id;?></td>
						<td><?php 
							if($value->status == 0){
								echo "<a href='".site_url('purchasing/pembayaran/form/'.$value->id)."' class='btn btn-info btn-xs'>Item</a>";
								$isi =  $this->db->query("select count(purchasing_id) as id from tt_purchasing_detail where purchasing_id='".$value->id."'")->row();
								if($user->role_id == 10 or $user->id == 1){
									print ' || <div class="btn-group dropdown">
											<button class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">
											Action
											<span class="caret"></span>
											</button>
											<ul class="dropdown-menu context">
												<li>
													<a onclick=cheked(this); href="#" data-id="'.$value->id.'" data-status="6">Lunas</a>
												</li>											
											</ul>
										  </div>';
									
								}else{
									if($isi->id > 0){
										echo " || <button class='btn btn-success btn-xs'>Send</button>";								
									}
								}
							}
							elseif($value->status == 1){
								echo "<a href='".site_url('purchasing/pembayaran/form/'.$value->id)."' class='btn btn-info btn-xs'>Item</a>";
								if($user->role_id == 10 or $user->id == 1){
									print ' || <div class="btn-group dropdown">
											<button class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">
											Action
											<span class="caret"></span>
											</button>
											<ul class="dropdown-menu context">
												<li>
													<a onclick=cheked(this); href="#" data-id="'.$value->id.'" data-status="6">Lunas</a>
												</li>
											</ul>
										  </div>';
									
								}
							}
							elseif($value->status == 2){
								echo "<a href='".site_url('purchasing/pembayaran/detail/'.$value->id)."' class='btn btn-success btn-xs'>Detail</a>";								
								if($user->role_id == 10 or $user->id == 1){
									print ' || <div class="btn-group dropdown">
											<button class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">
											Action
											<span class="caret"></span>
											</button>
											<ul class="dropdown-menu context">
												<li>
													<a onclick=cheked(this); href="#" data-id="'.$value->id.'" data-status="6">Lunas</a>
												</li>
											</ul>
										  </div>';
								}
							}
							elseif($value->status == 3){
								echo "<a href='".site_url('purchasing/pembayaran/form/'.$value->id)."' class='btn btn-info btn-xs'>Item</a>";								
								if($user->role_id == 10 or $user->id == 1){
									print ' || <div class="btn-group dropdown">
											<button class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">
											Action
											<span class="caret"></span>
											</button>
											<ul class="dropdown-menu context">
												<li>
													<a onclick=cheked(this); href="#" data-id="'.$value->id.'" data-status="6">Lunas</a>
												</li>
											</ul>
										  </div>';
								}
							}
							elseif($value->status == 4){
								echo "<a href='".site_url('purchasing/pembayaran/detail/'.$value->id)."' class='btn btn-success btn-xs'>Detail</a>";						
								if($user->role_id == 10 or $user->id == 1){
									print ' || <div class="btn-group dropdown">
											<button class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">
											Action
											<span class="caret"></span>
											</button>
											<ul class="dropdown-menu context">
												<li>
													<a onclick=cheked(this); href="#" data-id="'.$value->id.'" data-status="6">Lunas</a>
												</li>
											</ul>
										  </div>';
								}
							}
							elseif($value->status == 5){
								echo "<a href='".site_url('purchasing/pembayaran/detail/'.$value->id)."' class='btn btn-success btn-xs'>Detail</a>";						
								if($user->role_id == 10 or $user->id == 1){
									print ' || <div class="btn-group dropdown">
											<button class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">
											Action
											<span class="caret"></span>
											</button>
											<ul class="dropdown-menu context">
												<li>
													<a onclick=cheked(this); href="#" data-id="'.$value->id.'" data-status="6">Lunas</a>
												</li>
											</ul>
										  </div>';
								}
							}
							elseif($value->status == 6){
								echo "<a href='".site_url('purchasing/pembayaran/detail/'.$value->id)."' class='btn btn-success btn-xs'>Detail</a>";						
								if($user->role_id == 10 or $user->id == 1){
									print ' || <div class="btn-group dropdown">
											<button class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">
											Action
											<span class="caret"></span>
											</button>
											<ul class="dropdown-menu context">
												<li>
													<a onclick=cheked(this); href="#" data-id="'.$value->id.'" data-status="6">Lunas</a>
												</li>
											</ul>
										  </div>';
								}
							}
						?></td>
					</tr>
					<?php $no++;} ?>
				</tbody>
				</table>
					<a class="btn btn-warning" href="<?php echo site_url('purchasing/pembayaran/form');?>">Add New</a>
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
			url: "<?php echo site_url('purchasing/pembayaran/execute/approve/');?>",
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