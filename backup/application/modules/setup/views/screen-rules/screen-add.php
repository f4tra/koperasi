
	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>GUI</h4> 
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
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form">
						<div class="form-group">
							<label class="col-md-2 control-label">Code:</label> 
							<div class="col-md-4">
								<input class="form-control" type="text" name="code" id="code"  placeholder="Code">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Name:</label> 
							<div class="col-md-4">
								<input class="form-control" type="text" name="name" id="name" placeholder="Name">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">caption:</label> 
							<div class="col-md-4">
								<input class="form-control" type="text" name="caption" id="caption" placeholder="caption">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Icon:</label> 
							<div class="col-md-4">
								<input class="form-control" type="text" name="icon" id="icon" placeholder="Icon">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Link:</label> 
							<div class="col-md-4">
								<input class="form-control" type="text" name="link" id="link" placeholder="Link">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Description:</label> 
							<div class="col-md-4">
								<textarea name="descr" id="descr" cols="30" rows="10" class="form-control textarea"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Parent:</label> 
							<div class="col-md-4">
								<select name="parent" id="parent" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php foreach($parent as $r){ ?>
								<optgroup label="<?php if($r->parent_id == 0){ echo $r->name;}?>">
									<option selected value="<?=$r->id;?>">
									<?php 
										if($r->parent_id == 0){
											echo $r->name;
										}else{											
											echo $r->code."&nbsp;&nbsp;&nbsp;-- ".$r->name;											
										}?>
								<optgroup>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Active:</label> 
							<div class="col-md-4">
								<select name="active" id="active" class="form-control">
									<option selected value="1">Active</option>
									<option  value="0">Inactive</option>
								
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
	        minlength: 1,
	        required: true
	      },
	      name: {
	        required: true,
	        minlength: 2
	      },
		  captionn: {
	        required: true,
	        minlength: 2
	      },
		  link: {
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
				url: '<?php echo base_url();?>index.php/setup/screen/execute/save',
				type: "POST",
				dataType:"json",
				data: $("#form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
					$.pnotify({
								title: 'Screen Created',
								text: 'Screen Created',
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