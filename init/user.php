<?php
	 
	session_start();
	$USER_DATA = null;

	if(isset($_SESSION['user'])){

		$query = $connection->query("
			SELECT * FROM users 
			WHERE active = 1 
			AND email = \"".$_SESSION['user']->email."\" 
			AND password = \"".$_SESSION['user']->password."\" 
		");

		if($row = $query->fetch_object()){

			$USER_DATA = $row;

			define("USER_ONLINE", true);

		}else{

			define("USER_ONLINE", false);

		}

	}else{

		define("USER_ONLINE", false);

	}

?>