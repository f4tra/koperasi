	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-reorder"></i>Issuer</h4> 					
				</div>
				<div class="box-body">
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form">
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
							<label class="col-md-2 control-label">Parent:</label> 
							<div class="col-md-4">							
								<select  name="parent" id="parent" class="select2-01 col-md-12 full-width-fix">
									<option value="0">Unidentify</option>
									<?php 
										foreach($issuer as $key => $value) {
											print '<option value="'.$value->id.'">'.$value->code." - ".$value->name.'</option>';
										}
									?>									
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">PIC:</label> 
							<div class="col-md-4">							
								<select  name="user" id="user" class="select2-01 col-md-12 full-width-fix">
									<option value="0">Unidentify</option>
									<?php 
										foreach($user as $key => $value) {
											print '<option value="'.$value->id.'">'.$value->first_name." ".$value->mid_name." ".$value->last_name.'</option>';
										}
									?>									
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Phone 1:</label> 
							<div class="col-md-4">
								<input type="text" name="phone1" id="phone1" class="form-control" placeholder="Phone 1" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Phone 2:</label> 
							<div class="col-md-4">
								<input type="text" name="phone2" id="phone2" class="form-control" placeholder="Phone 2" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Fax 1:</label> 
							<div class="col-md-4">
								<input type="text" name="fax1" id="fax1" class="form-control" placeholder="Fax 1" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Fax 2:</label> 
							<div class="col-md-4">
								<input type="text" name="fax2" id="fax2" class="form-control" placeholder="Fax 2" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Zip 1:</label> 
							<div class="col-md-4">
								<input type="text" name="zip1" id="zip1" class="form-control" placeholder="Zip 1" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Zip 2:</label> 
							<div class="col-md-4">
								<input type="text" name="zip2" id="zip2" class="form-control" placeholder="Zip 2" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Email 1:</label> 
							<div class="col-md-4">
								<input type="email" name="email1" id="email1" class="form-control" placeholder="Email 1" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Email 2:</label> 
							<div class="col-md-4">
								<input type="email" name="email2" id="email2" class="form-control" placeholder="Email 2" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Address 1:</label> 
							<div class="col-md-4">
								<textarea name="addr1" id="addr1" cols="30" rows="10" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Address 2:</label> 
							<div class="col-md-4">
								<textarea name="addr2" id="addr2" cols="30" rows="10" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Description:</label> 
							<div class="col-md-4">
								<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"></textarea>
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
			$.ajax({
				url: '<?php echo base_url();?>index.php/organization/issuer/execute/save',
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