<div class="row">
    <div class="col-md-12">
        <!-- BOX -->
        <div class="box border green">
            <div class="box-title">
                <h4><i class="fa fa-book"></i>Unit Koperasi</h4>                
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="contact-card" class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">John Doe</h2>
                            </div>
                            <div class="panel-body">
                                <div id="card" class="row">
                                    <div class="col-md-3 headshot">
                                        <img src="<?php echo base_url();?>assets/beckend/img/addressbook/1.jpg" alt="" height="200" width="200">
                                    </div>
                                    <div class="col-md-9">
                                        <table class="table table-hover">
                                            <tbody>
                                              <tr>                  
                                                <td><i class="fa fa-font"></i> Name</td>
                                                <td id="card-name">John Doe</td>
                                              </tr>
                                              <tr>
                                                <td><i class="fa fa-home"></i> Address</td>
                                                <td>795 Folsom Ave, Suite 600
                                                    San Francisco, CA 94107
                                                    P: (123) 456-7890 </td>
                                              </tr>
                                              <tr>
                                                <td><i class="fa fa-phone"></i> Phone</td>
                                                <td>+001 8753-3648-002</td>
                                              </tr>
                                              <tr>
                                                <td><i class="fa fa-envelope"></i> Email</td>
                                                <td>sampleemail@gmail.com</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /BOX -->
    </div>
</div>
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
        "sAjaxSource": url+"setup/menu/load",
        "sServerMethod": "POST",        
        "aaSorting": [[1, "asc"]],
        "iDisplayLength": 10,           
        "aoColumns" : [                                    
            {"mData": "code"},
            {"mData": "name"},
            {"mData": "label"},
            {"mData": "link"},
            {"mData": "parent",
                "mRender" : function ( data, type, par ) {                    
                    if(par.parent == null || par.parent == '0' || par.parent == 0){
                        return "<font color = '#ff0000'>Main Modul</font>";             
                    }else{
                        return par.parent; 
                    }               
                }
            },
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
            		var link = '<a  title="Edit"class="btn btn-warning btn-xs" href='+url+'setup/menu/edit/'+full.id+'><i class="fa fa-pencil"></i></a> || '+
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
                url: url+'setup/menu/execute/active',
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
                url: url+'setup/menu/execute/active',
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
			url: url+'setup/menu/execute/delete/'+id,
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
