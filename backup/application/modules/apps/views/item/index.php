	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i><?php //echo $this->uri->segment(2); ?></h4> 					
				</div>
				<div class="box-body">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
				<thead>
					<tr>
						<th>Code</th>															
						<th>Name</th>
						<th>Category</th>
						<?php if($p1 == 1){?>
						<th>Potensial</th>
						<?php } ?>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="4">Loading Data</td>
					</tr>
				</tbody>
				</table>
					<a class="btn btn-warning" href="<?php echo site_url('apps/itemlist/form').'/0/'.$p1;?>">Add New</a>
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
		"sAjaxSource": "<?php echo site_url('apps/itemlist/load').'/'.$p1;?>",
		"sServerMethod": "POST",		
		"aaSorting": [[0, "asc"]],
		"iDisplayLength": 10,			
		"aoColumns" : [		
			{"mData": "code"},			
			{"mData": "name"},
												
			
			{"mData": "grp",
				"mRender" : function ( data, type, par ) {				
					if(par.grp == 0 ||par.grp == ''||par.grp == null){
						return "<font color='#ff0000'>Unidentify</font>"; 			
					}else{
						return par.grp; 
					} 				
				}
			},<?php if($p1 == 1){?>
			{"mData": "p1_id",
				"mRender" : function ( data, type, full ) {				
					if(full.p1_id == 1){
						return "<center><input  data-id="+full.id+" type='checkbox' id='active' class='checkbox' value='2'/></center>"; 
					}else{
						return "<center><input  data-id="+full.id+" checked type='checkbox' id='active' class='checkbox' value='1'/></center>"; 			
					} 				
				}
			},
			<?php } ?>
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
				url: '<?php echo site_url('apps/itemlist/execute/active/'); ?>',
				type: 'post',
				data: 'active=2&id='+i,
				success: function(result)
				{
					$('span-'+id).removeClass('label-default ').addClass('label-info');
					$('span-'+id).html('Active');					
				}
			});
		}else {
			//alert("unchecked");
			$.ajax({
				url: '<?php echo site_url('apps/itemlist/execute/active/'); ?>',
				type: 'post',
				data: 'active=1&id='+i,							
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
			url: '<?php echo base_url().'index.php/apps/itemlist/execute/delete/';?>'+id,
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