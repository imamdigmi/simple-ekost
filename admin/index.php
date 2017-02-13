<?php require_once("../config.php"); session_start();
if (!isset($_SESSION["admin"])) {
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>eKost</title>
  <script type="text/javascript">
    var IsDraggable = <?=$is=(isset($_GET["page"])) ? (($_GET["page"] == "home") ? "false" : "true") : "false"?>;
  </script>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
  <link href="../assets/css/jumbotron.css" rel="stylesheet">
  <script src="../assets/js/ie-emulation-modes-warning.js"></script>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUVLvtnzVU-tDQgUidVsAbHAGEr3VNer4&callback=initMap"></script>
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="initialize()">
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: white;">eKost Yogyakarta</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="?page=pemilik">Pemilik</a></li>
                <li><a href="?page=kost">Kost</a></li>
              </ul>
            </li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <?php include page($_PAGE); ?>
  <div class="container">
    <hr>
    <footer>
      <p>&copy; 2017 eKost Yogyakarta.</p>
    </footer>
  </div> <!-- /container -->
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
  <script src="../assets/js/maps.js"></script>
  <script type="text/javascript">
    var markerImage = 'assets/img/marker.png';
    var myCurrentLocationMarker = 'assets/img/mylocation-marker.png';
  </script>
</body>
</html>
