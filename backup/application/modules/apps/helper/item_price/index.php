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
						<th>Item</th>																																				
						<th>Harga Beli</th>																																				
						<th>Harga Jual</th>																																				
						<th>Promo 1</th>																																				
						<th>Promo 2</th>																																				
						<th width="20%">Options</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="7">Loading Data</td>
					</tr>
				</tbody>
				</table>
					<a class="btn btn-warning" href="<?php echo site_url('apps/itemprice/form');?>">Add New</a>
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
		"sAjaxSource": "<?php echo site_url('apps/itemprice/load');?>",
		"sServerMethod": "POST",
		/* "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			if(aData.active == 1){
				$('td:eq(2)', nRow).html("<input  data-id="+aData.id+" checked type='checkbox' id='active' class='checkbox' value='0'/>&nbsp;&nbsp;<span-"+aData.id+" class='label label-info'>Active</span>"); 			
			}else{
				$('td:eq(2)', nRow).html("<input  data-id="+aData.id+" type='checkbox' id='active' class='checkbox' value='1'/>&nbsp;&nbsp;<span-"+aData.id+" class='label label-default'>Inactive</span>"); 
			}
			return nRow;
		}, */
		"aaSorting": [[0, "asc"]],
		"iDisplayLength": 10,			
		"aoColumns" : [
			
			{"mData": "code"},
			{"mData": "item",
				"mRender" : function ( data, type, y ) {				
					if(y.item == 0 ||y.item == ''||y.item == null){
						return "<font color='#ff0000'>Unidentify</font>"; 			
					}else{
						return y.item; 
					} 				
				}
			},
			{"mData": "price1"},
			{"mData": "price2"},
			{"mData": "price3"},
			{"mData": "price4"},
										
			
			{"mData": "id",
				"mRender" : function ( data, type, idx ) {	
					//alert(idx.id);			
					return "<a title='Upload File' class='btn btn-success btn-m' href='<?php echo site_url('apps/itemprice/upload/');?>/"+idx.id+"'><i class='fa fa-cloud-upload'></i></a>  <a title='Edit "+idx.name+"' class='btn btn-warning btn-m' href='<?php echo site_url('apps/itemprice/form/');?>/"+idx.id+"'><i class='fa fa-pencil'></i></a> <button title='Delete "+idx.name+"' class='btn btn-danger btn-m' data-id='"+idx.id+"' onclick='del(this);''><i class='fa fa-trash-o'></i></button>"; 
					//return "<a title='Upload File' class='btn btn-success btn-m' href='<?php echo site_url('unitstock/productavailable/upload/');?>/"+idx.id+"'><i class='fa fa-cloud-upload'></i></a> <a title='Price History' class='btn btn-purple btn-m' href='<?php echo site_url('unitstock/productavailable/price_history');?>/"+idx.item_id+"'><i class='fa fa-tag'></i></a> <a title='Edit "+idx.name+"' class='btn btn-warning btn-m' href='<?php echo site_url('unitstock/productavailable/form/');?>/"+idx.id+"'><i class='fa fa-pencil'></i></a> <button title='Delete "+idx.name+"' class='btn btn-danger btn-m' data-id='"+idx.id+"' onclick='del(this);''><i class='fa fa-trash-o'></i></button>"; 
					 				
				}
			},
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
			url: '<?php echo base_url().'index.php/unitstock/productavailable/execute/delete/';?>'+id,
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