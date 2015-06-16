	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-reorder"></i><?php echo $this->uri->segment(2); ?></h4> 					
				</div>
				<div class="box-body">
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form">
						<!-- <div class="form-group">
							<label class="col-md-2 control-label">Code:</label> 
							<div class="col-md-4">
								<input type="text"  name="code" id="code" class="form-control" placeholder="Code" />
							</div>
						</div> -->
						<!--
						<div class="form-group">
							<label class="col-md-2 control-label">Unit No:</label> 
							<div class="col-md-4">
								<input type="text"  name="name" id="name" class="form-control" placeholder="Name" />
							</div>
						</div>-->
						<div class="form-group">
							<label class="col-md-2 control-label">Item:</label> 
							<div class="col-md-4">
								<select name="item" id="item" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php 
								foreach($item as $i){
									
								?>
									<option   value="<?php echo $i->id;?>"><?php echo $i->code." ".$i->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Price 1:</label> 
							<div class="col-md-4">
								<input type="text"  name="price1" id="price1" class="form-control" placeholder="Price 1" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Price 2:</label> 
							<div class="col-md-4">
								<input type="text"  name="price2" id="price2" class="form-control" placeholder="Price 2" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Price 3:</label> 
							<div class="col-md-4">
								<input type="text"  name="price3" id="price3" class="form-control" placeholder="Price 3" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Price 4:</label> 
							<div class="col-md-4">
								<input type="text"  name="price4" id="price4" class="form-control" placeholder="Price 4" />
							</div>
						</div>
						<div class="form-group">
                            <label class="col-md-2 control-label">Start Date</label>
                            <div class="col-md-3">
                            	<div class="input-group">
                                	<input type="text" name="start_date" id="start_date" class="form-control" data-mask="99/99/9999">
                                	<span class="input-group-btn">
                                		<button class="btn btn-primary" id="start_date2" type="button">
                                			<i class="fa fa-calendar" ></i> Date
                                		</button>
                                	</span>
								</div>                                                                                                                   
                            </div>
                                                                          
                            </div>                                                                                                
                            <div class="form-group">
                                <label class="col-md-2 control-label">End Date</label>
                                <div class="col-md-3">
                                	<div class="input-group">
                                    	<input type="text" name="end_date" id="end_date"  class="form-control" data-mask="99/99/9999"><span class="input-group-btn"> <button class="btn btn-primary" id="end_date2" type="button"><i class="fa fa-calendar" ></i> Date</button> </span>
                                    </div>                                                                                                                   
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-md-2 control-label">Description:</label> 
							<div class="col-md-4">
								<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"> </textarea>
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
$(function() {
    
    $( "#start_date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });   
    $("#start_date2").click(function () {
       $("#start_date" ).datepicker("show");
    });
    $( "#end_date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });   
    
    $("#end_date2").click(function () {
       $("#end_date" ).datepicker("show");
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
				url: '<?php echo base_url();?>index.php/unitstock/pricehistory/execute/save',
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
						window.location = "../";
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