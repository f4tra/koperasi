<ul id="org" style="display:none">
<?php
	$strSQL = $this->db->query("select * from tr_hr_div where parent_id = 0 order by code")->result();
	foreach ($strSQL as $key => $one_value) {
		$strSQLagain = $this->db->query("select * from tr_user where id='".$one_value->user_id."'")->row();
		if(!empty($strSQLagain)){
			$name =  $strSQLagain->nick_name;
		}else{
			$name = "<font color=#ff0000>Unidentify</font>";
		}
		?>
		<li>
			<div class="box border red">
				<div class="box-title">
					<h7><?php echo $one_value->name ?></h7>
				</div>
				<div class="box-body">
					<div class="sparkling-row">
						<span class="title"><font color="#666666"><?=$name;?></font></span>
					</div>
				</div>
			</div>
			<ul>			
				<?php
					$sql_parent = $this->db->query("select * from tr_hr_div where parent_id = '".$one_value->id."' order by code")->result();
					foreach($sql_parent as $key=>$two_value){
						$strSQLagainParent = $this->db->query("select * from tr_user where id='".$two_value->user_id."'")->row();
						if(!empty($strSQLagainParent)){
							$name_parent =  $strSQLagainParent->nick_name;
						}else{
							$name_parent = "<font color=#ff0000>Unidentify</font>";
						}
						?>
						<li id="<?=$two_value->name; ?>">
							<div class="box border orange">
								<div class="box-title">
									<h7><?=$two_value->name; ?></h7>
								</div>
								<div class="box-body">
									<div class="sparkling-row">
										<span class="title"><font color="#666666"><?=$name_parent;?></font></span>
									</div>
								</div>
							</div>
							<ul>
								<?php
									$sql_parent_first = $this->db->query("select * from tr_hr_div where parent_id = '".$two_value->id."' order by code")->result();
									foreach($sql_parent_first as $key=>$tree_value){
										$tree_lop = $this->db->query("select * from tr_user where id='".$tree_value->user_id."'")->row();
										if(!empty($tree_lop)){
											$name_parent_lop =  $tree_lop->nick_name;
										}else{
											$name_parent_lop = "<font color=#ff0000>Unidentify</font>";
										}
									?>
									<li id="<?=$tree_value->name;?>">
										<div class="box border purple">
											<div class="box-title">
												<h7><?=$tree_value->name;?></h7>
											</div>
											<div class="box-body">
												<div class="sparkling-row">
													<span class="title"><font color="#666666"><?=$name_parent_lop;?></font></span>
												</div>
											</div>
										</div>
										<ul>
											<?php
												$sql_parent_four = $this->db->query("select * from tr_hr_div where parent_id = '".$tree_value->id."' order by code")->result();
												foreach($sql_parent_four as $key=>$four_value){
													$four_lop = $this->db->query("select * from tr_user where id='".$four_value->user_id."'")->row();
													if(!empty($four_lop)){
														$name_four_lop =  $four_value->nick_name;
													}else{
														$name_four_lop = "<font color=#ff0000>Unidentify</font>";
													}
												?>
													<li id="<?=$tree_value->name;?>">
														<div class="box border blue">
															<div class="box-title">
																<h7><?=$four_value->name;?></h7>
															</div>
															<div class="box-body">
																<div class="sparkling-row">
																	<span class="title"><font color="#666666"><?=$name_four_lop;?></font></span>
																</div>
															</div>
														</div>
														<ul>
															<?php
																$sql_parent_five = $this->db->query("select * from tr_hr_div where parent_id = '".$four_value->id."' order by code")->result();
																foreach($sql_parent_five as $key=>$five_value){
																	$five_lop = $this->db->query("select * from tr_user where id='".$five_value->user_id."'")->row();
																	if(!empty($five_lop)){
																		$name_five_lop =  $five_value->nick_name;
																	}else{
																		$name_five_lop = "<font color=#ff0000>Unidentify</font>";
																	}
															?>
															<li id="<?=$tree_value->name;?>">
																<div class="box border gray">
																	<div class="box-title">
																		<h7><?=$five_value->name;?></h7>
																	</div>
																	<div class="box-body">
																		<div class="sparkling-row">
																			<span class="title"><font color="#666666"><?=$name_five_lop;?></font></span>
																		</div>
																	</div>
																</div>																
															</li>
															<?php } ?>
														</ul>
													</li>
											<?php } ?>
										</ul>
									</li>
								<?php } ?>
							</ul>
						</li>
				<?php } ?>
			</ul>
		</li>
	<?php } ?>
</ul>
<div id="chart" class="orgChart"></div>
		
		<script type="text/javascript">
	jQuery(document).ready(function() {
    	$("#org").jOrgChart({
    		chartElement :'#chart',
    		dragAndDrop : true,
    	});
    });
</script>
<script>
	jQuery(document).ready(function() {
    	/* Custom jQuery for the example */
        	$("#show-list").click(function(e){
            	e.preventDefault();
                $('#list-html').toggle('fast', function(){
                if($(this).is(':visible')){
                            $('#show-list').text('Hide underlying list.');
                            $(".topbar").fadeTo('fast',0.9);
                        }else{
                            $('#show-list').text('Show underlying list.');
                            $(".topbar").fadeTo('fast',1);                  
                        }
                    });
                });
               
                $('#list-html').text($('#org').html());
               
                $("#org").bind("DOMSubtreeModified", function() {
                    $('#list-html').text('');
                   
                    $('#list-html').text($('#org').html());
                   
                    prettyPrint();                
                });
            });
        </script> 


