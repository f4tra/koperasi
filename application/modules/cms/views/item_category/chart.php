<!-- SELECTION AND ZOOMING CHART -->
						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border inverse">
									<div class="box-title">
										<h4><i class="fa fa-signal"></i>Price History</h4>
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
                   
            <th>Item</th>                             
            <th>Price 1</th>                              
            <th>Price 2</th>                                                              
            <th>Price 3</th>                                                              
            <th>Price 4</th>                                                              
            <th>Start Date</th>                                                             
            <th>End Date</th>                                                       
          </tr>
        </thead>
        <tbody>
          <?php 
            foreach ($rows_price as $key => $value) {
              echo "<tr>";
              echo "<td>".$value->name."</td>";
              echo "<td>".$value->price1."</td>";
              echo "<td>".$value->price2."</td>";
              echo "<td>".$value->price3."</td>";
              echo "<td>".$value->price4."</td>";
              echo "<td>".$value->start_date."</td>";
              echo "<td>".$value->end_date."</td>";
              echo "</tr>";
            }
          ?>
        </tbody>
        </table>
          
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
      },
        showMarker:false, 
      pointLabels: { show:true } 
  });
  $('#button-reset').click(function() { plot1.resetZoom() });
  $('#data').dataTable({
    'sPaginationType': 'bs_full',
    "bProcessing": true
  });
  $('#data').each(function(){
    var datatable = $(this);
    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
    search_input.attr('placeholder', 'Search');
    search_input.addClass('form-control input-sm');
    var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
    length_sel.addClass('form-control input-sm');
  });
  
});
		</script>