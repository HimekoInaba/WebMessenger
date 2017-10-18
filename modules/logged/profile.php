<?php

	if ($connection->connect_error) {
    	die("Connection failed: " . $connection->connect_error);
	}

	$sql = "SELECT id, email, name, surname FROM users";
	$result = $connection->query($sql);
    
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $email = $row["email"];
        $name = $row["name"];
        $surname = $row["surname"];

    }
?>

<h1><?php echo "$name" ."&nbsp;". "$surname"?></h1>
<p class="title"><?php echo "$email" ?></p>
</br><a href="?page=messages&id=<?php echo "$id"?>">My messages</a>
</br></br><a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>