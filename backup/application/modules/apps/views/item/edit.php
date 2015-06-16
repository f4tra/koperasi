
	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-preorder"></i><?php //echo $this->uri->segment(2); ?> </h4> 
				
				</div>
				<div class="box-body">
					<div class="tabbable box-tabs">
                	<ul class="nav nav-tabs">
                    	<!-- <li>
                    		<a href="#box_tab9" data-toggle="tab"><i class="fa fa-desktop"></i>Images</a>
                    	</li>
                    	<li>
                    		<a href="#box_tab8" data-toggle="tab"><i class="fa fa-desktop"></i>Owner History</a>
                    	</li>
                        <li>
                        	<a href="#box_tab7" data-toggle="tab"><i class="fa fa-desktop"></i>Price History</a>
                        </li>
                        <li>
                        	<a href="#box_tab6" data-toggle="tab"><i class="fa fa-desktop"></i>Issuer</a>
                        </li> -->
                        <li>
                        	<a href="#box_tab5" data-toggle="tab"><i class="fa fa-flask"></i>Description</a>
                        </li>
                        <li >
                        	<a href="#box_tab4" data-toggle="tab">Specification</a>
                        </li>
                        <li class="active">
                        	<a href="#box_tab3" data-toggle="tab">Basic Info</a>
                        </li>
                    </ul>
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form" enctype="multipart/form-data">
                	<div class="tab-content">
                		<!--START TAB4-->        
                        <div class="tab-pane active" id="box_tab3">
                        		<div class="form-group">
							<label class="col-md-2 control-label">Code:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->code; ?>" type="text" name="code" id="code" class="form-control" placeholder="Code" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Name:</label> 
							<div class="col-md-4">
								<input value="<?php echo $edit->name; ?>"  type="text" name="name" id="name" class="form-control" placeholder="Name" />
							</div>
						</div>

						
						<div class="form-group">
							<label class="col-md-2 control-label">Category:</label> 
							<div class="col-md-4">
								<select name="ctg" id="ctg" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php 
								foreach($ctg as $g){
									if($g->id == $edit->ctg_id){
										$a = "selected";
									}else{
										$a = "";
									}
								?>
									<option  <?php echo $a?> value="<?php echo $g->id;?>"><?php echo $g->code." ".$g->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Group:</label> 
							<div class="col-md-4">
								<?php
									if(empty($grp_id)){

									//echo $grp_id->name." / ".$type_id->name;
									}else{
										
										echo $grp_id->name;
									} 	
								?>
									
							</div>
						</div>	
						<div class="form-group">
							<label class="col-md-2 control-label">Type:</label> 
							<div class="col-md-4">
								<?php
									if(empty($type_id)){

									//echo $grp_id->name." / ".$type_id->name;
									}else{
										
									echo $type_id->name;
									} 	
								?>
									
							</div>
						</div>						
						<div class="form-group">
							<label class="col-md-2 control-label">Active:</label> 
							<div class="col-md-4">
								<select class="form-control" name="active" id="active">
									<option selected value="1">Active</option>
									<option value="0">Inctive</option>
								</select>
							</div>
						</div>
                        </div>
                        <div class="tab-pane" id="box_tab4">
	                        <div class="form-group">
								<label class="col-md-2 control-label">Dimensi 1:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->dim1; ?>" type="text" name="dim1" id="dim1" class="form-control" placeholder="Dimensi 1" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Dimensi 2:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->dim2; ?>"type="text" name="dim2" id="dim2" class="form-control" placeholder="Dimensi 2" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Grade:</label> 
								<div class="col-md-4">							
									<select  name="grade" id="grade" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($grade as $key => $value) {
												if($value->id == $edit->x_id){
												$a = "selected";
									}else{
										$a = "";
									}
												print '<option '.$a.' value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
											}
										?>									
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Jenis:</label> 
								<div class="col-md-4">							
									<select  name="jenis" id="jenis" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($jenis as $key => $value) {
												if($value->id == $edit->y_id){
												$a = "selected";
									}else{
										$a = "";
									}
												print '<option '.$a.' value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
											}
										?>									
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Ukuran:</label> 
								<div class="col-md-4">							
									<select  name="ukuran" id="ukuran" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($ukuran as $key => $value) {
												if($value->id == $edit->z_id){
												$a = "selected";
									}else{
										$a = "";
									}
												print '<option '.$a.' value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
											}
										?>									
									</select>
								</div>
							</div>	
							<div class="form-group">
								<label class="col-md-2 control-label">Bahan:</label> 
								<div class="col-md-4">							
									<select  name="bahan" id="bahan" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($bahan as $key => $value) {
												if($value->id == $edit->spc_4){
												$a = "selected";
									}else{
										$a = "";
									}
												print '<option '.$a.' value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
											}
										?>									
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Gander:</label> 
								<div class="col-md-4">							
									<select  name="gander" id="gander" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($gander as $key => $value) {
												if($value->id == $edit->spc_5){
												$a = "selected";
									}else{
										$a = "";
									}
												print '<option '.$a.' value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
											}
										?>									
									</select>
								</div>
							</div>	
                        </div>
                        <div class="tab-pane" id="box_tab5">
                        	<div class="form-group">
								<label class="col-md-2 control-label">GPS X:</label> 
								<div class="col-md-4">
									<input value="<?php echo $edit->gps_x; ?>" type="text" name="gpsx" id="gpsx" class="form-control" placeholder="GPS X" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">GPS Y:</label> 
								<div class="col-md-4">
									<input type="text" value="<?php echo $edit->gps_y; ?>" name="gpsy" id="gpsy" class="form-control" placeholder="GPS Y" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Description:</label> 
								<div class="col-md-4">
									<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"><?php echo $edit->descr; ?></textarea>
								</div>
							</div>
                        </div>
                        <!-- <div class="tab-pane" id="box_tab6">
                        	<div class="form-group">
								<label class="col-md-2 control-label">Issuer:</label> 
								<div class="col-md-4">							
									<select  name="issuer" id="issuer" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($issuer as $key => $value) {
												if($value->id == $edit->issuer_id){
													$a = "selected";
									}else{
										$a = "";
									}
												print '<option '.$a.' value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
											}
										?>									
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Office Address:</label> 
								<div class="col-md-4">
									<?php echo $issuer_data->address1; ?>		
								</div>
							</div>	
							<div class="form-group">
								<label class="col-md-2 control-label">Phone:</label> 
								<div class="col-md-4">
									<?php echo $issuer_data->phone1; ?>		
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Fax:</label> 
								<div class="col-md-4">
									<?php echo $issuer_data->fax1; ?>		
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Email:</label> 
								<div class="col-md-4">
									<?php echo $issuer_data->email1; ?>		
								</div>
							</div>
                        </div>
                        <div class="tab-pane" id="box_tab7">
    
                        	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
							<thead>
								<tr>						
									
									<th>From</th>															
									<th>To</th>						
									<th>Code</th>												
									<th>Price 1</th>												
									<th>Price 2</th>												
									<th>Price 3</th>												
									<th>Price 4</th>																					
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($price_history as $key => $value) {
										echo "<tr>";
										echo "<td>".$value->start_date."</td>";
										echo "<td>".$value->end_date."</td>";
										echo "<td>".$value->code."</td>";
										echo "<td>".$value->price1."</td>";
										echo "<td>".$value->price2."</td>";
										echo "<td>".$value->price3."</td>";
										echo "<td>".$value->price4."</td>";
										echo "</tr>";
									}
								?>
							</tbody>
							</table>
                        </div>
                        <div class="tab-pane" id="box_tab8">
                        	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data2">
							<thead>
								<tr>						
									
									<th>From</th>															
									<th>To</th>						
									<th>Transaction</th>												
									<th>Owner</th>												
									<th>Address</th>												
									
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($price_history as $key => $value) {
										echo "<tr>";
										echo "<td>".$value->start_date."</td>";
										echo "<td>".$value->end_date."</td>";
										echo "<td>".$value->code."</td>";
										echo "<td>".$value->nick_name."</td>";
										echo "<td>".$value->address1."</td>";
										
										echo "</tr>";
									}
								?>
							</tbody>
							</table>
                        </div>
                        <div class="tab-pane" id="box_tab9">
                        	<div class="form-group">
								<label class="col-md-2 control-label">Filename:</label> 
								<div class="col-md-4">							
									<input  value="<?php echo $edit->filename; ?>" name="userfile" id="userfile" type="file" class="pull-right">
								</div>
							</div>	
                        </div>
                	</div> -->
                </div>
					<input type="submit" class="btn btn-info btn-lg pull-right" onclick="save(this);" value="Save"/>					
					</form>
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
	$('#data2').dataTable({
		'sPaginationType': 'bs_full',
		"bProcessing": true,		
		"aaSorting": [[0, "asc"]],
		"iDisplayLength": 10,			
		
	});
	$('#data2').each(function(){
		var datatable = $(this);
		var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
		search_input.attr('placeholder', 'Search');
		search_input.addClass('form-control input-sm');
		var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
		length_sel.addClass('form-control input-sm');
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
				var formData = new FormData(form);
			$.ajax({
				url: '<?php echo site_url();?>apps/itemlist/execute/update/<?php echo $edit->id;?>',
				type: "POST",
				dataType:"json",
				cache: false,
                contentType: false,
                processData: false,
                data: formData,//$("#form").serialize(),
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
						window.location = "../../index/<?php echo $p1;?>";
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