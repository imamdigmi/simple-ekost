<div id="map" style="width:100%; height:500px"></div>
<div class="container">
	<h2>Cari kost!</h2>
	<!-- search -->
	<div class="row">
		<form action="<?=$_SERVER["REQUEST_URI"]?>">
				<input type="hidden" name="searched" value="true">
				<div class="col-md-5">
					<label for="nama" class="control-label">Nama</label>
					<input type="text" name="nama" id="nama" class="form-control">
				</div>
				<div class="col-md-3">
					<label for="status" class="control-label">Status</label>
					<select class="form-control" name="status" id="status">
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="">Harga</label>
					<div class="input-group">
						<span class="input-group-addon" style="border-right: 0;">Min</span>
						<input type="number" name="min" id="min" class="form-control" value="0">
						<span class="input-group-addon" style="border-left: 0; border-right: 0;">Max</span>
						<input type="number" name="max" id="max" class="form-control" value="0">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary" id="submit">Cari...</button>
						</span>
					</div>
				</div>
		</form>
	</div>
	<hr>
	<!-- /search -->
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover">
				<?php $query = $connection->query("SELECT a.nama, b.nama AS pemilik, a.alamat, a.tersedia, a.status, a.harga_3bulan, a.harga_6bulan, a.harga_pertahun, a.fasilitas, a.pengunjung FROM kost a JOIN pemilik b USING(id_pemilik) WHERE id_kost=$_GET[key]"); while ($row = $query->fetch_assoc()): ?>
					<tr>
						<th>Nama Kost</th>
						<td>: <?=$row["nama"]?></td>
					</tr>
					<tr>
						<th>Pemilik</th>
						<td>: <?=$row["pemilik"]?></td>
					</tr>
					<tr>
						<th>Alamat</th>
						<td>: <?=$row["alamat"]?></td>
					</tr>
					<tr>
						<th>Kamar Tersedia</th>
						<td>: <?=$row["tersedia"]?></td>
					</tr>
					<tr>
						<th>Kost Untuk</th>
						<td>: <?=$row["status"]?></td>
					</tr>
					<tr>
						<th>Harga per 3 bulan</th>
						<td>: <?=$row["harga_3bulan"]?></td>
					</tr>
					<tr>
						<th>Harga per 6 bulan</th>
						<td>: <?=$row["harga_6bulan"]?></td>
					</tr>
					<tr>
						<th>Harga pertahun</th>
						<td>: <?=$row["harga_pertahun"]?></td>
					</tr>
					<tr>
						<th>Fasilitas</th>
						<td>: <?=$row["fasilitas"]?></td>
					</tr>
					<tr>
						<th>Total Pengunjung</th>
						<td>: <?=$row["pengunjung"]?></td>
					</tr>
				<?php endwhile; ?>
			</table>
		</div>
	</div>

	<div class="row">
		<?php $query = $connection->query("SELECT judul, file FROM galeri WHERE id_kost=$_GET[key]"); while ($row = @$query->fetch_assoc()): ?>
			<div class="col-xs-6 col-md-3">
		    <a href="assets/img/kost/<?=$row['file']?>" class="thumbnail fancybox">
		      <img src="assets/img/kost/<?=$row['file']?>" alt="<?=$row['judul']?>">
		    </a>
		  </div>
		<?php endwhile; ?>
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
