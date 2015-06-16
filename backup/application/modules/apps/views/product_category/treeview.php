<ul id="org" style="display:none">
<?php
	$strSQL = $this->db->query("select * from tr_item_ctg where id = ".$idx." order by code")->result();
	foreach ($strSQL as $key => $one_value) {
		
		print_r($one_value);
		?>
		<li>
			<div class="box border red">
				<div class="box-title">
					<h7><?=$one_value->name ?></h7>
				</div>
				<div class="box-body">
					<div class="sparkling-row">
						<span class="title"><font color="#666666"></font></span>
					</div>
				</div>
			</div>
			<ul>			
				<?php
					$sql_parent = $this->db->query("select * from tr_item_ctg where parent_id = '".$one_value->id."' order by code")->result();
					foreach($sql_parent as $key=>$two_value){
					
						?>
						<li id="<?=$two_value->name; ?>">
							<div class="box border orange">
								<div class="box-title">
									<h7><?=$two_value->name; ?></h7>
								</div>
								<div class="box-body">
									<div class="sparkling-row">
										<span class="title"><font color="#666666"></font></span>
									</div>
								</div>
							</div>
							<ul>
								<?php
									$sql_parent_first = $this->db->query("select * from tr_item_ctg where parent_id = '".$two_value->id."' order by code")->result();
									foreach($sql_parent_first as $key=>$tree_value){
										
									?>
									<li id="<?=$tree_value->name;?>">
										<div class="box border purple">
											<div class="box-title">
												<h7><?=$tree_value->name;?></h7>
											</div>
											<div class="box-body">
												<div class="sparkling-row">
													<span class="title"><font color="#666666"></font></span>
												</div>
											</div>
										</div>
										<ul>
											<?php
												$sql_parent_four = $this->db->query("select * from tr_item_ctg where parent_id = '".$tree_value->id."' order by code")->result();
												foreach($sql_parent_four as $key=>$four_value){
													
												?>
													<li id="<?=$tree_value->name;?>">
														<div class="box border blue">
															<div class="box-title">
																<h7><?=$four_value->name;?></h7>
															</div>
															<div class="box-body">
																<div class="sparkling-row">
																	<span class="title"><font color="#666666"></font></span>
																</div>
															</div>
														</div>
														<ul>
															<?php
																$sql_parent_five = $this->db->query("select * from tr_item_ctg where parent_id = '".$four_value->id."' order by code")->result();
																foreach($sql_parent_five as $key=>$five_value){
																	
															?>
															<li id="<?=$tree_value->name;?>">
																<div class="box border gray">
																	<div class="box-title">
																		<h7><?=$five_value->name;?></h7>
																	</div>
																	<div class="box-body">
																		<div class="sparkling-row">
																			<span class="title"><font color="#666666"></font></span>
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

<div id="load">
	
</div>
<script type="text/javascript">
/*	$.ajax({
    	url: "<?php echo base_url();?>index.php/organization/divtreeview/load",
        cache: false,
        success : function(html){
        	$("#load").html(html);
        }
    });
*/
</script>
