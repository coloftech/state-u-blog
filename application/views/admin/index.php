<div class="wrapper admin-wrapper create">
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
		<div class="alert alert-info">Total posts <i class="fa fa-book"></i> 0</div>
		
	</div>
	<div class="col-md-3">
		<div class="alert alert-info">Todal Visits <i class="fa fa-eye"></i> </div>
		
	</div>
	</div>

	</div>
		<div class="panel chart">
		<div class="panel-heading"><h4>Graphical View</h4></div>
	
	<div class="panel-body">
	<div class="col-md-12">
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
		            text: 'Weekly visitors'
		        },
		        subtitle: {
		            text: 'Source: bilar.bisu.edu.ph'
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

		});
	</script>