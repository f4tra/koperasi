	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>GUI</h4> 
					<div class="tools hidden-xs">
					<a href="#box-config" data-toggle="modal" class="config">
					<i class="fa fa-cog"></i>
					</a>
					<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
					</a>
					<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
					</a>
					<a href="javascript:;" class="remove">
					<i class="fa fa-times"></i>
					</a>
					</div>
				</div>
				<div class="box-body">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
				<thead>
					<tr>
						<th>ID</th>
						<th>Code</th>
						<th>Name</th>
						<th>Caption</th>
						<th>Link</th>
						<th>Parent</th>
						<th>Active</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
						<tr>
							<td colspan="8">Loading Data</td>
						</tr>
				</tbody>
				</table>
				<!-- <table class="table tree table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<td> GUI </td>
							<td> Action  </td>
						</tr>
					</thead>
					<tbody>		
						<?php 
						$induk = $this->mgeneral->getWhere(array('parent_id'=>0),'tr_gui');
						foreach ($induk as $key => $value) {
						?>
						<tr class="treegrid-<?php echo $value->id;?>">	
          					<td><?php echo $value->name." - ".$value->caption;?></td><td><a  class="btn btn-warning" href="<?php echo site_url('setup/screen/add_child/'.$value->id);?>">Add New</a></td>
       					</tr>
       					<?php 
						$child = $this->mgeneral->getWhere(array('parent_id'=>$value->id),'tr_gui');
						foreach ($child as $key => $value2) {
						?>
        				<tr class="treegrid-<?php echo $value2->id;?> treegrid-parent-<?php echo $value->id;?>">
          					<td><?php echo $value2->name." - ".$value2->caption;?></td><td><a  class="btn btn-warning" href="<?php echo site_url('setup/screen/add_child/'.$value2->id);?>">Add New</a></td>
        				</tr>
        				<?php } ?>
        				<?php 
						$end = $this->mgeneral->getWhere(array('parent_id'=>$value2->id),'tr_gui');
						foreach ($end as $key => $value3) {
						?>
				        <tr class="treegrid-<?php echo $value3->id;?> treegrid-parent-<?php echo $value2->id;?>">
				        	<td><?php echo $value3->name." - ".$value3->caption;?></td><td><a  class="btn btn-warning" href="<?php echo site_url('setup/screen/add_child/'.$value3->id);?>">Add New</a></td>
				        </tr>
        				<?php } ?>
        				<?php } ?>
        			</tbody> 
				</table> -->
					 <a  class="btn btn-warning" href="<?php echo site_url('setup/screen/add');?>">Add New</a>
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
	$('.tree').treegrid({
        'initialState': 'collapsed',
        'saveState': true,
    expanderExpandedClass: 'glyphicon glyphicon-minus',
        expanderCollapsedClass: 'glyphicon glyphicon-plus',
    });
	$('#data').dataTable({
		'sPaginationType': 'bs_full',
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "<?php echo site_url('setup/screen/load');?>",
		"sServerMethod": "POST",
		/* "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			if(aData.active == 1){
				$('td:eq(2)', nRow).html("<input  data-id="+aData.id+" checked type='checkbox' id='active' class='checkbox' value='0'/>&nbsp;&nbsp;<span-"+aData.id+" class='label label-info'>Active</span>"); 			
			}else{
				$('td:eq(2)', nRow).html("<input  data-id="+aData.id+" type='checkbox' id='active' class='checkbox' value='1'/>&nbsp;&nbsp;<span-"+aData.id+" class='label label-default'>Inactive</span>"); 
			}
			return nRow;
		}, */
		"aaSorting": [[1, "asc"]],
		"iDisplayLength": 10,			
		"aoColumns" : [
			{"mData": "id"},
			{"mData": "code"},
			{"mData": "name"},
			{"mData": "caption"},
			{"mData": "link"},
			{"mData": "parent",
				"mRender" : function ( data, type, par ) {				
					console.log(par.parent);
					if(par.parent == null || par.parent == '0' || par.parent == 0){
						return "<font color = '#ff0000'>Main Modul</font>"; 			
					}else{
						return par.parent; 
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
				url: '<?php echo site_url('setup/screen/execute/active/'); ?>',
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
				url: '<?php echo site_url('setup/screen/execute/active/');?>',
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
			url: '<?php echo base_url().'index.php/setup/screen/execute/delete/';?>'+id,
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
				console.log(data);
				location.reload();
				//$('#load').load('<?=base_url().'index.php/setup/screen/load_data';?>');
			},	
		});
		return false;
	}
}
</script>
<script type="text/javascript">
    
</script>
