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
					
					<?php
						/*$induk=$this->db->query("select parameter_a,parameter_b,id,icons,code,name,active,descr,parent_id,group_id,link from tr_wf where id='4'")->result();
						foreach ($induk as $key => $value) {
							
							$child=$this->db->query("select parameter_a,parameter_b,id,icons,code,name,active,descr,parent_id,link from tr_wf where id='".$value->group_id."'")->result();
							foreach ($child as $key => $value_child) {
								# code...
							print '<li><i class="fa '.$value_child->icons.' fa-fw"></i>'.$value_child->name.'</li>';
							}

						}*/
						/*$g = $this->uri->segment(1);
						$gg = $this->uri->segment(1).'/'.$this->uri->segment(2);
						if($g == ''){
							echo "Dashboard";
						}else{
							$induk_query = $this->db->query("select icons, id,caption,parent_id from tr_gui where link ='".$g."'")->row();
							print_r($induk_query);
							if(empty($induk_query))
								$kl = "0";
							else
								$kl = $induk_query->id;
							//print_r($kl);
							$parent_query = $this->db->query("select icons,link, id,caption,parent_id from tr_gui where parent_id ='".$kl."'")->result();
							if(!empty($induk_query) or !empty(!$parent_query)){
								print '<li><i class="fa '.$induk_query->icons.' fa-fw"></i>'.$induk_query->caption.'</li>';			
									
								$end = $this->db->query("select icons, id,caption,parent_id from tr_gui where link ='".$gg."'")->row();
								if(!empty($end)) echo "<li>".$end->caption."</li>";
								//else
								//print_r($end);
							}else{
								echo "";
							}
						}*/
						
					?>					
				</ul>
				<!-- /BREADCRUMBS -->				
				<div class="clearfix">
					<h3 class="content-title pull-left">
					
					<?php 					
						/*$h3 = $this->db->query("select caption,parameter_a,parameter_b,id,icons,code,name,active,descr,parent_id,group_id,link from tr_wf where id='4'")->row();
						echo $h3->caption;*/
					?></h3>
				

					<!-- <span class="pull-right">
						<a href="<?php echo site_url('workflow');?>" class="btn btn-success">Create New WorkFlow</a>
					</span> -->
				</div>
				<div class="description"></div>

				</div>
			</div>
		</div>
	<!-- /PAGE HEADER -->
	