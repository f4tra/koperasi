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
			//$idx = $this->auth->userid();
			//$users = $this->mgeneral->Getwhere(array('id'=>$idx),"tr_user");
			//print_r($users);
			$awal=$this->db->query("select id,code,name,active,descr,parent_id,group_id from tr_wf where parent_id='0'")->result();
			//print_r($awal);
			foreach($awal as $key=>$value){
		?>
			<li class="has-sub active">
				<a href="javascript:;" class="">
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text"><?php echo $value->name;?></span>
					<span class="arrow open"></span>
				</a>
				<ul class="sub">
					<?php 
						$parent=$this->db->query("select id,icons,code,name,active,descr,parent_id from tr_wf where parent_id='".$value->id."'")->result();
						//print_r("select code,name,active,descr,parent_id from tr_not where id='".$value->parent_id."'");
						foreach($parent as $key=>$valuetwo){
						?>		
					<li class="has-sub-sub">
						<a href="javascript:;" class="">
							<span class="sub-menu-text"><?php echo $valuetwo->name;?></span>
							<span class="arrow open"></span>
						</a>
						<ul class="sub-sub ">
							<?php 
						$child=$this->db->query("select parameter_a,parameter_b,id,icons,code,name,active,descr,parent_id,link from tr_wf where parent_id='".$valuetwo->id."'")->result();
						
						foreach($child as $key=>$child_val){
						?>
							<li  class="has-sub-sub">
								<?php 
								$sub =$this->db->query("select parameter_a,parameter_b,id,icons,code,name,active,descr,parent_id,link from tr_wf where parent_id='".$child_val->id."'")->result();
								//print_r($sub);
								if(empty($sub)){
								?>
								<a href="
									<?php
										if($child_val->parameter_a == 0 and $child_val->parameter_b == 0){
											echo site_url().$child_val->link;
										}else{
											echo site_url().$child_val->link.'/'.$child_val->parameter_a.'/'.$child_val->parameter_b;
											
										} ?>
								" class="">
									
									<!-- <span class='label label-info arrow-in arrow-out-right'> -->
										<span class="sub-sub-menu-text"><?php echo $child_val->name;?></span>
									<!-- </span> -->
								</a>
								<?php }else{ ?>
								<a href="javascript:;" class="">
									<span class="sub-menu-text"><?php echo $child_val->name;?></span>
									<span class="arrow open"></span></a>
								<ul class="sub-sub">	
																
								<?php foreach ($sub as $key => $value) { ?>
								
								
									<li class="has-sub-sub-sub">
										<a href="#"><?php echo $value->name;?></a>
										
										
									</li>
								
								<?php }	?>
								</ul>

								<?php }?>
							</li>
							<?php } ?>							
							</ul>
						
					</li>

					<?php } ?>
				</ul>
			</li>			
			<?php }
			 ?>
		</ul>
	</div>
