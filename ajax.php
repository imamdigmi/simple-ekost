<?php

require_once "config.php";

if ($query = $connection->query("SELECT pengunjung FROM kost WHERE id_kost=$_POST[id]")) {
	if (!$connection->query("UPDATE kost SET pengunjung=".$query->fetch_assoc()["pengunjung"]."+1 WHERE id_kost=$_POST[id]")) {
		echo json_encode(["error" => "true"]);
	}
} else {
	echo json_encode(["error" => "true"]);
}
echo json_encode(["error" => "false"]);
