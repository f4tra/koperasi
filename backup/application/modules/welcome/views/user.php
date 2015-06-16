<div class="row">
	<div id="content" class="col-lg-12">
		<!-- PAGE HEADER-->
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
				<!-- STYLER -->
				<!-- /STYLER -->
				<!-- BREADCRUMBS -->
				<ul class="breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
					</li>
					<li>
					<a href="#">Other Pages</a>
					</li>
						<li>Blank Page</li>
				</ul>
				<!-- /BREADCRUMBS -->
				<div class="clearfix">
					<h3 class="content-title pull-left">Blank Page</h3>
				</div>
				<div class="description">Blank Page</div>
				</div>
			</div>
		</div>
	<!-- /PAGE HEADER -->
	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border yellow">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Form Wizard </h4> 
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
						
						<form action="" method="post" id="contact-form" class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-md-2 control-label">Username</label>
						<div class="col-md-6">
							<input type="text" value="<?php echo $user->username;?>" class="form-control" placeholder="Enter Username" name="username" id="username">
							<span>*)jika username tidak ingin dirubah biarkan </span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">First Name *)</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter First Name" name="first_name" id="first_name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Middle Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter Middle Name" name="middle_name" id="middle_name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Last Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" id="last_name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Nick name*)</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter Nick Name" name="nick_name" id="nick_name" <?php echo $user->nick_name;?>>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Nama Ibu *)</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter Nama Ibu" name="nama_ibu" id="nama_ibu">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Jenis Kelamin</label>
						<div class="col-md-6">
							<select name="jk" id="jk" class="form-control">
								<option value="0">Jenis Kelamin</option>
								<option value="1">Laki - Laki</option>
								<option value="2">Perempuan</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Phone *)</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="phone" id="phone" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Jenis Costumer</label>
						<div class="col-md-6">
							<select name="jc" id="jc" class="form-control">
								<option value="1">Personal</option>
								<option value="2">Corporate</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Tempat Lahir</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter Tempat lahir" name="lahir" id="lahir">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Tanggal Lahir</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter Tanggal Lahir" name="tgl_lahir" id="tgl_lahir">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Suku Bangsa</label>
						<div class="col-md-6">
							<select name="sb" id="sb" class="form-control">
							<?php foreach($suku as $s){ ?>
							<option value="<?php echo $s->ID;?>"><?php echo $s->NAMA;?></option>
							<?php } ?>
							</select>
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
						<label class="col-md-2 control-label">Propinsi</label>
						<div class="col-md-6">
							<select name="propinsi" id="propinsi" class="form-control">
										<option value="0">Unidentify</option>
										<?php foreach($tr_province as $p):?>
										<option value="<?=$p->ID;?>"><?=$p->NAMA;?></option>
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
								<input type="text" class="form-control" name="ym" id="ym"/>
								</div>
					</div>
					
					<div class="form-group">
								<label class="col-md-2 control-label">Zip Code </label>
								<div class="col-md-6">
									<input type="text" name="zipcode" id="zipcode" class="form-control"/>
																		
								</div>
					</div>
					<div class="form-group">
							<label class="col-md-2 control-label">Address</label>
								<div class="col-md-8">
									<textarea  name="address" id="address" rows="5"></textarea>
								</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Description</label>
						<div class="col-md-6">
							<textarea  name="desc" id="desc" rows="5"></textarea>
						</div>
					</div>
						
							<?php
							
								foreach($tr_syarat as $r){
									echo "<div class='form-group'>";
									echo "<label class='col-md-2 control-label'>Syarat ".$r->LABEL."</label>
										<div class='col-md-6'>";
									echo "<input type='file' class='form-control' name='file".$r->CODE."' />";
									echo "</div></div>";

								}
							?>
						
							<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id; ?>"/>
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
$('#startdate').datepicker({
    format: "yyyy-mm-dd",
    startView: 1,
    autoclose: true
});
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
			url: '<?php echo base_url();?>index.php/wizard/wizard/get_kab',
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
	$('#contact-form').validate({
	    rules: {
	      first_name: {
	        minlength: 2,
	        required: true
	      },
		  nick_name:{
	        minlength: 2,
	        required: true
	      },
	      phone: {
	        required: true,
	        minlength: 11
	      },
		  nama_ibu: {
	        required: true,
	        minlength: 2
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
				url: '<?php echo base_url();?>index.php/wizard/wizard/execute/update/<?php echo $user->id;?>',
				type: "POST",
				dataType:"json",
				data: $("#contact-form").serialize(),
				beforeSend: function(){
					$("#loading").show(); 
				},
				success:function(data){
					console.log(data);
					$("#msg").html("<i class='icon-exclamation-sign icon-white' ></i>Success.");
					$("#msg").removeClass('label-important label-success label-warning').addClass('label-info');
					$("#msg").slideDown();
					$("#msg").delay(2500).slideUp();
					$("#loading").hide();
					$("#contact-form").closest('.control-group').removeClass('.control-group');
					//form.reset();
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