<?php
	if ($connection->connect_error) {
    	die("Connection failed: " . $connection->connect_error);
	}

	$query = $connection->query("SELECT id, email, name, surname FROM users WHERE email LIKE '%$searchLine%' OR name LIKE '%$searchLine%' OR surname LIKE '%$searchLine%' OR id LIKE '%$searchLine%'");

	$i = 0;

	echo '<table>';
	while($row = $query->fetch_object()){
		$i++;
	    echo '<tr>
		        <td><a href=?page=userprofile&id='.$row->id.'>'.$i.")".$row->name."&nbsp;".$row->surname."&nbsp;".$row->email.'</a></td>
		      </tr>';
		
	}
	echo '</table>';
?>
</br><a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>