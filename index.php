<?php require_once("config.php"); ?>
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
              <a href="?page=daftar" class="btn btn-primary">Register</a>
            </span>
          </div>
        <?php else: ?>
          <a href="logout.php" class="btn btn-default">Logout</a>
        <?php endif; ?>
        </form>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <?php include page($_PAGE); ?>
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
