<!-- ini side bar -->
<div class="sidebar-menu nav-collape">
		<ul>
			<li class='active'>
				<a href='<?php echo base_url(); ?>' class=''>
					<i class='fa fa-tachometer fa-fw'></i>
					<span class='menu-text'>Dashboard</span>
					<span class='selected'></span>
				</a>
			</li>
		<?php 
		$uri_segment = $this->uri->segment(2);
		$uri_segment_detail = $this->uri->segment(3);
		$parsing = $this->uri->segment(4);
		if($uri_segment == "group")
	 		$val = 1;
	 	elseif($uri_segment == "proses")	
	 		$val = 3;
	 	elseif($uri_segment == "event")	
	 		$val = 4;
	 	if($uri_segment_detail == "details")	
	 		$val = 5;

			if($uri_segment == "group" or $uri_segment == "proses" or $uri_segment == "event"){
			$awal=$this->db->query("select id,code,name,active,descr,parent_id from tr_wf_type where parent_id='0'")->result();
			//print_r($awal);
			foreach($awal as $key=>$value){
		?>
			<li class="has-sub">
				<a href="javascript:;" class="">
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text"><?php echo $value->name;?></span>
					<span class="arrow epen"></span>
				</a>
				<ul style="margin-left:2px;">
					
				<?php 
					$parent=$this->db->query("select id,icons,code,name,active,descr,parent_id from tr_wf_type where parent_id='".$value->id."'")->result();
					$no =1;
					foreach($parent as $key=>$valuetwo){
					if($valuetwo->id ==28){
						$or_type_id = 1;
					}
					elseif($valuetwo->id ==29){
						$or_type_id = 3;						
					}
					elseif($valuetwo->id ==30){
						$or_type_id = 4;						
					}
					elseif($valuetwo->id ==31){
						$or_type_id = 5; 
					}
				?>
					<span 
					data-group ="<?php echo $parsing;?>"
					data-ortype ="<?php echo $or_type_id;?>"
					data-icon="<?php echo $valuetwo->icons;?>" id="drag" class="draggable js-drag label label-warning sub-sub-menu-text"><img src="<?php echo base_url('assets/wf/'.$valuetwo->icons);?>"  width="20%" alt="<?php echo $valuetwo->name;?>"></span>
					

					<?php  $no++; } ?>
				</ul>
			</li>			
			<?php }
			} ?>
		</ul>
	</div>
<!-- modal Box-->
<div class="modal fade" id="pg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Form Add</h4>
			</div>
			<div class="modal-body">				
				<form class="form-horizontal row-border"  method="post" id="form">					
					<div class="form-group">
						<label class="col-md-2 control-label">Code:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="code" id="code" class="form-control" placeholder="Code" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Name:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="name" id="name" class="form-control" placeholder="Name" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Caption:</label> 
						<div class="col-md-6">
							<input type="text"  value=""name="caption" id="caption" class="form-control" placeholder="Caption" />
						</div>
					</div>
					<?php if($uri_segment =='proses'){ 
						$result = $this->mgeneral->getwhere(array('or_type_id'=>1),"tr_wf");
					?>
					<div class="form-group">
						<label class="col-md-2 control-label">Group:</label> 
						<div class="col-md-6">
							<select id="group_id" name="group_id" class="form-control">
								<option value="0">Unidentify</option>
								<?php 
									foreach ($result as $key => $value) {
										if($value->id == $parsing){
											
											$selected ="selected";
											$val_sel =$parsing;
										}
										else{
											
											$selected ="";
											$val_sel =$value->id;
										}
										echo "<option ".$selected." value='".$val_sel."'>".$value->name."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<?php }?>
					<?php if($uri_segment =='event' and $uri_segment_detail !='details'){ 
						$result = $this->mgeneral->getwhere(array('or_type_id'=>3),"tr_wf");
					?>
					<div class="form-group">
						<label class="col-md-2 control-label">Proses:</label> 
						<div class="col-md-6">
							<select id="parent_id" name="parent_id" class="form-control">
								<option value="0">Unidentify</option>
								<?php 
									foreach ($result as $key => $value) {
										if($value->id == $parsing){
											
											$selected ="selected";
											$val_sel =$parsing;
										}
										else{
											
											$selected ="";
											$val_sel =$value->id;
										}
										echo "<option ".$selected." value='".$val_sel."'>".$value->name."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<?php }?>
					<?php if($uri_segment_detail =='details'){ 
						$result = $this->mgeneral->getwhere(array('or_type_id'=>4),"tr_wf");
					?>
					<div class="form-group">
						<label class="col-md-2 control-label">Parent:</label> 
						<div class="col-md-6">
							<select id="parent_id" name="parent_id" class="form-control">
								<option value="0">Unidentify</option>
								<?php 
									foreach ($result as $key => $value) {
										if($value->id == $parsing){
											
											$selected ="selected";
											$val_sel =$parsing;
										}
										else{
											
											$selected ="";
											$val_sel =$value->id;
										}
										echo "<option ".$selected." value='".$val_sel."'>".$value->name."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<?php }?>
					<div class="form-group">
						<label class="col-md-2 control-label">Description:</label> 
						<div class="col-md-4">
							<textarea name="descr" id="descr" cols="30" rows="10" class="form-control"></textarea>
							</div>
						</div>					
			</div>
			<div class="modal-footer">
				<input type="hidden" name="icon" id="icon" value="">

				<input type="hidden" name="or_type_id" id="or_type_id" value="<?php echo $val;?>">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" onclick="save_(this);" class="btn btn-primary">Save changes</button>
			</div>
				</form>
		</div>
	</div>
</div>


<script type="text/javascript">

/*$('.modal').on('hidden.bs.modal', function(){
    $(this).find('form')[0].reset();
});
$(document).on("click", "#proses_group", function () {
     var icon = $(this).data('icon');
     $(".modal-footer #icon").val(icon);
});*/
// Fungsi Untuk Tambah Data
function save_(){
	$.ajax({
		url: '<?php echo site_url();?>workflow/ajax/execute/save',
		type: "POST",
		//dataType:"json",
		data: $("#form").serialize(),
		success:function(data){
			$.pnotify({
				title: "Data Tersimpan",
				text: "Data Tersimpan",
				animation: {
					effect_in: 'show',
					effect_out: 'slide'
				},
				type : "success",
			});
			setInterval(function() {
				window.location.reload()
			}, 1000);		

		},
		error: function(){
			$("#msg").slideDown();
		}
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

