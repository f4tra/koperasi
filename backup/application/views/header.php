<!-- HEADER -->
	<header class="navbar clearfix" id="header">
		<div class="container">
				<div class="navbar-brand">
					<!-- COMPANY LOGO -->
					<a href="<?=base_url()?>">
						<img src="<?=base_url()?>assets/img/logo/logo.png" alt="PT.Links Data Solusindo" class="img-responsive" height="30" width="120" />
					</a>
					<!-- /COMPANY LOGO -->
					<!-- PROJECT SWITCHER FOR MOBILE -->
					<div class="visible-xs">
						<a href="#" class="project-switcher-btn switcher btn dropdown-toggle tip-bottom" data-toggle="tooltip" title="Toggle Team View">
							<i class="fa fa-group"></i>
						</a>
					</div>
					<!-- /PROJECT SWITCHER FOR MOBILE -->
					<!-- SIDEBAR COLLAPSE -->
					<div id="sidebar-collapse" class="sidebar-collapse btn tip-bottom" data-toggle="tooltip" title="Toggle Sidebar">
						<i class="fa fa-reorder" data-icon1="fa fa-reorder" data-icon2="fa fa-reorder"></i>
					</div>
					<!-- /SIDEBAR COLLAPSE -->
				</div>
				<!-- NAVBAR LEFT -->
				<ul class="nav navbar-nav pull-left hidden-xs" id="navbar-left">
					<li class="dropdown">
						<a href="#" class="project-switcher-btn dropdown-toggle tip-bottom" data-toggle="tooltip" title="Toggle Team View">
							<i class="fa fa-group"></i>
							<span class="name">Team Status</span>
							<i class="fa fa-angle-down"></i>
						</a>
					</li>
					<!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
							<span class="name">Skins</span>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu skins">
							<li class="dropdown-title">
								<span><i class="fa fa-leaf"></i> Theme Skins</span>
							</li>
							<li><a href="#" data-skin="default">Subtle (default)</a></li>
							<li><a href="#" data-skin="night">Night</a></li>
							<li><a href="#" data-skin="earth">Earth</a></li>
							<li><a href="#" data-skin="utopia">Utopia</a></li>
							<li><a href="#" data-skin="nature">Nature</a></li>
							<li><a href="#" data-skin="graphite">Graphite</a></li>
						 </ul>
					</li> -->
				</ul> 
				<!-- /NAVBAR LEFT -->
				<!-- BEGIN TOP NAVIGATION MENU -->					
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->	
					 <li class="dropdown" id="header-notification">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell"></i>
							<span class="badge">7</span>						
						</a>
						<ul class="dropdown-menu notification">
							<li class="dropdown-title">
								<span><i class="fa fa-bell"></i> 7 Notifications</span>
							</li>
							<li>
								<a href="#">
									<span class="label label-success"><i class="fa fa-user"></i></span>
									<span class="body">
										<span class="message">5 users online. </span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>Just now</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-primary"><i class="fa fa-comment"></i></span>
									<span class="body">
										<span class="message">Martin commented.</span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>19 mins</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-warning"><i class="fa fa-lock"></i></span>
									<span class="body">
										<span class="message">DW1 server locked.</span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>32 mins</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-info"><i class="fa fa-twitter"></i></span>
									<span class="body">
										<span class="message">Twitter connected.</span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>55 mins</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-danger"><i class="fa fa-heart"></i></span>
									<span class="body">
										<span class="message">Jane liked. </span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>2 hrs</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-warning"><i class="fa fa-exclamation-triangle"></i></span>
									<span class="body">
										<span class="message">Database overload.</span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>6 hrs</span>
										</span>
									</span>
								</a>
							</li>
							<li class="footer">
								<a href="#">See all notifications <i class="fa fa-arrow-circle-right"></i></a>
							</li>
						</ul>
					</li> 
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN INBOX DROPDOWN -->
					<!-- <li class="dropdown" id="header-message">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope"></i>
						<span class="badge">3</span>
						</a>
						<ul class="dropdown-menu inbox">
							<li class="dropdown-title">
								<span><i class="fa fa-envelope-o"></i> 3 Messages</span>
								<span class="compose pull-right tip-right" title="Compose message"><i class="fa fa-pencil-square-o"></i></span>
							</li>
							<li>
								<a href="#">
									<img src="img/avatars/avatar2.jpg" alt="" />
									<span class="body">
										<span class="from">Jane Doe</span>
										<span class="message">
										Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole ...
										</span> 
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>Just Now</span>
										</span>
									</span>
									 
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/avatars/avatar1.jpg" alt="" />
									<span class="body">
										<span class="from">Vince Pelt</span>
										<span class="message">
										Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole ...
										</span> 
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>15 min ago</span>
										</span>
									</span>
									 
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/avatars/avatar8.jpg" alt="" />
									<span class="body">
										<span class="from">Debby Doe</span>
										<span class="message">
										Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole ...
										</span> 
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>2 hours ago</span>
										</span>
									</span>
									 
								</a>
							</li>
							<li class="footer">
								<a href="#">See all messages <i class="fa fa-arrow-circle-right"></i></a>
							</li>
						</ul>
					</li> -->
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN TODO DROPDOWN -->
					<!-- <li class="dropdown" id="header-tasks">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-tasks"></i>
						<span class="badge">3</span>
						</a>
						<ul class="dropdown-menu tasks">
							<li class="dropdown-title">
								<span><i class="fa fa-check"></i> 6 tasks in progress</span>
							</li>
							<li>
								<a href="#">
									<span class="header clearfix">
										<span class="pull-left">Software Update</span>
										<span class="pull-right">60%</span>
									</span>
									<div class="progress">
									  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
										<span class="sr-only">60% Complete</span>
									  </div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="header clearfix">
										<span class="pull-left">Software Update</span>
										<span class="pull-right">25%</span>
									</span>
									<div class="progress">
									  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
										<span class="sr-only">25% Complete</span>
									  </div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="header clearfix">
										<span class="pull-left">Software Update</span>
										<span class="pull-right">40%</span>
									</span>
									<div class="progress progress-striped">
									  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
										<span class="sr-only">40% Complete</span>
									  </div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="header clearfix">
										<span class="pull-left">Software Update</span>
										<span class="pull-right">70%</span>
									</span>
									<div class="progress progress-striped active">
									  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
										<span class="sr-only">70% Complete</span>
									  </div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="header clearfix">
										<span class="pull-left">Software Update</span>
										<span class="pull-right">65%</span>
									</span>
									<div class="progress">
									  <div class="progress-bar progress-bar-success" style="width: 35%">
										<span class="sr-only">35% Complete (success)</span>
									  </div>
									  <div class="progress-bar progress-bar-warning" style="width: 20%">
										<span class="sr-only">20% Complete (warning)</span>
									  </div>
									  <div class="progress-bar progress-bar-danger" style="width: 10%">
										<span clasSetup0% Complete (danger)</span>
									  </div>
									</div>
								</a>
			
							
								<a href="#">See all tasks <i class="fa fa-arrow-circle-right"></i></a>
							</li>
						</ul>
					</li> -->
					<!-- END TODO DROPDOWN -->
					<!-- BEGIN Setup --> 
					<?php
					$id		= $this->auth->userid();
					$session 	=$this->db->query("select role_id from tr_user where id='".$id."'")->row();
					if($session->role_id == 1){
						
					?>
					<li class="dropdown" id="header-tasks">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa fa-wrench fa-fw"></i>
						</a>					
						<ul class="dropdown-menu notification">							
							<li class="dropdown-title">
								<span><i class="fa  fa-fw"></i> User Role<span>
							</li>
							<li>
								<a href="<?php echo site_url('setup/user');?>">									
									<span class="label label-success"><i class="fa fa-user fa-fw"></i></span>
									<span class="body">
										<span class="message">Users </span>
									</span>
								</a>
								<a href="<?php echo site_url('setup/role');?>">									
									<span class="label label-success"><i class="fa fa-user fa-fw"></i></span>
									<span class="body">
										<span class="message">Role </span>
									</span>
								</a>
							</li>	
							<li class="dropdown-title">
								<span><i class="fa  fa-fw"></i> Screen<span>
							</li>
							<li>
								<a href="<?php echo site_url('setup/screen');?>">									
									<span class="label label-success"><i class="fa fa-user fa-fw"></i></span>
									<span class="body">
										<span class="message">GUI </span>
									</span>
								</a>
								<a href="<?php echo site_url('setup/rule');?>">									
									<span class="label label-success"><i class="fa fa-user fa-fw"></i></span>
									<span class="body">
										<span class="message">Rule </span>
									</span>
								</a>
							</li>							
						</ul>						
					</li>
					<?php } ?>
					
					<!-- END Setup -->
					
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user pull-right" id="header-user">
							<?php 
							
							$id			= $this->auth->userid();
							$username 	= $this->db->query("select * from tr_user where id='".$id."'")->row();
							$role 	= $this->db->query("select name from tr_role where id='".$username->role_id."'")->row();
							
							//print_r($username->username);
							//echo "".$username->username."<i class='icon-caret-down'></i>";
							?>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img alt="" src="<?=base_url()?>assets/img/avatars/avatar3.jpg" />
							<span class="username"><?php echo $username->username;?> (<?php echo $role->name;?>)</span>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
					
							<!--<li><a href="<?php //echo site_url('auth/profile'); ?>"><i class="fa fa-user"></i> My Profile</a></li>-->
							<li><a href="<?php echo site_url('auth/account'); ?>"><i class="fa fa-cog"></i> Account Settings</a></li>
							<li><a href="<?php echo site_url('auth/logout'); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU -->
		</div>
		
		<!-- PROJECT SWITCHER -->
		 <div class="container project-switcher" id="project-switcher">
		  <div id="scrollbar">
			<div class="handle">
			</div>
		  </div>
		  <div id="frame">
			  <ul class="project-list">
				<?php 
				$result = $this->db->query("select * from tr_user where id <> 1")->result();//$this->mgeneral->getWhere(array('id '=>1),'tr_user');
				foreach ($result as $key => $value) {
					
				?>
				<li class="current">
				  <a href="javascript:void(0);">
				  <span class="image">
					  <img src="<?php echo base_url();?>assets/img/avatars/avatar3.jpg" alt="" />
				  </span>
				  <span class="title">
					<?php 
					//echo $value->first_name." ".$value->mid_name." ".$value->last_name; 
					//$result = $this->mgeneral->getWhere(array('id'=>$value->div_id),'tr_hr_org');
					//print_r($result);
					?>
					<br/>
					<?php //echo $result[0]->name;?>
				  </span>
					<div class="progress">
					  <div class="progress-bar progress-bar-success" style="width: 35%">
						<span class="sr-only">35% Complete (success)</span>
					  </div>
					  <div class="progress-bar progress-bar-warning" style="width: 20%">
						<span class="sr-only">20% Complete (warning)</span>
					  </div>
					  <div class="progress-bar progress-bar-danger" style="width: 10%">
						<span class="sr-only">10% Complete (danger)</span>
					  </div>
					</div>
					<span class="status">
						<div class="field">
							<span class="badge badge-green">6</span> completed
							<span class="pull-right fa fa-check"></span>
						</div>
						<div class="field">
							<span class="badge badge-orange">3</span> in-progress
							<span class="pull-right fa fa-adjust"></span>
						</div>
						<div class="field">
							<span class="badge badge-red">1</span> pending
							<span class="pull-right fa fa-list-ul"></span>
						</div>
				    </span>
				  </a>
				</li>
				<?php } ?>
				
			  </ul>
			</div>
		  </div> 
		<!-- /PROJECT SWITCHER -->
	</header>
	<!--/HEADER -->