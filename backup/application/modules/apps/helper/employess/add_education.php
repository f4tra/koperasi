<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Education </h4> 					
				</div>
				<div class="box-body">
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form">
						<div class="form-group">
							<label class="col-md-2 control-label">Eduction Type:</label> 
							<div class="col-md-4">							
								<select  name="education_type" id="education_type" class="select2-01 col-md-12 full-width-fix">
									<option value="0">Unidentify</option>
									<?php 
										foreach($TR_HR_EDUCATION_TYPE as $key => $value) {
											print '<option value="'.$value->id.'">'.$value->code.' - '.$value->name.'</option>';
										}
									?>									
								</select>
							</div>
						</div>
						
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
							<label class="col-md-2 control-label">Company Name:</label> 
							<div class="col-md-4">							
								<input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Start Date:</label> 
							<div class="col-md-4">
                                <div class="input-group">
									<input type="text" name="startdate" id="datepicker1" class="form-control" data-mask="99/99/9999">
                                	<span class="input-group-btn">
									<button class="btn btn-primary" id="btndp1" type="button"><i class="fa fa-calendar" ></i> Date</button>
                            	    </span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">End Date:</label> 
							<div class="col-md-4">
								<div class="input-group">
									<input type="text" name="enddate" id="datepicker2" class="form-control" data-mask="99/99/9999">
                                	<span class="input-group-btn">
									<button class="btn btn-primary" id="btndp2" type="button"><i class="fa fa-calendar" ></i> Date</button>
                                	</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Description:</label> 
							<div class="col-md-4">
								<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"></textarea>
							</div>
						</div>						
						
						<div class="form-group">
							<label class="col-md-2 control-label">ACHIEVEMENT:</label> 
							<div class="col-md-4">
								<input type="text" name="achievement" id="achievement" class="form-control" placeholder="ACHIEVEMENT" />
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
						<input type="hidden" name="user_id" value="<?php echo $user_id?>"/>
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
 $( "#datepicker1" ).datepicker({
      dateFormat: "yy-mm-dd"
    });   
    $("#btndp1").click(function () {
       $("#datepicker1" ).datepicker("show");
    });
    $( "#datepicker2" ).datepicker({
      dateFormat: "yy-mm-dd"
    });   
    $("#btndp2").click(function () {
       $("#datepicker2" ).datepicker("show");
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
				url: '<?php echo base_url();?>index.php/apps/employess/execute_hr_edu/save',
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
						window.location = "../form/<?php echo $user_id?>";
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