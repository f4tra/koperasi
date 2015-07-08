/*var url = "http://localhost/koperasi/index.php/";
$(document).ready(function() {    
    $('#data_menu').dataTable({
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
    $('#data_menu').each(function(){
        var datatable = $(this);
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.addClass('form-control input-sm');
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.addClass('form-control input-sm');
    });
    $('#data_menu').delegate('.checkbox','change',function() {
        var i = $(this).attr('data-id');        
        var id = $(this).attr('data-id');
        if(this.checked){            
            $.ajax({
                url: url+'setup/menu/execute/active',
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
                url: url+'setup/menu/execute/active',
                type: 'post',
                data: 'active=0&id='+i,                         
                success: function(result)
                {
                    $('span-'+id).removeClass('label-info ').addClass('label-default');
                    $('span-'+id).html('Inactive');
                }
            });
        }
    });
});*/