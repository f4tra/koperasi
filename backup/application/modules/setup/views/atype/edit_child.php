
	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-table"></i></i><?php 
					$f = $this->uri->segment(4);
					$h = $this->db->query("select name,parent_id,id from tr_wf_type where id = '".$f."'")->row();
					echo $h->name;
					//print_r($f);

					 ?></h4> 
					
				</div>

				<div class="box-body">
					<?php 
						$sql = "select count(*) as chekin from tr_wf_type where parent_id= '".$h->id."'";
						$counts = $this->db->query($sql)->row();
						
						if($counts->chekin <= 0 ){
					?>
					<div class="tabbable box-tabs">
	                	<ul class="nav nav-tabs">
	                    	<li>
	                        	<a href="#box_tab6" data-toggle="tab"><i class="fa fa-flask"></i>Role</a>
	                        </li>
	                        <li>
	                        	<a href="#box_tab5" data-toggle="tab"><i class="fa fa-flask"></i>Menus</a>
	                        </li>
	                        <li class="active">
	                        	<a href="#box_tab4" data-toggle="tab">Description</a>
	                        </li>
	                    </ul>
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form">
					<div class="tab-content">
                    	<!--START TAB4-->        
                        <div class="tab-pane active" id="box_tab4">

							<div class="form-group">
								<label class="col-md-2 control-label">Code:</label> 
								<div class="col-md-4">
									<input type="text" value="<?php echo $edit->code;?>" name="code" id="code" class="form-control" placeholder="Code" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Name:</label> 
								<div class="col-md-4">
									<input type="text" value="<?php echo $edit->name;?>" name="name" id="name" class="form-control" placeholder="Name" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">P_Left:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->p_left;?>" type="text" name="left" id="left" class="form-control" placeholder="Left" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">P_Top:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->p_top;?>" type="text" name="top" id="top" class="form-control" placeholder="TOP" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">P_Width:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->p_width;?>" type="text" name="width" id="width" class="form-control" placeholder="Width" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Description:</label> 
								<div class="col-md-4">
									<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"><?php echo $edit->descr;?> </textarea>
								</div>
							</div>	
							<div class="form-group">
								<label class="col-md-2 control-label">Type ID:</label> 
								<div class="col-md-4">
									<span class="label label-primary" ><?php echo $type->name;?></span>
									<!-- <select name="type_id" id="type_id" class="select2-01 col-md-12 full-width-fix">
									<option value="0">Unidentify</option>
									<?php foreach($type as $g){
										if($g->id == $edit->type_id){
											$a = "selected";
										}else{
											$a = "";
										}
									?>
										<option  <?php echo $a; ?> value="<?php echo $g->id;?>"><?php echo $g->name;?></option>
										<?php } ?>
									</select> -->
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Parent:</label> 
								<div class="col-md-4">
									<select name="parent_id" id="parent_id" class="select2-01 col-md-12 full-width-fix">
									<!-- <option value="0">Unidentify</option> -->
									<?php foreach($data as $g){
										if($g->id == $edit->parent_id){
											$a = "selected";
										}else{
											$a = "";
										}
									?>
										<option  <?php echo $a; ?> value="<?php echo $g->id;?>"><?php echo $g->name;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Active:</label> 
								<div class="col-md-4">
									<select class="form-control" name="active" id="active" class="select2-01 col-md-12">
										<option <?php if($edit->active == 1){echo "selected";}else{echo "";}?> value="1">Active</option>
										<option <?php if($edit->active == 0){echo "selected";}else{echo "";}?> value="0">Inctive</option>
									</select>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="box_tab5">
						<div class="form-group">
								<label class="col-md-2 control-label">GUI:</label> 
								<div class="col-md-4">
									<select name="gui_id" id="gui_id" class="select2-01 col-md-12 full-width-fix">
									<option value="0">Unidentify</option> 
									<?php foreach($gui as $g){
										if($g->id == $edit->gui_id){
											$a = "selected";
										}else{
											$a = "";
										}
									?>
										<option  <?php echo $a; ?> value="<?php echo $g->id;?>"><?php echo $g->name;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="box_tab6">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Code</th>
									<th>Name</th>							
									<th>Active</th>									
							</thead>
							<tbody>
								<?php 
								//print_r($count_rgui);
								foreach ($count_rgui as $key => $value) {
									echo "<tr>";
										echo "<td></td>";
										echo "<td>".$value->rcode."</td>";
										echo "<td>".$value->rname."</td>";
										if($value->c <= 0){
											echo "<td><center><input  data-id='".$value->c."' type='checkbox' id='active' class='checkbox' value='1'/></center></td>";
										}else{
											echo "<td><center><input  data-id='' checked type='checkbox' id='active' class='checkbox' value='0'/></center></td>";
										}
										//echo "<td>".$value->c."</td>";
									echo "</tr>";
								}
								?>
								
							</tbody>
							</table>
							
						<!-- <div class="form-group">
								<label class="col-md-2 control-label">Role GUI:</label> 
								<div class="col-md-4">
									<select name="role_id" id="role_id" class="select2-01 col-md-12 full-width-fix">
									<option value="0">Unidentify</option> 
									<?php foreach($role_gui as $g){
										if($g->id == $edit->role_id){
											$a = "selected";
										}else{
											$a = "";
										}
									?>
										<option  <?php echo $a; ?> value="<?php echo $g->id;?>"><?php echo $g->name;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div> -->
					</div>
					<input type="submit" class="btn btn-info btn-lg pull-right" onclick="save(this);" value="Save"/>					
					</form>
					<?php }else{
					?>
						<!-- Form-->
						<form class="form-horizontal row-border"  method="post" id="form">
							<div class="form-group">
								<label class="col-md-2 control-label">Code:</label> 
								<div class="col-md-4">
									<input type="text" value="<?php echo $edit->code;?>" name="code" id="code" class="form-control" placeholder="Code" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Name:</label> 
								<div class="col-md-4">
									<input type="text" value="<?php echo $edit->name;?>" name="name" id="name" class="form-control" placeholder="Name" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">P_Left:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->p_left;?>" type="text" name="left" id="left" class="form-control" placeholder="Left" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">P_Top:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->p_top;?>" type="text" name="top" id="top" class="form-control" placeholder="TOP" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">P_Width:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->p_width;?>" type="text" name="width" id="width" class="form-control" placeholder="Width" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Description:</label> 
								<div class="col-md-4">
									<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"><?php echo $edit->descr;?> </textarea>
								</div>
							</div>	
							<div class="form-group">
								<label class="col-md-2 control-label">Type ID:</label> 
								<div class="col-md-4">
									<span class="label label-primary" ><?php echo $type->name;?></span>
									<!-- <select name="type_id" id="type_id" class="select2-01 col-md-12 full-width-fix">
									<option value="0">Unidentify</option>
									<?php foreach($type as $g){
										if($g->id == $edit->type_id){
											$a = "selected";
										}else{
											$a = "";
										}
									?>
										<option  <?php echo $a; ?> value="<?php echo $g->id;?>"><?php echo $g->name;?></option>
										<?php } ?>
									</select> -->
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Parent:</label> 
								<div class="col-md-4">
									<select name="parent_id" id="parent_id" class="select2-01 col-md-12 full-width-fix">
									<!-- <option value="0">Unidentify</option> -->
									<?php foreach($data as $g){
										if($g->id == $edit->parent_id){
											$a = "selected";
										}else{
											$a = "";
										}
									?>
										<option  <?php echo $a; ?> value="<?php echo $g->id;?>"><?php echo $g->name;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Active:</label> 
								<div class="col-md-4">
									<select class="form-control" name="active" id="active" class="select2-01 col-md-12">
										<option <?php if($edit->active == 1){echo "selected";}else{echo "";}?> value="1">Active</option>
										<option <?php if($edit->active == 0){echo "selected";}else{echo "";}?> value="0">Inctive</option>
									</select>
								</div>
							</div>	
							<input type="submit" class="btn btn-info btn-lg pull-right" onclick="save(this);" value="Save"/>					
						</form>
						<?php } ?>
					<div class="row"></div>
					<br />
					<div id="msg"></div>
					<!-- /Form-->
				</div>
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
		
	
	</div>
</div>
<script type="text/javascript">

$(document).ready(function(){
	$('#data').dataTable({
		'sPaginationType': 'bs_full',
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "<?php echo site_url('setup/atype/load_role');?>",
		"sServerMethod": "POST",
		/* "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			if(aData.active == 1){
				$('td:eq(2)', nRow).html("<input  data-id="+aData.id+" checked type='checkbox' id=active class='checkbox' value='0'/>&nbsp;&nbsp;<span-"+aData.id+" class='label label-info'>Active</span>"); 			
			}else{
				$('td:eq(2)', nRow).html("<input  data-id="+aData.id+" type='checkbox' id=active class='checkbox' value='1'/>&nbsp;&nbsp;<span-"+aData.id+" class='label label-default'>Inactive</span>"); 
			}
			return nRow;
		}, */
		"aaSorting":  [[1, "asc"]],
		"iDisplayLength": 10,			
		"aoColumns" : [
			{"mData": "id"},			
			{"mData": "code"},			
			{"mData": "name"},
			{"mData": "active",
				"mRender" : function ( data, type, full ) {				
					<?php 
						//$this->db->query('select * from tr_role_gui where role_id="'..'"')	
					?>
					if(full.active == 1){
						return "<center><input  data-id="+full.id+" checked type='checkbox' id='active' class='checkbox' value='0'/></center>"; 			
					}else{
						return "<center><input  data-id="+full.id+" type='checkbox' id='active' class='checkbox' value='1'/></center>"; 
					} 				
				}
			},
			//{"mData": "show"},
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
// Fungsi Untuk Tambah Data
function save(){
	$('#form').validate({
	    rules: {
	      code: {	        
	        required: true
	      },
	      name: {
	        required: true,
	      },
	    },
		highlight: function(element) {
			$(element).closest('.control-group').removeClass('success').addClass('error');
		},
		success: function(element) {
			element
			.text('OK!').addClass('valid')
			.closest('.control-group').removeClass('error').addClass('success');
		},
		submitHandler: function(form){
			$.ajax({
				url: '<?php echo base_url();?>index.php/setup/atype/execute_child/update/<?php echo $edit->id;?>',
				type: "POST",
				dataType:"json",
				data: $("#form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
				
					$.pnotify({
						title: data.message,
						text: data.message,
						animation: {
							effect_in: 'show',
							effect_out: 'slide'
						},
						type : "success",
					});
					setInterval(function() {
						window.location = "../../child/"+"<?php echo $f;?>";
					}, 1000);					
				},
				error: function(){
					$("#msg").slideDown();
				}
			}); 
		},			
		debug:true
	});	
} 
</script>

<style type="text/css">
	label.valid {
		width: 24px;
		height: 24px;
		display: inline-block;
		text-indent: -9999px;
	}
	label.error {
		font-weight: bold;
		color: red;
		padding: 2px 8px;
		margin-top: 2px;
	}
</style>