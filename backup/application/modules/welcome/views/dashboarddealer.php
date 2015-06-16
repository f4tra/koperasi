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
						<a href="<?php echo base_url();?>">Home</a>
					</li>
					
				</ul>
				<!-- /BREADCRUMBS -->
				<div class="clearfix">
					<h3 class="content-title pull-left">Dashboard</h3>
				</div>
				<div class="description">Overview, Statistics and more</div>
				</div>
			</div>
		</div>
	<!-- /PAGE HEADER -->
	
	<!-- NEW ORDERS & STATISTICS -->
	<div class="row">
	<!-- NEW ORDERS -->
	<div class="col-md-6">
	<!--
		<div class="tabbable tabbable-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#sales" data-toggle="tab"><i class="fa fa-bookmark"></i> Deposit Dealer</a></li>
				<li><a href="#feed" data-toggle="tab"><i class="fa fa-rss"></i> Recent Activities</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="sales">
					<div class="panel panel-default">
						<div class="panel-body orders no-opaque">
							<div class="scroller" data-height="450px" data-always-visible="1" data-rail-visible="1">
								<ul class="list-unstyled" id="">
									<div id="stage"></div>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="feed">
					<div class="scroller" data-height="450px" data-always-visible="1" data-rail-visible="1">
						<div class="feed-activity clearfix">
							<div>
								<i class="pull-left roundicon fa fa-check btn btn-info"></i>
								<a class="user" href="#"> John Doe </a>
								accepted your connection request.
								<br />
								<a href="#">View profile</a>
								</div>
								<div class="time">
								<i class="fa fa-clock-o"></i>
								5 hours ago
							</div>
						</div>
						<div class="feed-activity clearfix">
							<div>
								<i class="pull-left roundicon fa fa-picture btn btn-danger"></i>
									<a class="user" href="#"> Jack Doe </a>
									uploaded a new photo.
									<br />
									<a href="#">Take a look</a>
							</div>
							<div class="time">
								<i class="fa fa-clock-o"></i>
								5 hours ago
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		-->
		<div class="panel panel-default">
			<div class="panel-body">
				<p>
					<h3>Welcome</h3><br />
					Selamat datang <span class="label label-info"><?php echo $ac->username;?></span> Silahkan pilih menu yang anda inginkan
				</p>
			</div>
		</div>
	</div>
	<!-- /NEW ORDERS -->
	<!-- STATISTICS -->
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-6">
				<div class="box border inverse">
					<div class="box-title">
						<h4><i class="fa fa-money"></i>Summary</h4>
					</div>
					<div class="box-body">
						<div class="sparkline-row">
							<span class="title">Account balance</span>
							<span class="value">Rp. <?php echo number_format($u->deposit_value,2,',','.');?></span>
							<span class="sparkline big" data-color="blue"><!--16,7,23,13,12,11,15,4,19,18,4,24--></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box border purple">
					<div class="box-title">
						<h4><i class="fa fa-adjust"></i>Account Info</h4>
					</div>
					<div class="box-body">									
						<div class="sparkline-row">
							<span class="title">Name</span>
							<span class="value"><i class="fa fa-user"></i><b> <?php echo $u->name; ?></b></span>
							<span class="sparklinepie big"><!--16,7,23--></span>
						</div>
						<div class="sparkline-row">
							<span class="title">Username</span>
							<span class="value"><i class="fa fa-user"></i> <?php echo $ac->username; ?></span>
							<span class="sparklinepie big"><!--11,19,20--></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	</div>
	</div><!-- /CONTENT-->
</div>
<script type="text/javascript">
	/* $.get('<?php echo site_url('welcome/welcome/dealer');?>', function(data){
		$('#stage').html(data);
		});
	 */		


		</script>