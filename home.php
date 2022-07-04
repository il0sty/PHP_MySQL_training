<?php
    
include_once 'conn.php';

session_start();

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
    <title>Document</title>
</head>
<body>
    <h1>LOGGED AS: <?php echo $user_data['name'];?> <hr></h1>
    <h2>Welcome <?php echo $user_data['name'];?>!<br><br></h2>
    <p>You're user is: <strong><?php echo $user_data['user'];?></strong><br></p>
    <p>You're password is: <strong><?php echo $user_data['password'];?></strong><br><hr></p>
    <h3>What do you want to do?<br><br></h3>
    <a href="./change_name.php"><p>Change your name<br></p></a>
    <a href="./change_user.php"><p>Change your user<br></p></a>
    <a href="./change_password.php"><p>Change your password<br></p></a><hr>
    <a href="./logoff.php">Logout</a>


</body>
</html>