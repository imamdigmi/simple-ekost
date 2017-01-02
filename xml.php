<?php

require("config.php");

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Select all the rows in the markers table
if (!$query = $connection->query("SELECT * FROM kost")) {
  die('Invalid query: ' . $connection->error);
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = $query->fetch_assoc()){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("nama",$row['nama']);
  $newnode->setAttribute("alamat", $row['alamat']);
  $newnode->setAttribute("latitude", $row['latitude']);
  $newnode->setAttribute("longitude", $row['longitude']);
  $newnode->setAttribute("tersedia", $row['tersedia']);
  $newnode->setAttribute("status", $row['status']);
  $newnode->setAttribute("harga_3bulan", $row['harga_3bulan']);
  $newnode->setAttribute("harga_6bulan", $row['harga_6bulan']);
  $newnode->setAttribute("harga_pertahun", $row['harga_pertahun']);
}

echo $dom->saveXML();
