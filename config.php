<?php

/**
 * Database connection setup
 */
// if (!$connection = new Mysqli("localhost", "root", "idiot", "ekost")) {
if (!$connection = new Mysqli("mysql.idhostinger.com", "u478082407_kost", "ekost123", "u478082407_kost")) {
  echo "<h3>ERROR: Koneksi database gagal!</h3>";
}

/**
 * Page initialize
 */
if (isset($_GET["page"])) {
  $_PAGE = $_GET["page"];
} else {
  $_PAGE = "home";
}

/**
 * Page setup
 * @param page
 * @return page filename
 */
function page($page) {
  return "page/" . $page . ".php";
}

/**
 * Alert notification
 * @param message, redirection
 * @return alert notify
 */
function alert($msg, $to = null) {
  $to = ($to) ? $to : $_SERVER["PHP_SELF"];
  return "<script>alert('{$msg}');window.location='{$to}';</script>";
}
