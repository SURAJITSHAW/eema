<?php

	// $conn = new mysqli('localhost', 'user_eema', '2]m*`[G**aI/^o=', 'db_eema');
	$conn = new mysqli('localhost', 'root', '', 'eema');



	if ($conn->connect_error) {

	    die("Connection failed: " . $conn->connect_error);

	}

	

?>