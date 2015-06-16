
	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border orange">
				<div class="box-title">
					<h4><i class="fa fa-preorder"></i><?php echo $this->uri->segment(2); ?> </h4> 
				
				</div>
				<div class="box-body">
					
					<!-- Form-->
					<form class="form-horizontal row-border"  method="post" id="form" enctype="multipart/form-data">
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
							<label class="col-md-2 control-label">Description:</label> 
							<div class="col-md-4">
								<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"><?php echo $edit->descr;?> </textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Group:</label> 
							<div class="col-md-4">
								<select name="group_id" id="group_id" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php 
								foreach($node_group as $ggg){
									if($ggg->id == $edit->group_id){
										$aaa = "selected";
									}else{
										$aaa = "";
									}
								?>
									<option  <?php echo $aaa; ?> value="<?php echo $ggg->id;?>"><?php echo $ggg->code." ".$ggg->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-md-2 control-label">Type:</label> 
							<div class="col-md-4">
								<select name="type_id" id="type_id" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php 
								foreach($node_type as $gg){
									if($gg->id == $edit->type_id){
										$aa = "selected";
									}else{
										$aa = "";
									}
								?>
									<option  <?php echo $aa; ?> value="<?php echo $gg->id;?>"><?php echo $gg->code." ".$gg->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-md-2 control-label">Parent:</label> 
							<div class="col-md-4">
								<select name="parent_id" id="parent_id" class="select2-01 col-md-12 full-width-fix">
								<option value="0">Unidentify</option>
								<?php 
								foreach($node_category as $g){
									if($g->id == $edit->parent_id){
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
				url: '<?php echo base_url();?>index.php/inventory/itemcategory/execute/update/<?php echo $edit->id;?>',
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