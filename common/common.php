<?php
	
    $db_host = "localhost";
	$db_user = "pi";
	$db_passwd = "oceiot08";
	$db = "pi";

	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');

    function create_connection() {
		global $db_host, $db_user, $db_passwd, $db;
		$mysqli = new mysqli($db_host, $db_user, $db_passwd, $db);
		$mysqli->set_charset("utf8");
		return $mysqli;
	}
?>
