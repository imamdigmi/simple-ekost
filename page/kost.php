<?php
if (!isset($_SESSION["is_logged"])) {
	echo alert("Harus login dulu!", "?page=home");
}

$update = (isset($_GET['action']) AND $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM kost WHERE id_kost='$_GET[key]'");
	$row = $sql->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE kost SET id_pemilik='$_POST[id_pemilik]', nama='$_POST[nama]', alamat='$_POST[alamat]', latitude='$_POST[latitude]', longitude='$_POST[longitude]', tersedia='$_POST[tersedia]', status='$_POST[status]', fasilitas='$_POST[fasilitas]', harga_3bulan='$_POST[harga_3bulan]', harga_6bulan='$_POST[harga_6bulan]', harga_pertahun='$_POST[harga_pertahun]' WHERE id_kost='$_GET[key]'";
	} else {
		$sql = "INSERT INTO kost VALUES (NULL, '$_POST[id_pemilik]', '$_POST[nama]', '$_POST[alamat]', '$_POST[latitude]', '$_POST[longitude]', '$_POST[tersedia]', '$_POST[status]', '$_POST[fasilitas]', '$_POST[harga_3bulan]', '$_POST[harga_6bulan]', '$_POST[harga_pertahun]', NULL)";
	}
  if ($connection->query($sql)) {
    echo alert("Berhasil!", "?page=kost");
  } else {
		echo alert("Gagal!", "?page=kost");
  }
}

if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM kost WHERE id_kost='$_GET[key]'");
	echo alert("Berhasil!", "?page=kost");
}
?>
<div class="container">
	<div class="page-header">
		<h2>Daftar <small>kost!</small></h2>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="map" style="width:100%; height:300px"></div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
		    <div class="panel panel-<?= ($update) ? "warning" : "info" ?>">
		        <div class="panel-heading"><h3 class="text-center"><?= ($update) ? "EDIT" : "TAMBAH" ?></h3></div>
		        <div class="panel-body">
		            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
										<input type="hidden" name="id_pemilik" value="<?=$_SESSION["id"]?>">
		                <div class="form-group">
	                    <label for="nama">Nama</label>
	                    <input type="text" name="nama" class="form-control" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?>>
		                </div>
		                <div class="form-group">
	                    <label for="alamat">Alamat</label>
	                    <input type="text" name="alamat" class="form-control" <?= (!$update) ?: 'value="'.$row["alamat"].'"' ?>>
		                </div>
		                <div class="form-group">
	                    <label for="latitude">Latitude</label>
	                    <input type="hidden" id="latitude1" name="latitude" <?= (!$update) ?: 'value="'.$row["latitude"].'"' ?>>
											<input type="text" id="latitude2" class="form-control" disabled <?= (!$update) ?: 'value="'.$row["latitude"].'"' ?>>
		                </div>
		                <div class="form-group">
	                    <label for="longitude">Longitude</label>
											<input type="hidden" id="longitude1" name="longitude" <?= (!$update) ?: 'value="'.$row["longitude"].'"' ?>>
											<input type="text" id="longitude2" class="form-control" disabled <?= (!$update) ?: 'value="'.$row["longitude"].'"' ?>>
		                </div>
		                <div class="form-group">
	                    <label for="tersedia">Kamar Tersedia</label>
	                    <input type="text" name="tersedia" class="form-control" <?= (!$update) ?: 'value="'.$row["tersedia"].'"' ?>>
		                </div>
		                <div class="form-group">
	                    <label for="status">Status</label>
											<select class="form-control" name="status">
												<option>---</option>
												<option value="Laki-laki" <?= (!$update) ?: (($row["status"] != "Laki-laki") ?: 'selected="on"') ?>>Laki-laki</option>
												<option value="Perempuan" <?= (!$update) ?: (($row["status"] != "Perempuan") ?: 'selected="on"') ?>>Perempuan</option>
											</select>
		                </div>
		                <div class="form-group">
	                    <label for="fasilitas">Fasilitas</label>
											<textarea name="fasilitas" rows="3" class="form-control"><?= ($update) ? $row["tersedia"] : "" ?></textarea>
		                </div>
		                <div class="form-group">
	                    <label for="harga_3bulan">Harga/3bln</label>
	                    <input type="text" name="harga_3bulan" class="form-control" <?= (!$update) ?: 'value="'.$row["harga_3bulan"].'"' ?>>
		                </div>
		                <div class="form-group">
	                    <label for="harga_6bulan">Harga/6bln</label>
	                    <input type="text" name="harga_6bulan" class="form-control" <?= (!$update) ?: 'value="'.$row["harga_6bulan"].'"' ?>>
		                </div>
		                <div class="form-group">
	                    <label for="harga_pertahun">Harga Pertahun</label>
	                    <input type="text" name="harga_pertahun" class="form-control" <?= (!$update) ?: 'value="'.$row["harga_pertahun"].'"' ?>>
		                </div>
		                <button type="submit" class="btn btn-<?= ($update) ? "warning" : "info" ?> btn-block">Simpan</button>
		                <?php if ($update): ?>
											<a href="?page=kost" class="btn btn-info btn-block">Batal</a>
										<?php endif; ?>
		            </form>
		        </div>
		    </div>
		</div>
		<div class="col-md-8">
		    <div class="panel panel-info">
		        <div class="panel-heading"><h3 class="text-center">DAFTAR</h3></div>
		        <div class="panel-body">
		            <table class="table table-condensed">
		                <thead>
		                    <tr>
		                        <th>No</th>
														<th>Nama</th>
		                        <th>Tersedia</th>
		                        <th>Harga/3bln</th>
		                        <th>Harga/6bln</th>
		                        <th>Harga Pertahun</th>
		                        <th>Alamat</th>
		                        <th></th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <?php $no = 1; ?>
		                    <?php if ($query = $connection->query("SELECT * FROM kost WHERE id_pemilik=$_SESSION[id]")): ?>
		                        <?php while($row = $query->fetch_assoc()): ?>
		                        <tr>
		                            <td><?=$no++?></td>
		                            <td><?=$row['nama']?></td>
		                            <td><?=$row['tersedia']?></td>
		                            <td><?=$row['harga_3bulan']?></td>
		                            <td><?=$row['harga_6bulan']?></td>
		                            <td><?=$row['harga_pertahun']?></td>
		                            <td><?=$row['alamat']?></td>
		                            <td>
		                                <div class="btn-group">
		                                    <a href="?page=kost&action=update&key=<?=$row['id_kost']?>" class="btn btn-warning btn-xs">Edit</a>
		                                    <a href="?page=kost&action=delete&key=<?=$row['id_kost']?>" class="btn btn-danger btn-xs">Hapus</a>
		                                </div>
		                            </td>
		                        </tr>
		                        <?php endwhile ?>
		                    <?php endif ?>
		                </tbody>
		            </table>
		        </div>
		    </div>
		</div>
	</div>
</div>
