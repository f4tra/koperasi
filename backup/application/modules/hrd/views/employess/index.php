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
						<th>ID</th>
						<th>Emp No</th>
						<th>Name</th>															
						<th>Cellphone</th>						
						<th>Division</th>												
						<th>Functional</th>						
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="7">Loading Data</td>
					</tr>
				</tbody>
				</table>
					<a class="btn btn-warning" href="<?php echo site_url('hrd/employess/form');?>">Add New</a>
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
		"sAjaxSource": "<?php echo site_url('hrd/employess/load');?>",
		"sServerMethod": "POST",
		"aaSorting": [[0, "asc"]],
		"iDisplayLength": 10,			
		"aoColumns" : [
			
			{"mData": "id"},
			{"mData": "code"},
			{"mData": "first_name",
				"mRender" : function ( data, type, par ) {				
					return par.first_name+" "+par.mid_name+" "+par.last_name; 					 				
				}
			},
			{"mData": "phone1"},
			{"mData": "dname",
				"mRender" : function ( data, type, pardname ) {				
					if(pardname.dname == 0 ||pardname.dname == ''||pardname.dname == null){
						return "<font color='#ff0000'>Unidentify</font>"; 			
					}else{
						return pardname.dname; 
					} 				
				}
			},
			{"mData": "fname",
				"mRender" : function ( data, type, fnames ) {				
					if(fnames.fname == 0 ||fnames.fname == ''||fnames.fname == null){
						return "<font color='#ff0000'>Unidentify</font>"; 			
					}else{
						return fnames.fname; 
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
				url: '<?php echo site_url('hrd/employess/execute/active/'); ?>',
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
				url: '<?php echo site_url('hrd/employess/execute/active/'); ?>',
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
			url: '<?php echo base_url().'index.php/hrd/employess/execute/delete/';?>'+id,
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
function print(action){
	var id = $(action).attr('data-id-print');		
	$.ajax({
		url: '<?php echo base_url().'index.php/hrd/employess/convert_to_pdf/';?>'+id,
		type: "POST",
		data:{data:id},
		crossDomain:true,
		beforeSend: function(){
			$("#msg").html("loading"); 
		},
		complete : function(){
			//$("#msg").html("delete Sukses"); 
		}, 
		success: function(data) {				
			//location.reload();
		},	
	});
}
</script>