
			<!-- SAMPLE BOX CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="box-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					  <h4 class="modal-title">Box Settings</h4>
					</div>
					<div class="modal-body">
					  Here goes box setting content.
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  <button type="button" class="btn btn-primary">Save changes</button>
					</div>
				  </div>
				</div>
			  </div>
			<!-- /SAMPLE BOX CONFIGURATION MODAL FORM-->
			
				<div class="row">
					<div id="content" class="col-lg-12">
						
						<!-- DASHBOARD CONTENT -->
						<div class="row">
							<!-- COLUMN 1 -->
							<div class="col-md-6">
								<div class="row">
								  <div class="col-sm-12 col-md-6">
									 <div class="dashbox panel panel-default">
										<div class="panel-body">
										   <div class="content red">
											  <div class="sparkline" data-color="white">16,7,23,13,12,11,15,4,19</div>
										   </div>
										   <div class="header">New Orders</div>
										   <div class="number">6 412</div>
										</div>
										<div class="panel-footer">
											<a class="view-more" href="javascript:void(0);">Details <i class="pull-right fa fa-angle-right"></i></a>
										</div>
									 </div>
								  </div>
								  <div class="col-sm-12 col-md-6">
									 <div class="dashbox panel panel-default">
										<div class="panel-body">
										   <div class="content orange">
											  <div class="sparkline" data-color="white">24,25,27,29,14,26,20,8,12</div>
										   </div>
										   <div class="header">Feedback</div>
										   <div class="number">819</div>
										</div>
										<div class="panel-footer">
											 <a class="view-more" href="javascript:void(0);">Details <i class="pull-right fa fa-angle-right"></i></a> 
										</div>
									 </div>
								  </div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="quick-pie panel panel-default">
											<div class="panel-body">
												<div class="col-md-4 text-center">
													<div id="dash_pie_1" class="piechart" data-percent="59">
														<span class="percent"></span>
													</div>
													<a href="#" class="title">New Visitors <i class="fa fa-angle-right"></i></a>
												</div>
												<div class="col-md-4 text-center">
													<div id="dash_pie_2" class="piechart" data-percent="73">
														<span class="percent"></span>
													</div>
													<a href="#" class="title">Bounce Rate <i class="fa fa-angle-right"></i></a>
												</div>
												<div class="col-md-4 text-center">
													<div id="dash_pie_3" class="piechart" data-percent="90">
														<span class="percent"></span>
													</div>
													<a href="#" class="title">Brand Popularity <i class="fa fa-angle-right"></i></a>
												</div>
											</div>
										</div>
									</div>
							   </div>
							</div>
							<!-- /COLUMN 1 -->
							
							<!-- COLUMN 2 -->
							<div class="col-md-6">
								<div class="box solid grey">
									<div class="box-title">
										<h4><i class="fa fa-dollar"></i>Revenue</h4>
										<div class="tools">
											<span class="label label-danger">
												20% <i class="fa fa-arrow-up"></i>
											</span>
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
										<div id="chart-revenue" style="height:240px"></div>
									</div>
								</div>
							</div>
							<!-- /COLUMN 2 -->
						</div>
					   <!-- /DASHBOARD CONTENT -->
					   <!-- HERO GRAPH -->
						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border green">
									<div class="box-title">
										<h4><i class="fa fa-reorder"></i>Traffic & Sales</h4>
									</div>
									<div class="box-body">
										<div class="tabbable box-tabs">
											<ul class="nav nav-tabs">
												 <li><a href="#box_tab2" data-toggle="tab">Select & Zoom Sales Chart</a></li>
												 <li class="active"><a href="#box_tab1" data-toggle="tab">Traffic Statistics</a></li>
											 </ul>
											 <div class="tab-content">
												 <div class="tab-pane active" id="box_tab1">
													<!-- TAB 1 -->
													<div id="chart-dash" class="chart"></div>
													<hr class="margin-bottom-0" />
													<ul class="stats">
													  <li> <strong>4,853</strong> <small>Total Views</small> </li>
													  <li class="hidden-xs"> <strong>271</strong> <small>Last 24 Hours</small> </li>
													  <li> <strong>1,025</strong> <small>Unique Users</small> </li>
													  <li class="hidden-xs"> <strong>105</strong> <small>Last 24 Hours</small> </li>
												   </ul>
												   <!-- /TAB 1 -->
												 </div>
												 <div class="tab-pane" id="box_tab2">
													<div class="demo-container">
														<div id="placeholder" class="demo-placeholder"></div>
													</div>

													<div class="demo-container" style="height:100px;">
														<div id="overview" class="demo-placeholder"></div>
													</div>
												</div>
											 </div>
										</div>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
						<!-- /HERO GRAPH -->
						<!-- NEW ORDERS & STATISTICS -->
						<div class="row">
							<!-- NEW ORDERS -->
							<div class="col-md-6">
								<div class="tabbable tabbable-custom">
									<ul class="nav nav-tabs">
									   <li class="active"><a href="#sales" data-toggle="tab"><i class="fa fa-bookmark"></i> New Orders</a></li>
									   <li><a href="#feed" data-toggle="tab"><i class="fa fa-rss"></i> Recent Activities</a></li>
									</ul>
									<div class="tab-content">
									   <div class="tab-pane active" id="sales">
										  <div class="panel panel-default">
											  <div class="panel-body orders no-opaque">
												<div class="scroller" data-height="450px" data-always-visible="1" data-rail-visible="1">
													<ul class="list-unstyled">
														<li class="clearfix">
															<div class="pull-left">
																<p>
																	<h5><strong>#001</strong> Rikki S. Stover</h5>
																</p>
																<p>
																	<span class="label label-success arrow-in-right"><i class="fa fa-check"></i> Complete</span>
																</p>
															</div>
															<div class="text-right pull-right">
																<h4 class="cost">$124.00</h4>
																<p><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 9, 2013">Oct 9, 2013</abbr></p>
															</div>
														</li>
														<li class="clearfix">
															<div class="pull-left">
																<p>
																	<h5><strong>#002</strong> Scott Allen</h5>
																</p>
																<p>
																	<span class="label label-warning arrow-in-right"><i class="fa fa-cog"></i> In Progress</span>
																</p>
															</div>
															<div class="text-right pull-right">
																<h4 class="cost">$235.00</h4>
																<p><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 10, 2013">Oct 10, 2013</abbr></p>
															</div>
														</li>
														<li class="clearfix">
															<div class="pull-left">
																<p>
																	<h5><strong>#003</strong> John Dale</h5>
																</p>
																<p>
																	<span class="label label-danger arrow-in-right"><i class="fa fa-star"></i> New</span>
																</p>
															</div>
															<div class="text-right pull-right">
																<h4 class="cost">$174.00</h4>
																<p><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 10, 2013">Oct 10, 2013</abbr></p>
															</div>
														</li>
														<li class="clearfix">
															<div class="pull-left">
																<p>
																	<h5><strong>#004</strong> MJ Perkins</h5>
																</p>
																<p>
																	<span class="label label-info arrow-in-right"><i class="fa fa-truck"></i> In Transit</span>
																</p>
															</div>
															<div class="text-right pull-right">
																<h4 class="cost">$68.00</h4>
																<p><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 11, 2013">Oct 11, 2013</abbr></p>
															</div>
														</li>
														<li class="clearfix">
															<div class="pull-left">
																<p>
																	<h5><strong>#005</strong> Edward Luc</h5>
																</p>
																<p>
																	<span class="label label-danger arrow-in-right"><i class="fa fa-star"></i> New</span>
																</p>
															</div>
															<div class="text-right pull-right">
																<h4 class="cost">$52.00</h4>
																<p><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 11, 2013">Oct 11, 2013</abbr></p>
															</div>
														</li>
														<li class="clearfix">
															<div class="pull-left">
																<p>
																	<h5><strong>#006</strong> A. Mangrum</h5>
																</p>
																<p>
																	<span class="label label-info arrow-in-right"><i class="fa fa-truck"></i> In Transit</span>
																</p>
															</div>
															<div class="text-right pull-right">
																<h4 class="cost">$14.00</h4>
																<p><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 11, 2013">Oct 11, 2013</abbr></p>
															</div>
														</li>
														<li class="clearfix">
															<div class="pull-left">
																<p>
																	<h5><strong>#007</strong> Tamika Owens</h5>
																</p>
																<p>
																	<span class="label label-warning arrow-in-right"><i class="fa fa-cog"></i> In Progress</span>
																</p>
															</div>
															<div class="text-right pull-right">
																<h4 class="cost">$604.00</h4>
																<p><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 11, 2013">Oct 11, 2013</abbr></p>
															</div>
														</li>
														<li class="clearfix">
															<div class="pull-left">
																<p>
																	<h5><strong>#008</strong> Larry Wright</h5>
																</p>
																<p>
																	<span class="label label-success arrow-in-right"><i class="fa fa-check"></i> Complete</span>
																</p>
															</div>
															<div class="text-right pull-right">
																<h4 class="cost">$77.00</h4>
																<p><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 11, 2013">Oct 11, 2013</abbr></p>
															</div>
														</li>
													</ul>
												</div>
											  </div>
											   <div class='text-center'>
												<ul class='pagination'>
												  <li class='disabled'>
													<a href='#'>
													  <i class='fa fa-angle-left'></i>
													</a>
												  </li>
												  <li class='active'>
													<a href='#'>
													  1
													</a>
												  </li>
												  <li>
													<a href='#'>2</a>
												  </li>
												  <li>
													<a href='#'>3</a>
												  </li>
												  <li>
													<a href='#'>4</a>
												  </li>
												  <li>
													<a href='#'>5</a>
												  </li>
												  <li>
													<a href='#'>
													  <i class='fa fa-angle-right'></i>
													</a>
												  </li>
												</ul>
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
											  <div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-edit btn btn-pink"></i>
													<a class="user" href="#"> Jess Doe </a>
													edited their skills.
													<br />
													<a href="#">Endorse them</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													5 hours ago
												</div>
											  </div>
											  <div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-bitcoin btn btn-yellow"></i>
													<a class="user" href="#"> Divine Doe </a>
													made a bitcoin payment.
													<br />
													<a href="#">Check your financials</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													6 hours ago
												</div>
											  </div>
											  <div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-dropbox btn btn-primary"></i>
													<a class="user" href="#"> Lisbon Doe </a>
													saved a new document to Dropbox.
													<br />
													<a href="#">Download</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													1 day ago
												</div>
											  </div>
											  <div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-pinterest btn btn-inverse"></i>
													<a class="user" href="#"> Bob Doe </a>
													pinned a new photo to Pinterest.
													<br />
													<a href="#">Take a look</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													2 days ago
												</div>
											  </div>
											  <div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-time btn btn-success"></i>
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
													<i class="pull-left roundicon fa fa-heart btn btn-purple"></i>
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
											  <div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-gift btn btn-pink"></i>
													<a class="user" href="#"> Jess Doe </a>
													edited their skills.
													<br />
													<a href="#">Endorse them</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													5 hours ago
												</div>
											  </div>
											  <div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-random btn btn-yellow"></i>
													<a class="user" href="#"> Divine Doe </a>
													made a bitcoin payment.
													<br />
													<a href="#">Check your financials</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													6 hours ago
												</div>
											  </div>
										  </div>
									   </div>
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
												<h4><i class="fa fa-money"></i>Sales Summary</h4>
												<div class="tools">
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
												  <div class="sparkline-row">
													<span class="title">Account balance</span>
													<span class="value">$19 999,99</span>
													<span class="sparkline big" data-color="blue"><!--16,7,23,13,12,11,15,4,19,18,4,24--></span>
												  </div>
												  <div class="sparkline-row">
													<span class="title">Clients</span>
													<span class="value">7654</span>
													<span class="sparkline big" data-color="red"><!--6,3,24,25,27,29,14,26,20,8,12,20--></span>
												  </div>
												  <div class="sparkline-row">
													<span class="title">Orders</span>
													<span class="value">605,64</span>
													<span class="sparkline big" data-color="green"><!--11,19,20,20,5,18,11,6,16,20,26,11--></span>
												  </div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="box border purple">
											<div class="box-title">
												<h4><i class="fa fa-adjust"></i>Distribution Index</h4>
												<div class="tools">
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
												  <div class="sparkline-row">
													<span class="title">Revenue distribution</span>
													<span class="value"><i class="fa fa-usd"></i> 25674</span>
													<span class="sparklinepie big"><!--16,7,23--></span>
												  </div>
												  <div class="sparkline-row">
													<span class="title">Sales</span>
													<span class="value"><i class="fa fa-money"></i> 19 999,99</span>
													<span class="sparklinepie big"><!--6,3,24,25--></span>
												  </div>
												  <div class="sparkline-row">
													<span class="title">Employee/ Dept</span>
													<span class="value"><i class="fa fa-user"></i> 645783</span>
													<span class="sparklinepie big"><!--11,19,20--></span>
												  </div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /STATISTICS -->
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-body">
										<table class="table table-striped table-bordered table-hover">
										 <thead>
											<tr>
											   <th><i class="fa fa-user"></i> Client</th>
											   <th class="hidden-xs"><i class="fa fa-quote-left"></i> Sales Item</th>
											   <th><i class="fa fa-dollar"></i> Amount</th>
											   <th><i class="fa fa-reorder"></i> Status</th>
											</tr>
										 </thead>
										 <tbody>
											<tr>
											   <td><a href="#">Fortune 500</a></td>
											   <td class="hidden-xs">Gold Level Virtual Server</td>
											   <td>$ 2310.23</td>
											   <td><span class="label label-success label-sm">Paid</span></td>
											</tr>
											<tr>
											   <td><a href="#">Cisco Inc.</a></td>
											   <td class="hidden-xs">Platinum Level Virtual Server</td>
											   <td>$ 5502.67</td>
											   <td><span class="label label-warning label-sm">Pending</span></td>
											</tr>
											<tr>
											   <td><a href="#">VMWare Ltd.</a></td>
											   <td class="hidden-xs">Hardware Switch</td>
											   <td>$ 3472.54</td>
											   <td><span class="label label-success label-sm">Paid</span></td>
											</tr>
											<tr>
											   <td><a href="#">Wall-Mart Stores</a></td>
											   <td class="hidden-xs">Branding & Marketing</td>
											   <td>$ 6653.25</td>
											   <td><span class="label label-success label-sm">Paid</span></td>
											</tr>
											<tr>
											   <td><a href="#">Exxon Mobil</a></td>
											   <td class="hidden-xs">UX and UI Services</td>
											   <td>$ 45645.45</td>
											   <td><span class="label label-danger label-sm">Overdue</span></td>
											</tr>
											<tr>
											   <td><a href="#">General Electric</a></td>
											   <td class="hidden-xs">Web Designing</td>
											   <td>$ 3432.11</td>
											   <td><span class="label label-warning label-sm">Pending</span></td>
											</tr>
										 </tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
						<!-- /NEW ORDERS & STATISTICS -->
						<!-- CALENDAR & CHAT -->
						<div class="row">
							<!-- CALENDAR -->
							<div class="col-md-6">
								<div class="box border primary">
									<div class="box-title">
										<h4><i class="fa fa-calendar"></i>Calendar</h4>
										<div class="tools">
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
										<div id='calendar'></div>
									</div>
								</div>
							</div>
							<!-- /CALENDAR -->
							<!-- CHAT -->
							<div class="col-md-6">
								<!-- BOX -->
								<div class="box border red chat-window">
									<div class="box-title">
										<h4><i class="fa fa-comments"></i>Chat Window</h4>
										<div class="tools">
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
									<div class="box-body big">
										<div class="scroller" data-height="402px" data-always-visible="1" data-rail-visible="1">
											<ul class="media-list chat-list">
												<li class="media">
												  <a class="pull-left" href="#">
													<img class="media-object" alt="Generic placeholder image" src="<?php echo base_url();?>assets/beckend/img/chat/headshot1.jpg" />
												  </a>
												  <div class="media-body chat-pop">
													<h4 class="media-heading">John Doe <span class="pull-right"><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 9, 2013">Oct 9, 2013</abbr> </span></h4>
													<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
													
												  </div>
												</li>
												<li class="media">
												  <a class="pull-right" href="#">
													<img class="media-object" alt="Generic placeholder image" src="<?php echo base_url();?>assets/beckend/img/chat/headshot2.jpg" />
												  </a>
												  <div class="pull-right media-body chat-pop mod">
													<h4 class="media-heading">You <span class="pull-left"><abbr class="timeago" title="Oct 10, 2013">Oct 10, 2013</abbr> <i class="fa fa-clock-o"></i></span></h4>
													Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
												  </div>
												</li>
												<li class="media">
												  <a class="pull-left" href="#">
													<img class="media-object" alt="Generic placeholder image" src="<?php echo base_url();?>assets/beckend/img/chat/headshot3.jpg" />
												  </a>
												  <div class="media-body chat-pop">
													<h4 class="media-heading">Tim Row <span class="pull-right"><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 10, 2013">Oct 10, 2013</abbr> </span></h4>
													<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
												  </div>
												</li>
												<li class="media">
												  <a class="pull-left" href="#">
													<img class="media-object" alt="Generic placeholder image" src="<?php echo base_url();?>assets/beckend/img/chat/headshot5.jpg" />
												  </a>
												  <div class="media-body chat-pop">
													<h4 class="media-heading">Jenny Doe <span class="pull-right"><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 10, 2013">Oct 10, 2013</abbr> </span></h4>
													<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
												  </div>
												</li>
												<li class="media">
												  <a class="pull-right" href="#">
													<img class="media-object" alt="Generic placeholder image" src="<?php echo base_url();?>assets/beckend/img/chat/headshot2.jpg" />
												  </a>
												  <div class="pull-right media-body chat-pop mod">
													<h4 class="media-heading">You <span class="pull-left"><abbr class="timeago" title="Oct 11, 2013">Oct 11, 2013</abbr> <i class="fa fa-clock-o"></i></span></h4>
													Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
												  </div>
												</li>
												<li class="media">
												  <a class="pull-left" href="#">
													<img class="media-object" alt="Generic placeholder image" src="<?php echo base_url();?>assets/beckend/img/chat/headshot4.jpg" />
												  </a>
												  <div class="media-body chat-pop">
													<h4 class="media-heading">Jess Doe <span class="pull-right"><i class="fa fa-clock-o"></i> <abbr class="timeago" title="Oct 12, 2013">Oct 12, 2013</abbr> </span></h4>
													<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
												  </div>
												</li>
												<li class="media">
												  <a class="pull-right" href="#">
													<img class="media-object" alt="Generic placeholder image" src="<?php echo base_url();?>assets/beckend/img/chat/headshot2.jpg" />
												  </a>
												  <div class="pull-right media-body chat-pop mod">
													<h4 class="media-heading">You <span class="pull-left"><abbr class="timeago" title="Oct 12, 2013">Oct 12, 2013</abbr> <i class="fa fa-clock-o"></i></span></h4>
													Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
												  </div>
												</li>
											</ul>
										</div>
										<div class="divide-20"></div>
										<div class="chat-form">
											<div class="input-group"> 
												<input type="text" class="form-control" placeholder="Type something...really, it works" /> 
												<span class="input-group-btn"> <button class="btn btn-primary" type="button"><i class="fa fa-check"></i></button> </span> 
											</div>
										</div>
									</div>
								</div>
								<!-- /BOX -->
							</div>
							<!-- CHAT -->
						</div>
						<!-- /CALENDAR & CHAT -->
						<div class="footer-tools">
							<span class="go-top">
								<i class="fa fa-chevron-up"></i> Top
							</span>
						</div>
					</div><!-- /CONTENT-->
				</div>
	
		
	