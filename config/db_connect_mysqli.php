<?php 

    define('DB_HOST', 'localhost');
    define('DB_NAME', 'duacode_test');
    define('DB_USER', 'albertomm');
    define('DB_PASSWORD', 'Test1234Amm');

	// connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>