<!-- DROPZONE -->
						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border blue">
									<div class="box-title">
										<h4><i class="fa fa-cloud-arrow-circle-o-up"></i>Cloud Upload Manager</h4>
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
													<th>No</th>
													<th>Document Type</th>
													<th>Name</th>															
													<th width="35%">Option</th>													
												</tr>
											</thead>
											<tbody>
												<?php $no = 1; foreach ($type_id as $key => $value) {
													echo "<tr>";
													echo "<td>".$no."</td>";
													echo "<td>".$value->name."</td>";
													echo "<td><ul>";
													$tt_doc = $this->db->query('select * from tt_item_doc where type_id="'.$value->id.'"')->result();
														foreach ($tt_doc as $key => $val) {
															echo "<li><a href=".site_url('unitstock/productavailable/download/'.$val->id).">".$val->filename."</a>   <button type='button' onclick='removes(this);' data-id='".$val->id."'><i class='fa fa-trash-o'></i></button></li>";
														}
													
													echo "<ul>

													</td>";
													?>
													<td>
													<form id="form_<?php echo $value->id;?>" method="post" enctype="multipart/form-data">
														
														<input onclick="up(<?php echo $value->id;?>);" type="submit" class="btn btn-success btn-s pull-right" value="Upload">
														<input type="hidden" value="<?php echo $idx;?>" name="item_id" id="item_id">
														<input type="hidden" value="<?php echo $value->id;?>" name="type_id" id="type_id">
														<input  name="userfile" id="userfile" type="file" class="btnbtn-info">
														
													</form>
											
													</td>
													<?php
													//echo "<td></td>";
													echo "</tr>";
													# code...
												$no++;} 
													?>
												
											</tbody>
										</table>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
						<!-- /DROPZONE -->
<script>
function up(btn){
	
	$('#form_'+btn).validate({
        submitHandler: function(form){
			var formData = new FormData(form);
        	//alert('sdf');
        	$.ajax({
                url: '<?php echo base_url();?>index.php/unitstock/productavailable/action_upload',
                type: "POST",
                //dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                
                success:function(data){ 
                //console.log(data);                 
                   $.pnotify({
                        title: "Uplaod Succes",
                        text: "Uplaod Succes",
                        animation: {
                            effect_in: 'show',
                            effect_out: 'slide'
                        },
                        type : "success",
                    });
                    setInterval(function() {
                        //window.location = "./";
                        location.reload();
                    }, 1000);                
                },
                error: function(){
                    $("#msg").slideDown();
                }
            });
        },
        debug:true,
    });
}
function removes(btn){
	var tanya = confirm("are you will delete this file?")
	if(tanya == true){
		var id = $(btn).attr('data-id');		
		$.ajax({
			url: "<?php echo site_url('unitstock/productavailable/remove_file/');?>",
			type: "POST",
			data:{data_id:id},
			crossDomain:true,
			beforeSend: function(){
				$("#msg").html("loading"); 
			},			 
			success: function(data) {				
				setInterval(function() {
                	location.reload();
                }, 1000);
			},	
		});
	}
}
$(document).ready(function() {
	$('#data').dataTable({
		'sPaginationType': 'bs_full',
		"bProcessing": true,
		"aaSorting": [[0, "asc"]],
		"iDisplayLength": 10,			
		
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
</script>