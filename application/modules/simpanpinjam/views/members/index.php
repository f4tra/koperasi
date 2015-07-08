<!-- PAGE table -->
<div class="row">
	<div class="col-md-12">
		<!-- BOX -->
		<div class="box border green">
			<div class="box-title">
				<h4><i class="fa fa-table"></i>Member List</h4> 
				<div class="tools hidden-xs">
					<a  class="btn btn-warning btn-xs" href="<?php echo site_url('simpanpinjam/member/add');?>">Add New</a>
				<br/>
				</div>
			</div>
			<div class="box-body">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
					<thead>
						<tr>
							<th>NIK</th>
                            <th>Fullname</th>                           
							<th>Unit</th>							
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
			</div>
		</div>		
	</div>
</div>	
<!-- /PAGE table -->		
<div class="separator"></div>
<div class="footer-tools">
	<span class="go-top"><i class="fa fa-chevron-up"></i> Top </span>
</div>
	
<script type="text/javascript">
var url = "<?php echo site_url();?>";
$(document).ready(function() {    
    $('#data').dataTable({
        'sPaginationType': 'bs_full',
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": url+"simpanpinjam/member/load",
        "sServerMethod": "POST",        
        "aaSorting": [[1, "asc"]],
        "iDisplayLength": 10,           
        "aoColumns" : [                                    
            {"mData": "nik"},
            {"mData": "fullname"},
            {"mData": "unit_name"},           
            {"mData": "active",
                "mRender" : function ( data, type, full ) {             

                    if(full.active == 0){
                        return "<center><input  data-id="+full.id+" checked type='checkbox' id='active' class='checkbox' value='1'/></center>";             
                    }else{
                        return "<center><input  data-id="+full.id+" type='checkbox' id='active' class='checkbox' value='0'/></center>"; 
                    }               
                }
            },
            {"mData": "show",
            	"mRender" : function ( data, type, full ) {             
            		var link = '<a  title="Edit"class="btn btn-warning btn-xs" href='+url+'simpanpinjam/member/edit/'+full.id+'><i class="fa fa-pencil"></i></a> || '+
            		'<button title="Delete" class="btn btn-danger btn-xs" data-id='+full.id+' onclick="del(this);"><i class="fa fa-trash-o"></i></button>';
					return link;
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
    $('#data').delegate('.checkbox','change',function() {
        var i = $(this).attr('data-id');        
        var id = $(this).attr('data-id');
        if(this.checked){            
            $.ajax({
                url: url+'simpanpinjam/member/execute/active',
                type: 'post',
                data: 'active=0&id='+i,
                success: function(result)
                {
                    $('span-'+id).removeClass('label-default ').addClass('label-info');
                    $('span-'+id).html('Active');                   
                    window.location.reload();
                }
            });
        }else {
            $.ajax({
                url: url+'simpanpinjam/member/execute/active',
                type: 'post',
                data: 'active=1&id='+i,                         
                success: function(result)
                {
                    $('span-'+id).removeClass('label-info ').addClass('label-default');
                    $('span-'+id).html('Inactive');
                    window.location.reload();
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
			url: url+'simpanpinjam/member/execute/delete/'+id,
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
				$("#data").dataTable().fnClearTable();
			},	
		});
		return false;
	}
}
</script>
