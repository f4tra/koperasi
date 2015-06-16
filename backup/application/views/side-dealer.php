<div id="sidebar" class="sidebar">
	<div class="sidebar-menu nav-collape">
		<ul>
			
			<?php 
				//$this->db = $this->load->database("default",true);
				$id		= $this->auth->userid();
				$session=$this->db->query("select role from t_user where ID_='".$id."'")->row();
							
				$sqlmenu1	=$this->db->query("SELECT b.role_id, b.gui_id,a.id,	a.code,	a.name,a.icon, a.caption,b.active, a.parent_id, a.link FROM	tr_gui AS a
											INNER JOIN tr_role_gui AS b ON a.id = b.gui_id where a.parent_id='0' and b.active='1' and b.role_id='".$session->role."' ORDER BY a.code ASC")->result();
			
			foreach($sqlmenu1 as $menu1){
				$cek = $this->db->query("select count(*)as r from tr_gui where parent_id='".$menu1->id."'")->row();
				if($cek->r > 0){
					if($this->uri->segment(1) == $menu1->link){
						$ac = "active";
						$op = "open";
					}else{
						$ac = "";
						$op = "";
					}
				
					$a = "<li class='has-sub ".$ac."'>
							<a href='javascript:;' class=''>
							<i class='fa fa-tachometer fa-fw'></i>
							<span class='menu-text'>".$menu1->caption."</span>
							<span class='arrow ".$op."'></span>
							";
				}else{
					
					$a = "<li class='active open'>
							<a href='".base_url()."' class=''>
							<i class='fa fa-tachometer fa-fw'></i>
							<span class='menu-text'>".$menu1->caption."</span>
							<span class='selected'></span>
							";
				}
				echo $a;
			?>
					<ul class="sub">
						<?php $sqlmenu2	=$this->db->query("SELECT b.role_id, b.gui_id,a.id,	a.code,	a.name,a.icon, a.caption,b.active, a.parent_id, a.link FROM	tr_gui AS a
										INNER JOIN tr_role_gui AS b ON a.id = b.gui_id where a.parent_id=".$menu1->id." and b.active='1' and b.role_id='".$session->role."' ORDER BY a.code ASC")->result();
										
						foreach($sqlmenu2 as $menu2){
							$mg = $this->uri->segment(1)."/".$this->uri->segment(2);
										
											if($mg == $menu2->link){
												$mc = "<span class='label label-info arrow-in arrow-out-right'>".$menu2->caption."</span>";
											}else{
												$mc = $menu2->caption;
											}
										?>
						<li class="has-sub-sub <?php //if (substr(uri_string(), 0, strlen($menu2->link)) == $menu2->link) echo ' current'; ?>">
							<?php 
							$count = $this->db->query("select count(*) as cek from tr_gui where parent_id =".$menu2->id)->row();
							if($count->cek > 0 ){
								$gb = $this->uri->segment(1)."/".$this->uri->segment(2);
								if( $gb== $menu2->link){
									$ac = "active";
									$op = "open";
								}else{
									$ac = "";
									$op = "";
								}
							?>
								<a href="#" class="">
								<span class="arrow <?php echo $op;?>"></span>
								
							<?php }else{?>
							<a href="<?=site_url($menu2->link);?>" class="">
							<?php }?>
							<span class="sub-menu-text"><?php echo $mc;?></span>
							
								<ul class="sub-sub">
									<?php $sqlmenu3	=$this->db->query("SELECT b.role_id, b.gui_id,a.id,	a.code,	a.name,a.icon, a.caption,b.active, a.parent_id, a.link FROM	tr_gui AS a
										INNER JOIN tr_role_gui AS b ON a.id = b.gui_id where a.parent_id=".$menu2->id." and b.active='1' and b.role_id='".$session->role."' ORDER BY a.code ASC")->result();
										
										foreach($sqlmenu3 as $menu3){
										$g = $this->uri->segment(1)."/".$this->uri->segment(2);
										
											if($g == $menu3->link){
												$m = "<span class='label label-info arrow-in arrow-out-right'>".$menu3->caption."</span>";
											}else{
												$m = $menu3->caption;
											}
										?>
									<li>
										<a href="<?=site_url($menu3->link);?>" class="">
										<span class="sub-sub-menu-text">
											<?php echo $m;?>
										</span>
										
										</a>
									</li>
									<?php }?>
								</ul>							
							
							</a>
						</li>
						<?php } ?>
					</ul>
				</a>
				
			</li>
		<?php } ?>
		</ul>
	</div>
</div>