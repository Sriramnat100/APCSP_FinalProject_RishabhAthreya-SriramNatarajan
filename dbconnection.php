<?php
	function connectPostsDB() {
		// var_dump($_ENV);

		// DB CONFIG
		$servername = "localhost";
		$username = "root";
		$password = "St@rf2mily";
	
		// Create connection
		$conn = new mysqli($servername, $username, $password, "gaysp_project");
	
		// Check connection
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
		// else echo "Success";

		return $conn;
	}
?>