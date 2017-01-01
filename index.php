<?php require_once("config.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST["login"])) {
    $sql = "SELECT * FROM pemilik WHERE username='$_POST[username]' AND password='".md5($_POST["password"])."'";
    if ($query = $connection->query($sql)) {
        if ($query->num_rows) {
            while ($data = $query->fetch_array()) {
              $_SESSION["as"] = "pemilik";
              $_SESSION["id"] = $data["id_pemilik"];
              $_SESSION["nama"] = $data["nama"];
              $_SESSION["username"] = $data["username"];
            }
            header('location: ?page=home');
        } else {
            echo alert("Username / Password tidak sesuai!", "index.php");
        }
    } else {
        echo "Query error!";
    }
}
?>
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
        <a class="navbar-brand" href="index.php" style="color: white;">eKost Yogyakarta</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <?php if (!isset($_SESSION)): ?>
          <form class="navbar-form navbar-right" action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
              <div class="input-group">
                <input type="text" name="username" class="form-control" placeholder="username">
                <span class="input-group-addon" style="border-left: 0; border-right: 0;"></span>
                <input type="password" name="password" class="form-control" placeholder="password">
                <span class="input-group-btn">
                  <button class="btn btn-success" type="submit">Login</button>
                  <a href="?page=pemilik" class="btn btn-primary">Register</a>
                </span>
              </div>
              <input type="hidden" name="login" value="true">
          </form>
        <?php else: ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$_SESSION["nama"]?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="?page=pemilik">Profil</a></li>
                <li><a href="?page=kost">Daftar Kost</a></li>
              </ul>
            </li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        <?php endif; ?>
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
  <script type="text/javascript">
    var markerImage = 'assets/img/marker.png';
  </script>
</body>
</html>
