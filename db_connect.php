<?php
	define('SERVERNAME', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', '');
	define('DATABASE','library_system');
	$Base_url = 'http://localhost/PHP-PRACTICAL/SELF_LIBRARY_SYSTEM';
	$con = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE);
	if (!$con) {
        die('Error'. mysqli_connect_error());
    }
    // else{
    //     echo 'Connection was successful';
    // }
?>