<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	$db_server = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "accounts";
	$conn = "";

	try {
	    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
        $conn -> set_charset("utf8mb4");
	} catch(mysqli_sql_exception $e){
		die("DATABASE CONNECTIONFAILED: " . $e->getMessage());
	}


?>
