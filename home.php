<?php
    
include_once 'conn.php';

session_start();

if(!empty($_SESSION['logged'])!= true):
    header('Location: login.php');
endif;

$id = $_SESSION['id_user'];
$sql = "SELECT * FROM contas WHERE id = '$id'";
$result = mysqli_query($dbConnect,$sql);
$user_data = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div LINKS>
        <link rel="stylesheet" href="./styles.css"/>
        <!-- Font Nunito Bold 700 Italic 'font-family: 'Nunito', sans-serif;'-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,700;1,800;1,900&display=swap" rel="stylesheet">

    </div>
    <title>Document</title>
</head>
<body>
    <div id="top">
        <div id="top_header">
            <h1>LOGGED AS:  <em class="user_info"> <?php echo $user_data['user'];?> </em></h1>
        </div>
    </div>
    <div id="mid">
        <div id="mid_box">    
            <div id="mid_content">
                <div id="mid-top">
                    <div id="show_user_info">
                        <h2>Welcome, <em class="user_info"><?php echo $user_data['name'];?>!</em> <br> <br> </h2>
                        <div id="user_info">
                            <p>You're user is: <em  class="user_info"><?php echo $user_data['user'];?> </em> <br> </p>
                            <p>You're password is: <em class="user_info"><?php echo $user_data['password'];?></em> <br> </p>
                        </div>
                    </div>
                </div>

                <br>
                <div id="mid-bottom">
                    <div id="options">
                        <h3>What do you want to do?<br><br></h3>
                        <p>
                            <a class = "link" href="./change_name.php">Change your name</a>
                            <a class = "link" href="./change_user.php">Change your user</a>
                            <br><br>
                            <a class = "link" href="./change_password.php">Change your password<br></a><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="bottom">
        <a class = "link" href="./logoff.php">Logout</a>
    </div>


</body>
</html>