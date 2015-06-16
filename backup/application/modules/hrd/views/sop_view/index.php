	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i><?php echo $this->uri->segment(2); ?></h4> 					
				</div>
				<div class="box-body">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
				<thead>
					<tr>						
						<th>Code</th>
						<th>Name</th>										
						<th>Role</th>						
						<th>Active</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<?php

					foreach ($data as $key => $value) { ?>
					<tr>
						<td><?php echo $value->code;?></td>
						<td><?php echo $value->name;?></td>
						<td><?php echo $value->role_id;?></td>
						<td>
							<?php
							if($user->id ==1){
								if($value->active == 1){
									echo  "<center><input  data-id=".$value->id." checked type='checkbox' id='active' class='checkbox' value='0'/></center>"; 			
								}else{
									echo "<center><input  data-id=".$value->id." type='checkbox' id='active' class='checkbox' value='1'/></center>"; 
								} 	
							}else{
								if($value->active == 1){
									echo  "<span class='label label-danger'>Active</span>"; 			
								}else{
									echo  "<span class='label label-danger'>Inactive</span>"; 			
									
								}
							}
							?>
						</td>
						<td>
							<?php
							if($user->id ==1){
								$edit	= site_url('hrd/sop/form/'.$value->id);		
								$link	= ' <a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
											<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>';			
								echo $link;
							}else{
								$edit	= site_url('hrd/sop/form/'.$value->id);		
								$link	= ' <a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>';			
								echo $link;
							}
							?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
				</table>
					<?php
					if($user->id ==1){
						print '<a class="btn btn-warning" href="'.site_url('hrd/sop/form').'">Add New</a>';
					}
					?>
					
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
		"aaSorting": [[1, "asc"]],
		"iDisplayLength": 10,			
	});
	$('#data').each(function(){
		var datatable = $(this);
		var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
		search_input.attr('placeholder', 'Search');
		search_input.addClass('form-control input-sm');
		var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
		length_sel.addClass('form-control input-sm');
	});
	$('#data').delegate('.checkbox','change',function() {
		var i = $(this).attr('data-id');		
		var id = $(this).attr('data-id');
		if(this.checked){
			//alert("checked");
			$.ajax({
				url: "<?php echo site_url('hrd/sop/execute/active/'); ?>",
				type: 'post',
				data: 'active=1&id='+i,
				success: function(result)
				{
					$('span-'+id).removeClass('label-default ').addClass('label-info');
					$('span-'+id).html('Active');					
				}
			});
		}else {
			//alert("unchecked");
			$.ajax({
				url: "<?php echo site_url('hrd/sop/execute/active/');?>",
				type: 'post',
				data: 'active=0&id='+i,							
				success: function(result)
				{
					console.log();
					$('span-'+id).removeClass('label-info ').addClass('label-default');
					$('span-'+id).html('Inactive');
				}
			});
		}
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
			url: "<?php echo site_url('hrd/sop/execute/delete/');?>/"+id,
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
</script>