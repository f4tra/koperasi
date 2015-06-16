	<!-- SELECTION AND ZOOMING CHART -->
						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border inverse">
									<div class="box-title">
										<h4><i class="fa fa-signal"></i>Selection and Zooming Chart</h4>
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
										
										<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
										<button class="btn btn-s btn-info" id="button-reset">Reset Zoom</button>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
						<!-- SELECTION AND ZOOMING CHART -->

	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i><?php echo $this->uri->segment(2); ?></h4> 					
				</div>
				<div class="box-body">
				
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
				<thead>
					<tr>						
						<th>ID</th>
						<!-- <th>Code</th> -->						
						<th>Item</th>															
						<th>Price 1</th>															
						<th>Price 2</th>																															
						<th>Price 3</th>																															
						<th>Price 4</th>																															
						<th>Start Date</th>																															
						<th>End Date</th>																															
						<th>Active</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="8">Loading Data</td>
					</tr>
				</tbody>
				</table>
					<a class="btn btn-warning" href="<?php echo site_url('unitstock/pricehistory/form_parsing/');?>/<?php if(!empty($idx)) echo $idx;?>">Add New</a>
				</div>
				
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
		
	
<script type="text/javascript">
$(document).ready(function() {
	var line1=[
		
      <?php 
      foreach ($rows_price as $key => $value) {
      	$date = new DateTime($value->start_date);
      	$change = $date->format('d-F-y');
      	echo "['".$change."',".$value->price4."],";
      }
      ?>
      ];
      var line2=[
		
      <?php 
      foreach ($rows_price as $key => $value) {
      	$date = new DateTime($value->start_date);
      	$change = $date->format('d-F-y');
      	echo "['".$change."',".$value->price3."],";
      }
      ?>
      ];
      var line3=[
		
      <?php 
      foreach ($rows_price as $key => $value) {
      	$date = new DateTime($value->start_date);
      	$change = $date->format('d-F-y');
      	echo "['".$change."',".$value->price2."],";
      }
      ?>
      ];
      var line4=[
		
      <?php 
      foreach ($rows_price as $key => $value) {
      	$date = new DateTime($value->start_date);
      	$change = $date->format('d-F-y');
      	echo "['".$change."',".$value->price1."],";
      }
      ?>
      ];
  //var plot1 = $.jqplot('container', [line1,cosPoints], {
  var plot1 = $.jqplot('container', [line1,line2,line3,line4], {
      title:'Grafik Kenaikan Harga',
      axes:{
        xaxis:{
          renderer:$.jqplot.DateAxisRenderer,
          tickOptions:{
            formatString:'%b&nbsp;%#d'
          } 
        },
        yaxis:{
          tickOptions:{
            formatString:'Rp. %.2f'
            }
        }
      },
      highlighter: {
        show: true,
        sizeAdjust: 7.5
      },
      cursor: {
        show: true,
        zoom:true, 
        showTooltip:true
      }
  });
  $('#button-reset').click(function() { plot1.resetZoom() });
	$('#data').dataTable({
		'sPaginationType': 'bs_full',
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "<?php echo site_url('unitstock/productavailable/load_price');?>/<?php echo $idx;?>",
		"sServerMethod": "POST",
		
		"aaSorting": [[0, "asc"]],
		"iDisplayLength": 10,			
		"aoColumns" : [
			
			{"mData": "id"},
			/*{"mData": "code"},*/
			{"mData": "item_name",
				"mRender" : function ( data, type, m ) {				
					if(m.item_name == 0 ||m.item_name == ''||m.item_name == null){
						return "<font color='#ff0000'>Unidentify</font>"; 			
					}else{
						return m.item_name; 
					} 				
				}
			},
			{"mData": "price1"},
			{"mData": "price2"},
			{"mData": "price3"},
			{"mData": "price4"},
			{"mData": "start_date"/*,			
				"mRender" : function ( data, type, st ) {				
					var foo = st.start_date;
					var arr = foo.split("-");
					var tahun = arr[0];
					var bulan = arr[1];
					var tanggal = arr[2];
						return tanggal+"-"+bulan+"-"+tahun;
				} 			*/	
				
			},
			{"mData": "end_date"/*,
				"mRender" : function ( data, type, sd ) {				
					var foo = sd.end_date;
					var arr = foo.split("-");
					var tahun = arr[0];
					var bulan = arr[1];
					var tanggal = arr[2];
						return tanggal+"-"+bulan+"-"+tahun;
				} 				*/
				
			},
			
				
									
			{"mData": "active",
				"mRender" : function ( data, type, full ) {				
					if(full.active == 1){
						return "<center><input  data-id="+full.id+" checked type='checkbox' id='active' class='checkbox' value='0'/></center>"; 			
					}else{
						return "<center><input  data-id="+full.id+" type='checkbox' id='active' class='checkbox' value='1'/></center>"; 
					} 				
				}
			},
			{"mData": "show"},
		],
	});
	$('#data').each(function(){
		var datatable = $(this);
		var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
		search_input.attr('placeholder', 'Search');
		search_input.addClass('form-control input-sm');
		var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
		length_sel.addClass('form-control input-sm');
	});
	$('#data').delegate('.checkbox','change',function() {
		var i = $(this).attr('data-id');		
		var id = $(this).attr('data-id');
		if(this.checked){
			//alert("checked");
			$.ajax({
				url: '<?php echo site_url('unitstock/pricehistory/execute/active/'); ?>',
				type: 'post',
				data: 'active=1&id='+i,
				success: function(result)
				{
					$('span-'+id).removeClass('label-default ').addClass('label-info');
					$('span-'+id).html('Active');					
				}
			});
		}else {
			//alert("unchecked");
			$.ajax({
				url: '<?php echo site_url('unitstock/pricehistory/execute/active/'); ?>',
				type: 'post',
				data: 'active=0&id='+i,							
				success: function(result)
				{
					console.log();
					$('span-'+id).removeClass('label-info ').addClass('label-default');
					$('span-'+id).html('Inactive');
				}
			});
		}
	});
});
function del(btn)
{
	var cek = confirm("Apakah anda yakin akan menghapus??");
	if(cek==false)
	{
		return false;
	}
	else
	{
		var id = $(btn).attr('data-id');		
		$.ajax({
			url: '<?php echo base_url().'index.php/unitstock/productavailable/execute/delete/';?>'+id,
			type: "POST",
			data:{data_id:id},
			crossDomain:true,
			beforeSend: function(){
				$("#msg").html("loading"); 
			},
			complete : function(){
				$("#msg").html("delete Sukses"); 
			}, 
			success: function(data) {				
				location.reload();
			},	
		});
		return false;
	}
}
</script>