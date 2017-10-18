<?php


	if ($connection->connect_error) {
    	die("Connection failed: " . $connection->connect_error);
	}

	$sql = "SELECT id, email, name, surname FROM users WHERE id = $user_id";
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

Write here your message to <?php echo "$name"; ?>
<form action = "?act=send_message&id=<?php echo "$id"?>" method="POST">
        <table cellpadding="5">
          <tr>
            <td colspan="2">
              <textarea style="width:210%; height:100px;" name="message"></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="submit" value = "Send">
            </td>
          </tr>
        </table>
      </form>
</br><a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>