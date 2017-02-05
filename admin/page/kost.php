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
		<div class="col-md-12">
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
		                        <th></th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <?php $no = 1; ?>
		                    <?php if ($query = $connection->query("SELECT * FROM kost")): ?>
		                        <?php while($row = $query->fetch_assoc()): ?>
		                        <tr>
		                            <td><?=$no++?></td>
		                            <td><?=$row['nama']?></td>
		                            <td><?=$row['tersedia']?></td>
		                            <td><?=$row['harga_3bulan']?></td>
		                            <td><?=$row['harga_6bulan']?></td>
		                            <td><?=$row['harga_pertahun']?></td>
		                            <td>
																	<a href="?page=kost&action=detail&key=<?=$row['id_kost']?>" class="btn btn-info btn-xs">Detail</a>
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
