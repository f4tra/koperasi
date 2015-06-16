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
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
						<!-- SELECTION AND ZOOMING CHART -->
<script type="text/javascript">
$(function () {
    $('#container').highcharts({        
        title: {
            text: 'Grafik Kenaikan Harga',
            x: -20 //center
        },
        subtitle: {
            text: 'subtitle',
            x: -20
        },
        xAxis: {
            categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
        },
        yAxis: {
            title: {
                text: 'Harga'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' IDR'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '<?php echo $data_rows->name; ?>',
            data: []
        }]
        
    });
});
		</script>