<div class="row">
	<div id="content" class="col-lg-12">
		<!-- PAGE HEADER-->
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
				<!-- STYLER -->
				<!-- /STYLER -->
				<!-- BREADCRUMBS -->
				<!--<ul class="breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
					</li>
					<li>
					<a href="#">Other Pages</a>
					</li>
						<li>Blank Page</li>
				</ul>-->
				<!-- /BREADCRUMBS -->
				<div class="clearfix">
					<h3 class="content-title pull-left">Item Type</h3>
				</div>
				<div class="description"></div>
				</div>
			</div>
		</div>
	<!-- /PAGE HEADER -->
	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Item Type</h4> 					
				</div>
				<div class="box-body">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
				<thead>
					<tr>
						<th>Code</th>
						<th>Name</th>						
						<th>Node Category</th>						
						<th>Active</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="5">Loading Data</td>
					</tr>
				</tbody>
				</table>
					<a class="btn btn-warning" href="<?php echo site_url('item/itemtype/form');?>">ADD</a>
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
		"sAjaxSource": "<?php echo site_url('item/itemtype/load');?>",
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
			{"mData": "name"},			
			{"mData": "category"},			
			{"mData": "active",
				"mRender" : function ( data, type, full ) {				
					if(full.active == 1){
						return "<input  data-id="+full.id+" checked type='checkbox' id='active' class='checkbox' value='0'/>&nbsp;&nbsp;<span-"+full.id+" class='label label-info'>Active</span>"; 			
					}else{
						return "<input  data-id="+full.id+" type='checkbox' id='active' class='checkbox' value='1'/>&nbsp;&nbsp;<span-"+full.id+" class='label label-default'>Inactive</span>"; 
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
				url: '<?php echo site_url('item/itemtype/execute/active/'); ?>',
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
				url: '<?php echo site_url('item/itemtype/execute/active/'); ?>',
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
			url: '<?php echo base_url().'index.php/item/itemtype/execute/delete/';?>'+id,
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