<?php

$update = ((isset($_GET['action']) AND $_GET['action'] == 'update') OR isset($_SESSION["is_logged"])) ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM pemilik WHERE id_pemilik='$_SESSION[id]'");
	$row = $sql->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE pemilik SET nama='$_POST[nama]', alamat='$_POST[alamat]', telepon='$_POST[telepon]', email='$_POST[email]', username='$_POST[username]', password='".md5($_POST["password"])."' WHERE id_pemilik='$_GET[key]'";
	} else {
		$sql = "INSERT INTO pemilik VALUES (NULL, '$_POST[nama]', '$_POST[alamat]', '$_POST[telepon]', '$_POST[email]', '$_POST[username]', '".md5($_POST["password"])."')";
	}
  if ($connection->query($sql)) {
    echo alert("Berhasil! Silahkan login", "?page=home");
  } else {
		echo alert("Gagal!", "?page=pemilik");
  }
}

if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM pemilik WHERE id_pemilik='$_GET[key]'");
	echo alert("Berhasil!", "?page=pemilik");
}
?>
<div class="container">
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<div class="page-header">
		<?php if ($update): ?>
			<h2>Update <small>data pemilik kost!</small></h2>
		<?php else: ?>
			<h2>Daftar <small>sebegai pemilik kost!</small></h2>
		<?php endif; ?>
	</div>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" name="nama" class="form-control" autofocus="on" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<textarea rows="2" name="alamat" class="form-control"><?= (!$update) ? "" : $row["alamat"] ?></textarea>
				</div>
				<div class="form-group">
					<label for="telepon">No Telp</label>
					<input type="text" name="telepon" class="form-control" <?= (!$update) ?: 'value="'.$row["telepon"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="email">email</label>
					<input type="email" name="email" class="form-control" <?= (!$update) ?: 'value="'.$row["email"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" class="form-control" <?= (!$update) ?: 'value="'.$row["username"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<?php if ($update): ?>
					<div class="row">
							<div class="col-md-10">
								<button type="submit" class="btn btn-warning btn-block">Update</button>
							</div>
							<div class="col-md-2">
								<a href="?page=kriteria" class="btn btn-default btn-block">Batal</a>
							</div>
					</div>
				<?php else: ?>
					<button type="submit" class="btn btn-primary btn-block">Register</button>
				<?php endif; ?>
		</form>
		</div>
		<div class="col-md-2"></div>
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
								$sql = $connection->query("SELECT * FROM kost WHERE id_pemilik=$_SESSION[id]");
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
