<?php if (empty($_SESSION) AND isset($_SESSION["as"]) != "admin"): ?>
	<div id="map_canvas" style="width:100%; height:500px"></div>
<?php endif; ?>
<div class="container">
	<h2>Cari kost!</h2>
	<!-- search -->
	<div class="row">
		<form action="">
			<div class="col-md-7">
				<label for="nama" class="control-label">Nama</label>
				<input type="text" name="nama" class="form-control">
			</div>
			<div class="col-md-5">
				<label for="">Harga</label>
				<div class="input-group">
					<span class="input-group-addon" style="border-right: 0;">Min</span>
					<input type="text" name="harga_min" class="form-control" value="0">
					<span class="input-group-addon" style="border-left: 0; border-right: 0;">Max</span>
					<input type="text" name="harga_max" class="form-control" value="0">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary">Cari...</button>
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
						<th>Harga</th>
						<th>Status</th>
						<th>Jumlah kamar</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>#</td>
						<td>Kost azizah</td>
						<td>Rp.90.000/bln</td>
						<td><span class="label label-success">Tersedia</span></td>
						<td>5</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
