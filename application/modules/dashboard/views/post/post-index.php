<!-- PAGE table -->
<div class="row">
	<div class="col-md-12">
		<!-- BOX -->
		<div class="box border green">
			<div class="box-title">
				<h4><i class="fa fa-table"></i>Post Management</h4> 
				<div class="tools hidden-xs">
					<a  class="btn btn-warning btn-xs" href="<?php echo site_url('cms/post/add');?>">Add New</a>
				<br/>
				</div>
			</div>
			<div class="box-body">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
					<thead>
						<tr>
							<th>Title</th>
							<th>Author</th>
							<th><i class="fa fa-comment"></i> Comment</th>
                            <th>Date</th>                           
							<th>Status</th>							
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
var url = "<?php echo site_url();?>/";
$(document).ready(function() {    
    $('#data').dataTable({
        'sPaginationType': 'bs_full',
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": url+"cms/post/load",
        "sServerMethod": "POST",        
        "aaSorting": [[1, "asc"]],
        "iDisplayLength": 10,           
        "aoColumns" : [                                    
            {"mData": "post_title",                
                "mRender" : function ( data, type, par ) {                    
                    return "<a href='#' > "+par.post_title+"</a>";             
                }    
            },
            {"mData": "first_name"},
            {"mData": "comment_count",
                "mRender" : function ( data, type, par ) {                    
                    return "<a href='#' ><i class='fa fa-comment-o'> "+par.comment_count+"</i></a>";             
                }    
            },
            {"mData": "post_date"},
            {"mData": "post_status",
                "mRender" : function ( data, type, full ) {             

                    if(full.post_status == 0){
                        return "<center><input  data-id="+full.ID+" checked type='checkbox' id='active' class='checkbox' value='1'/><span-"+full.ID+" class='label label-primary'> Publish</span></center>";             
                    }else{
                        return "<center><input  data-id="+full.ID+" type='checkbox' id='active' class='checkbox' value='0'/><span-"+full.ID+" class='label label-danger'> Unpublish</span></center>"; 
                    }               
                }
            },            
            {"mData": "show",
            	"mRender" : function ( data, type, full ) {             
            		var link = '<a  title="Edit"class="btn btn-warning btn-xs" href='+url+'cms/post/edit/'+full.ID+'><i class="fa fa-pencil"></i></a> || '+
            		'<button title="Delete" class="btn btn-danger btn-xs" data-id='+full.ID+' onclick="del(this);"><i class="fa fa-trash-o"></i></button>';
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
                url: url+'cms/post/execute/active',
                type: 'post',
                data: 'active=0&id='+i,
                success: function(result)
                {
                    $('span-'+id).removeClass('label-danger').addClass('label-default');
                    $('span-'+id).html('Publish');                   
                    //window.location.reload();
                }
            });
        }else {
            $.ajax({
                url: url+'cms/post/execute/active',
                type: 'post',
                data: 'active=1&id='+i,                         
                success: function(result){
                
                    $('span-'+id).removeClass('label-default').addClass('label-danger');
                    $('span-'+id).html('Unpublish');
                    //window.location.reload();
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
			url: url+'cms/post/execute/delete/',
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
