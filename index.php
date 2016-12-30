<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>eKost</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
  <link href="assets/css/jumbotron.css" rel="stylesheet">
  <script src="assets/js/ie-emulation-modes-warning.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_2mV5EiGV6fw_mIPg7H885e1eocyaAxc&callback=initMap"></script>
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="baseMap()">
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">eKost Yogyakarta</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <form class="navbar-form navbar-right">
          <?php if (empty($_SESSION)): ?>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="username">
            <span class="input-group-addon" style="border-left: 0; border-right: 0;"></span>
            <input type="password" class="form-control" placeholder="password" />
            <span class="input-group-btn">
              <button class="btn btn-success" type="button">Login</button>
            </span>
          </div>
        <?php else: ?>
          <a href="logout.php" class="btn btn-default">Logout</a>
        <?php endif; ?>
        </form>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div id="map_canvas" style="width:100%; height:500px"></div>
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
  <div class="container">
    <hr>
    <footer>
      <p>&copy; 2016 eKost, Inc.</p>
    </footer>
  </div> <!-- /container -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  <script src="assets/js/maps.js"></script>
</body>
</html>
