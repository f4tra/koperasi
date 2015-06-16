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
						<th>Icon</th>
						<th>Code</th>
						<th>Name</th>									
						<th>Parent ID</th>						
						<th>Active</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="5">Loading Data</td>
					</tr>
				</tbody>
				</table>
					<a class="btn btn-warning" href="<?php echo site_url($uri);?>">Add New</a>
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
		"sAjaxSource": "<?php echo site_url('workflow/ajax/load_pt');?>",
		"sServerMethod": "POST",
		"aaSorting": [[0, "asc"]],
		"iDisplayLength": 10,			
		"aoColumns" : [				
			{"mData": "icons",
				"mRender" : function ( data, type, par ) {				
					return "<img width='15%' src ='<?php echo base_url();?>assets/wf/"+par.icons+"'/>"; 			
							
				}
			},
			{"mData": "code"},
			{"mData": "name"},			
			{"mData": "parent_id",
				"mRender" : function ( data, type, par ) {				
					console.log(par.parent_id);
					if(par.parent_id == null || par.parent_id == '0' || par.parent_id == 0){
						return "<font color = '#ff0000'>Unidentify</font>"; 			
					}else{
						return par.parent_id; 
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
			/*{"mData": "id",
				"mRender" : function ( data, type, idx ) {	
					//alert(idx.id);			
					return "<a title='Edit "+idx.name+"' class='btn btn-warning btn-m' href='<?php echo site_url('workflow/prosesgroup/form/');?>/"+idx.id+"'><i class='fa fa-pencil'></i></a> <button title='Delete "+idx.name+"' class='btn btn-danger btn-m' data-id='"+idx.id+"' onclick='del(this);''><i class='fa fa-trash-o'></i></button>"; 								 				
				}
			},*/
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
				url: "<?php echo site_url('workflow/ajax/execute_pt/active/'); ?>",
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
				url: "<?php echo site_url('workflow/ajax/execute_pt/active/');?>",
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
			url: "<?php echo site_url().'workflow/ajax/execute_pt/delete/';?>"+id,
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