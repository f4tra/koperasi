	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i><?php //echo $type_name_one; ?></h4> 					
				</div>
				<div class="box-body">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
				<thead>
					<tr>						
						<th>Tanggal</th>
						<th>No. <?php echo $type_name_one; ?></th>															
						<th>No. <?php echo $type_name; ?> </th>					
						<th>Total </th>						
						<th>Status</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="6">Loading Data</td>
					</tr>
				</tbody>
				</table>
					<!-- <a class="btn btn-warning" href="<?php echo site_url('apps/output/index/add/').'/'.$ipo_id.'/'.$type_id;?>">Add New</a> -->
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
		"bServerSide": true,
		"sAjaxSource": "<?php echo site_url('apps/ajax_output/load/').'/'.$ipo_id.'/'.$type_id;?>",
		"sServerMethod": "POST",
		"aaSorting": [[0, "asc"]],
		"iDisplayLength": 10,			
		"aoColumns" : [		
			{"mData": "start_date"},
			{"mData": "code_1",
				"mRender" : function ( data, type, par ) {				
					
					if(par.code_2 == null || par.code_2 == '0' || par.code_2 == 0){
						return "<font color = '#ff0000'>-</font>"; 			
					}else{
						return par.code_2; 
					} 				
				}
			},			
			{"mData": "code_1"},
			{"mData": "qty",
				"mRender" : function ( data, type, par ) {				
					
					if(par.qty == null || par.qty == '0' || par.qty == 0){
						return "<font color = '#ff0000'>0</font>"; 			
					}else{
						return par.qty; 
					} 				
				}
			},
			{"mData": "active",
				"mRender" : function ( data, type, full ) {				
					if(full.active == 1){
						return "<center><input  data-id="+full.id+" checked type='checkbox' id='active' class='checkbox' value='0'/></center>"; 			
					}else{
						return "<center><input  data-id="+full.id+" type='checkbox' id='active' class='checkbox' value='1'/></center>"; 
					} 				
				}
			},
			{"mData": "show"},
		],
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
				url: '<?php echo site_url('apps/ajax_output/execute/active/'); ?>',
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
				url: '<?php echo site_url('apps/ajax_output/execute/active/');?>',
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
			url: '<?php echo site_url().'apps/ajax_output/index/delete/';?>',
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