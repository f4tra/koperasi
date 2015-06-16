	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-reorder"></i><?php echo $this->uri->segment(2); ?></h4> 					
				</div>
				<div class="box-body">
				<div class="tabbable box-tabs">
                	<ul class="nav nav-tabs">
                    	<li>
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
                        </li>
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
								<input type="text" name="code" id="code" class="form-control" placeholder="Code" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Name:</label> 
							<div class="col-md-4">
								<input type="text" name="name" id="name" class="form-control" placeholder="Name" />
							</div>
						</div>

						
						<div class="form-group">
							<label class="col-md-2 control-label">Category:</label> 
							<div class="col-md-4">							
								<select  name="ctg" id="ctg" class="select2-01 col-md-12 full-width-fix">
									<option value="0">Unidentify</option>
									<?php 
										foreach($ctg as $key => $value) {
											print '<option value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
										}
									?>									
								</select>
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
									<input type="text" name="dim1" id="dim1" class="form-control" placeholder="Dimensi 1" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Dimensi 2:</label> 
								<div class="col-md-4">
									<input type="text" name="dim2" id="dim2" class="form-control" placeholder="Dimensi 2" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Grade :</label> 
								<div class="col-md-4">							
									<select  name="grade" id="grade" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($grade as $key => $value) {
												print '<option value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
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
												print '<option value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
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
												print '<option value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
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
												print '<option value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
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
												print '<option value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
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
									<input type="text" name="gpsx" id="gpsx" class="form-control" placeholder="GPS X" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">GPS Y:</label> 
								<div class="col-md-4">
									<input type="text" name="gpsy" id="gpsy" class="form-control" placeholder="GPS Y" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Description:</label> 
								<div class="col-md-4">
									<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"></textarea>
								</div>
							</div>
                        </div>
                        <div class="tab-pane" id="box_tab6">
                        	<div class="form-group">
								<label class="col-md-2 control-label">Issuer:</label> 
								<div class="col-md-4">							
									<select  name="issuer" id="issuer" class="select2-01 col-md-12 full-width-fix">
										<option value="0">Unidentify</option>
										<?php 
											foreach($issuer as $key => $value) {
												print '<option value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
											}
										?>									
									</select>
								</div>
							</div>	
                        </div>
                        <div class="tab-pane" id="box_tab7">
                        	
                        	
                        
                        </div>
                        <div class="tab-pane" id="box_tab8">

                        </div>
                        <div class="tab-pane" id="box_tab9">
                        	<div class="form-group">
								<label class="col-md-2 control-label">Filename:</label> 
								<div class="col-md-4">							
									<input  name="userfile" id="userfile" type="file" class="pull-right">
								</div>
							</div>	
                        </div>
                	</div>
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
				url: '<?php echo base_url();?>index.php/inventory/itemlist/execute/save',
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
						window.location = "./";
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