	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i></h4> 					
				</div>
				<div class="box-body">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
				<thead>
					<tr>
						<th>Code</th>
						<th>Name</th>														
						<th>Parent ID</th>
						<?php $var = 5; if($this->uri->segment(4) >=3){
							$var = 7;
						?>						
						<th>Division</th>
						<th>Structure</th>
						<?php } ?>
						<th>Active</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="<?php echo $var; ?>">Loading Data</td>
					</tr>
				</tbody>
				</table>
					<a class="btn btn-warning" href="<?php echo site_url('apps/structure/form/').'/'.$id;?>">Add New</a>
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
		"sAjaxSource": "<?php echo site_url('apps/structure/load').'/'.$id;;?>",
		"sServerMethod": "POST",
		"aaSorting": [[0, "asc"]],
		"iDisplayLength": 10,			
		"aoColumns" : [
			{"mData": "code"},
			{"mData": "name"},									
			{"mData": "parent_id",
				"mRender" : function ( data, type, par ) {				
					if(par.parent_id == 0 ||par.parent_id == ''||par.parent_id == null){
						return "<font color='#ff0000'>Unidentify</font>"; 			
					}else{
						return par.parent_id; 
					} 				
				}
			},	
			<?php if($this->uri->segment(4) >=3){ ?>
			{"mData": "div_id",
				"mRender" : function ( data, type, par ) {				
					if(par.div_id == 0 ||par.div_id == ''||par.div_id == null){
						return "<font color='#ff0000'>Unidentify</font>"; 			
					}else{
						return par.div_id; 
					} 				
				}
			},	
			{"mData": "stc_id",
				"mRender" : function ( data, type, par ) {				
					if(par.stc_id == 0 ||par.stc_id == ''||par.stc_id == null){
						return "<font color='#ff0000'>Unidentify</font>"; 			
					}else{
						return par.stc_id; 
					} 				
				}
			},	
			<?php } ?>				
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
				url: "<?php echo site_url('apps/structure/execute/active/'); ?>",
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
				url: "<?php echo site_url('apps/structure/execute/active/'); ?>",
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
			url: "<?php echo site_url('apps/structure/execute/delete/');?>/"+id,
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