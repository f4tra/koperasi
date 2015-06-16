<div class="row">
					<div id="content" class="col-lg-12">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12">
								<div class="page-header">
									<!-- STYLER -->
									
									<!-- /STYLER -->
									
									<div class="clearfix">
										<h3 class="content-title pull-left">User Profile</h3>
									</div>
									<div class="description">User Profile</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
					<form class="form-horizontal" id="form" method="post" />
									<div class="row">
										 <div class="col-md-12">
											<div class="box border">
												<div class="box-title">
													<h4><i class="fa fa-reorder"></i>General Information</h4>
												</div>
												<div class="box-body big">
												<div class="form-group">
													<label class="col-md-2 control-label">Nick name*)</label>
													<div class="col-md-6">
														<input value="<?php echo $user->nick_name;?>" type="text" class="form-control" placeholder="Enter Nick Name" name="nick_name" id="nick_name" <?php echo $user->nick_name;?>>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Name</label>
													<div class="col-md-3">
													First name
														<input  value="<?php echo $user->first_name;?>"type="text" class="form-control" placeholder="Enter First Name" name="first_name" id="first_name">
													</div>
													<div class="col-md-3">
													Middle name	<input  value="<?php echo $user->mid_name;?>"type="text" class="form-control" placeholder="Enter Middle Name" name="middle_name" id="middle_name">
													</div>
													<div class="col-md-3">
													Last name	<input  value="<?php echo $user->last_name;?>"type="text" class="form-control" placeholder="Enter Last Name" name="last_name" id="last_name">
														</div>
												</div>
												
												<div class="form-group">
													<label class="col-md-2 control-label">Nama Ibu *)</label>
													<div class="col-md-6">
														<input  value="<?php echo $user->mother_name;?>" type="text" class="form-control" placeholder="Enter Nama Ibu" name="nama_ibu" id="nama_ibu">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Phone *)</label>
													<div class="col-md-6">
														<input  value="<?php echo $user->phone1;?>"type="text" class="form-control" name="phone" id="phone" />
													</div>
												</div>
												
												
												<div class="form-group">
													<label class="col-md-2 control-label">Jenis Kelamin</label>
													<div class="col-md-6">
														<select name="jk" id="jk" class="form-control">
														<?php if($user->sex_type_id == 1){ echo "selected";} ?>
															<option value="0">Jenis Kelamin</option>
															<option <?php if($user->sex_type_id == 1){ echo "selected";} ?> value="1">Laki - Laki</option>
															<option <?php if($user->sex_type_id == 2){ echo "selected";} ?> value="2">Perempuan</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Jenis Costumer</label>
													<div class="col-md-6">
														<select name="js" id="js" class="form-control">
														<option selected value="0">Pilih</option>
															<option <?php if($user->cust_type_id == 1){ echo "selected";} ?> value="1">Personal</option>
															<option <?php if($user->cust_type_id == 2){ echo "selected";} ?> value="2">Corporate</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Tempat Lahir</label>
													<div class="col-md-6">
														<input type="text"  value="<?php echo $user->birthplace;?>" class="form-control" placeholder="Enter Tempat lahir" name="lahir" id="lahir">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Tanggal Lahir</label>
													<div class="col-md-6">
														<input  value="<?php echo $user->birthdate;?>" type="text" class="form-control" placeholder="Enter Tanggal Lahir" name="tgl_lahir" id="tgl_lahir">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Agama </label>
													<div class="col-md-6">
														<select class="form-control" name="agama" id="agama">
															<?php foreach($agama as $s){ ?>
																<option value="<?php echo $s->ID;?>"><?php echo $s->NAMA;?></option>
															<?php } ?>
														</select>									
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Provinsi </label>
													<div class="col-md-6">
														<select name="propinsi" id="propinsi" class="form-control">
															<option value="0">Pilih Provinsi</option>
															<?php 
															//print_r($user->province_id1);
															foreach($tr_province as $p):
															if($p->ID == $user->province_id1){
																$a = "selected";
															}else{
																$a = "";
															}
															?>
															
															<option <?php echo $a; ?> value="<?=$p->ID;?>"><?=$p->NAMA;?></option>
															<?php endforeach;?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Kota </label>
													<div class="col-md-6">
														<select class="form-control" name="kota" id="kota">
															<option value="" selected>Pilih Kab/Kota</option>
														</select>									
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Yahoo Messenger </label>
													<div class="col-md-6">
														<input type="text"  value="<?php echo $user->ym;?>" class="form-control" name="ym" id="ym"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Zip Code </label>
													<div class="col-md-6">
														<input type="text"  value="<?php echo $user->zip1;?>" name="zipcode" id="zipcode" class="form-control"/>																
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Address</label>
													<div class="col-md-6">
														<textarea  name="address" id="address" rows="5" class="form-control"> <?php echo $user->address1;?></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Description</label>
													<div class="col-md-6">
														<textarea  name="descr" id="descr" rows="5" class="form-control"><?php echo $user->descr;?></textarea>
													</div>
												</div>
												<div class="form-actions clearfix">
												<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->ID_; ?>"/>
												<input onclick="save(this);" type="submit" value="Update Account" class="btn btn-primary pull-right" />
												</div>
												</div>
												
											</div>
											
										</div>
									 </div>
									 
								  </form>
						<div class="footer-tools">
							<span class="go-top">
								<i class="fa fa-chevron-up"></i> Top
							</span>
						</div>
					</div><!-- /CONTENT-->
				</div>

<script type="text/javascript">

$('#tgl_lahir').datepicker({
    format: "yyyy-mm-dd",
    startView: 1,
    autoclose: true
});
$(function() {
	$("#propinsi").change(function() {
		var provinsi =$(this).val();
		var dataString = 'propinsi='+provinsi;
		$.ajax({
			type: "POST",
			url: '<?php echo base_url();?>index.php/auth/profile/get_kab',
			data: dataString,
			cache: false,
			success: function(html) {
				$("#kota").html(html);
			} 
		});
	});
});

// Fungsi Untuk Tambah Data
function save(){
	$('#form').validate({
	    rules: {
		nick_name: {
	        required: true,
	        minlength: 3
	      },
		  nama_ibu: {
	        required: true,
	        minlength: 2
	      },
		  first_name: {
	        required: true,
	        minlength: 3
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
				url: '<?php echo base_url();?>index.php/auth/profile/action',
				type: "POST",
				dataType:"json",
				data: $("#form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
					location.reload();
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