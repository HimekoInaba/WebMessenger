<?php

	if ($connection->connect_error) {
    	die("Connection failed: " . $connection->connect_error);
	}

    $sql = "
            SELECT m.id, m.receiver_id, m.messages, m.sent_date, 
            u.name, u.surname, u.email
            FROM messages m LEFT OUTER JOIN users u ON u.id = b.receiver_id
            WHERE m.user_deleted = 0 
            ORDER BY m.sent_date DESC
            ";

	$result = $connection->query($sql);
    $i = 0;
    
    echo '<table>';
    while($row = $result->fetch_assoc()) {
        $i++;
        echo '<tr>
            <td><a href=?page=userprofile&id='.$row->id.'>'.$i.")".$row->name."&nbsp;".$row->surname."&nbsp;".$row->email."&nbsp;".$row->message."&nbsp;".$row->sent_date.'</a></td>
            </tr>'; 
    }
    echo '</table>';
?>

</br></br><a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
