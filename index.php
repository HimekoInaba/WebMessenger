<?php
    
    include 'init/db.php';
    include 'init/user.php';
    include 'init/init.php';

    if(isset($_GET['act'])){

            if(USER_ONLINE){

                if($_GET['act']=='logout'){
                    
                    session_destroy();
                    header("Location:?page=home");

                }

                if($_GET['act']=='send_message'){

                    $message = $_POST['message'];
                    $receiver_id = $_GET['id'];

                    $sql_query = "
                        INSERT INTO messages (id, user_id, receiver_id, message, sent_date, user_deleted, receiver_deleted) 
                        VALUES (NULL, ".$USER_DATA->id.", ".$receiver_id.",
                        $message, NOW(), 0, 0 )
                    ";

                    $connection->query($sql_query);

                    header("Location:?page=userprofile&id=$receiver_id");
                    echo "Your message is sent!";
                }
            }else{

                if($_GET['act']=='auth'){
            
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $sql_query = " SELECT * FROM users 
                          WHERE active = 1 
                          AND email = \"".$email."\" 
                          AND password = SHA1(\"".$password."\")
                        ";
                    
                    $query = $connection->query($sql_query);

                    if($row = $query->fetch_object()){

                        $_SESSION['user'] = $row;
                        header("Location:?page=profile");

                    }else{
                        header("Location:?page=home&error=1");
                    }

                }

                if($_GET['act'] == 'register'){

                    if(isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['repassword'])&&isset($_POST['name'])&&isset($_POST['surname'])){

                        if($_POST['password']==$_POST['repassword']){

                            $sql_text = "SELECT email, name, surname FROM users WHERE email = \"".$_POST['email']."\" AND password = SHA1(\"".$_POST['password']."\")";
        
                            $query = $connection->query($sql_text);
                            if($row = $query->fetch_object()){
                                header("Location:?page=register&error=1");
                            }else{

                                $sql_text = "
                                        INSERT INTO users (id,email,password,name, surname, active)
                                        VALUES (NULL, \"".$_POST['email']."\", SHA1(\"".$_POST['password']."\"), \"".$_POST['name']."\", \"".$_POST['surname']."\", 1)
                                    ";

                                $query = $connection->query($sql_text);

                                header("Location:?page=home");
                            }
                        }
                    }else{
                        header("Location:?page=register&error=1");
                    }   
                }
            }
    }
    else{

        if(USER_ONLINE){

            $page='loggedhome';

            if(isset($_GET['page'])){

                 if($_GET['page']=='loggedhome'){

                    $page = 'loggedhome';

                }

                if($_GET['page']=='profile'){

                    $page = 'profile';

                }

                if($_GET['page'] =='userlist'){

                    $page='userlist';

                }

                if($_GET['page']=='userprofile'){

                    if(isset($_GET['id'])&&is_numeric($_GET['id'])){ 

                        $page = 'userprofile';
                        $user_id = $_GET['id'];
                    }
                }

                if($_GET['page'] == 'result'){

                    $page = 'result';
                    $searchLine = $_POST['search'];

                }

                if($_GET['page']=='messages'){

                    $page = 'messages';
                    $myId = $_GET['id'];

                }

            }

        }
        else{

            $page = 'home';

             if(isset($_GET['page'])){

                if($_GET['page']=='home'){

                    $page = 'home';

                }

                if($_GET['page']=='register'){

                    $page = 'register';

                }
            }
        }
    }



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>
<?php
    if(USER_ONLINE){
?>
    <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="?page=loggedhome">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="?page=profile">Profle</a>
                    </li>
                    <li>
                        <a href="?page=userlist">List of all users</a>
                    </li>
                    <li>
                        <a href="?act=logout">Logout</a>
                    </li>
                    <li>
                        <form action="?page=result" method="POST">
                            <input type="text" name="search" placeholder="Find a user"/>
                            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1"/>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->
        
<?php
    }else{
?>
            <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="?page=home">
                            Home page
                        </a>
                    </li>
                    <li>
                        <a href="?page=home">Login</a>
                    </li>
                    <li>
                        <a href="?page=register">Register</a>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->
<?php
    }
?>

        <?php

            include 'modules/'.(USER_ONLINE?'logged':'notlogged').'/'.$page.'.php';

          ?>

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
