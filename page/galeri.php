<?php
if (!isset($_SESSION["is_logged"])) {
	echo alert("Harus login dulu!", "?page=home");
}

$update = (isset($_GET['action']) AND $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM galeri WHERE id_galeri='$_GET[key]'");
	$row = $sql->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$err = false;
	$file = $_FILES['file']['name'];
	if ($update) {
		if ($file) {
			$x = explode('.', $_FILES['file']['name']);
			$file_name = $_SESSION["id"].$_POST["id_kost"].date("dmYHis").".".strtolower(end($x));
			if (! @move_uploaded_file($_FILES['file']['tmp_name'], "assets/img/kost/".$file_name)) {
				echo alert("Upload File Gagal!", "?page=galeri");
				$err = true;
			}
			@unlink("assets/img/kost/".$row["file"]);
		} else {
			$file_name = $row["file"];
		}
	} else {
		if (!$file) {
			echo alert("File gambar tidak ada!", "?page=galeri");
			$err = true;
		}
		$x = explode('.', $_FILES['file']['name']);
		$file_name = $_SESSION["id"].$_POST["id_kost"].date("dmYHis").".".strtolower(end($x));
		if (! @move_uploaded_file($_FILES['file']['tmp_name'], "assets/img/kost/".$file_name)) {
			echo alert("Upload File Gagal!", "?page=galeri");
			$err = true;
		}
	}

	if ($update) {
		$sql = "UPDATE galeri SET id_kost=$_POST[id_kost], judul='$_POST[judul]', file='$file_name' WHERE id_galeri='$_GET[key]'";
	} else {
		$sql = "INSERT INTO galeri VALUES (NULL, '$_POST[id_kost]', '$_POST[judul]', '$file_name')";
	}

	if (!$err) {
	  if ($connection->query($sql)) {
	    echo alert("Berhasil!", "?page=galeri");
	  } else {
			echo alert("Gagal!", "?page=galeri");
	  }
	}
}

if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$query = $connection->query("SELECT file FROM galeri WHERE id_galeri='$_GET[key]'");
	@unlink("assets/img/kost/".$query->fetch_assoc()["file"]);
  $connection->query("DELETE FROM galeri WHERE id_galeri='$_GET[key]'");
	echo alert("Berhasil!", "?page=galeri");
}
?>
<div class="container">
	<div class="page-header">
		<h2>Daftar <small>galeri!</small></h2>
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
		            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<label for="id_kost">Kost</label>
											<select class="form-control" name="id_kost">
												<option>---</option>
												<?php $query = $connection->query("SELECT * FROM kost WHERE id_pemilik=$_SESSION[id]"); while ($data = $query->fetch_assoc()): ?>
													<option value="<?=$data["id_kost"]?>" <?= (!$update) ?: (($data["id_kost"] != $row["id_kost"]) ?: 'selected="on"') ?>><?=$data["nama"]?></option>
												<?php endwhile; ?>
											</select>
										</div>
		                <div class="form-group">
	                    <label for="judul">Judul</label>
	                    <input type="text" name="judul" class="form-control" <?= (!$update) ?: 'value="'.$row["judul"].'"' ?>>
		                </div>
		                <div class="form-group">
	                    <label for="file">File Gambar</label>
	                    <input type="file" name="file" class="form-control">
			                <?php if ($update): ?>
												<span class="help-blokc text-danger">*) kosongkan jika tidak di ubah</span>
											<?php endif; ?>
		                </div>
		                <button type="submit" class="btn btn-<?= ($update) ? "warning" : "info" ?> btn-block">Simpan</button>
		                <?php if ($update): ?>
											<a href="?page=galeri" class="btn btn-info btn-block">Batal</a>
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
		                        <th>Gambar</th>
		                        <th></th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <?php $no = 1; ?>
		                    <?php if ($query = $connection->query("SELECT * FROM galeri JOIN kost USING(id_kost) WHERE id_pemilik=$_SESSION[id]")): ?>
		                        <?php while($row = $query->fetch_assoc()): ?>
		                        <tr>
		                            <td><?=$no++?></td>
		                            <td><?=$row['nama']?></td>
		                            <td><?=$row['judul']?></td>
		                            <td><a href="assets/img/kost/<?=$row['file']?>" class="btn btn-info btn-xs fancybox">Lihat</a></td>
		                            <td>
		                                <div class="btn-group">
		                                    <a href="?page=galeri&action=update&key=<?=$row['id_galeri']?>" class="btn btn-warning btn-xs">Edit</a>
		                                    <a href="?page=galeri&action=delete&key=<?=$row['id_galeri']?>" class="btn btn-danger btn-xs">Hapus</a>
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
<script type="text/javascript">
$(document).ready(function(){
	$(".fancybox").fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		iframe : {
			preload: false
		}
	});
	$(".various").fancybox({
		maxWidth    : 800,
		maxHeight    : 600,
		fitToView    : false,
		width        : '70%',
		height        : '70%',
		autoSize    : false,
		closeClick    : false,
		openEffect    : 'none',
		closeEffect    : 'none'
	});
	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});
});
</script>
