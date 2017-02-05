<div class="container">
	<br>
	<div class="alert alert-success" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Selamat Datang!</strong> Admin di dashboard panel eKost.
	</div>
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>

<script type="text/javascript">
$(function () {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Pengunjung'
        },
        subtitle: {
            text: 'eKost Yogyakarta'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rata-rata'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total pengunjung <b>{point.y:.1f}</b>'
        },
        series: [{
            name: 'Population',
            data: [
							<?php
								$data = "";
								$sql = $connection->query("SELECT * FROM kost");
								while ($row = $sql->fetch_assoc()) {
									$data .= "['".$row["nama"]."', ".$row["pengunjung"]."],";
								}
								echo rtrim($data, ',');
							?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>
