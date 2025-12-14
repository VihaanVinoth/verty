<?php
	include("~/verty/database/db.php");
	$sql = "SELECT * FROM users WHERE user = 'vertri'";
	$result = mysqpli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		echo $row["id"] . "<br>";
	}
	else {
	     echo "No user found";
	}

	mysqli_close($conn);
?>