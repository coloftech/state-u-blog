<div class="col-md-12">
	<div class="panel Statitics">
		<div class="panel-heading"><h4>Statitics</h4></div>
	
	<div class="panel-body">
	<div class="col-md-3">
		<div class="alert alert-info">
			New Messages	<i class="fa fa-envelope"></i> 0
		</div>
		
	</div>
	<div class="col-md-3">
		<div class="alert alert-info">
		Comments <i class="fa fa-comment"></i> 0
		</div>
		
	</div>
	<div class="col-md-3">
		<div class="alert alert-info">Downloads <i class="fa fa-download"></i> 0</div>
		
	</div>
	<div class="col-md-3">
		<div class="alert alert-info">Todal Visits <i class="fa fa-eye"></i> </div>
		
	</div>
	</div>

	</div>
		<div class="panel chart">
		<div class="panel-heading"><h4>Graphical View</h4></div>
	
	<div class="panel-body">
	<div class="col-md-6">
		<div class="alert alert-success">
		Downloads <i class="fa fa-download"></i> Chart</div>
		<div class="sub-chart" id="downloadchart"></div>
		
	</div>
	<div class="col-md-6">
		<div class="alert alert-warning">Visitors <i class="fa fa-eye"></i> Chart</div>
		<div class="sub-chart" id="visitchart"></div>
		
	</div>
	</div>

	</div>
</div>

	<script>
		$(function () {
		    $('#visitchart').highcharts({
		        chart: {
		            type: 'line'
		        },
		        title: {
		            text: 'Coloftech weekly visitors'
		        },
		        subtitle: {
		            text: 'Source: www.coloftech.com'
		        },
		        xAxis: {
		            categories: <?php echo json_encode(array('Mon','Tue','Wed','Thur','Fri','Sat','Sun')) ?>,
		            crosshair: true
		        },
		        yAxis: {
		            min: 0,
		            title: {
		                text: 'Total Visitor'
		            }
		        },
		        plotOptions: {
		            column: {
		                pointPadding: 0.2,
		                borderWidth: 0
		            }
		        },
		        series: [{
		            name: 'Visits',
		            data: <?php echo json_encode(array(1,4,7,2,5,8,3)) ?>
		        }]
		    });

		    $('#downloadchart').highcharts({
		        chart: {
		            type: 'column'
		        },
		        title: {
		            text: 'Coloftech weekly download'
		        },
		        subtitle: {
		            text: 'Source: www.coloftech.com'
		        },
		        xAxis: {
		            categories: <?php echo json_encode(array('Mon','Tue','Wed','Thur','Fri','Sat','Sun')) ?>,
		            crosshair: true
		        },
		        yAxis: {
		            min: 0,
		            title: {
		                text: 'Total download'
		            }
		        },
		        plotOptions: {
		            column: {
		                pointPadding: 0.2,
		                borderWidth: 0
		            }
		        },
		        series: [{
		            name: 'Download',
		            data: <?php echo json_encode(array(1,3,5,1,6,6,3)) ?>
		        }]
		    });
		});
	</script>