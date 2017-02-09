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
			<table class="table table-hover table-condensed table-responsive">
				<thead>
					<tr>
						<th>#</th>
						<th>Nama</th>
						<th>Harga/3bln</th>
						<th>Harga/6bln</th>
						<th>Harga/tahun</th>
						<th>Status</th>
						<th>Kamar Tersedia</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (isset($_GET["searched"])) {
						if ($_GET["searched"] == "click") {
							$query = $connection->query("SELECT * FROM kost a WHERE id_kost=$_GET[key]");
						} else {
							$query = $connection->query("SELECT * FROM kost a WHERE nama LIKE '%$_GET[nama]%' AND status='$_GET[status]' AND (a.`harga_pertahun` BETWEEN $_GET[min] AND $_GET[max])");
						}
					} else {
						$query = $connection->query("SELECT * FROM kost ORDER BY harga_3bulan, harga_6bulan, harga_pertahun");
					}
					$no = 1;
					?>
					<?php while ($row = $query->fetch_assoc()): ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$row["nama"]?></td>
							<td>Rp.<?=$row["harga_3bulan"]?>,-</td>
							<td>Rp.<?=$row["harga_6bulan"]?>,-</td>
							<td>Rp.<?=$row["harga_pertahun"]?>,-</td>
							<td><span class="label label-<?=($row["status"] == "Perempuan") ? "info" : "primary"?>"><?=$row["status"]?></span></td>
							<td><?=$row["tersedia"]?></td>
							<td><a href="?searched=click&key=<?=$row["id_kost"]?>" class="btn btn-success btn-xs">Lihat maps</a></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
