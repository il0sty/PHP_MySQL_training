<?php

session_start();

include_once 'conn.php';
include_once 'AccVerif.php';

$id = $_SESSION ['id_user'];
$sql = "SELECT * FROM contas WHERE id = '$id'";
$result = mysqli_query($dbConnect,$sql);
$user_data = mysqli_fetch_array($result);

if (!empty($_POST['submit'])):

    $new_user = $_POST['new_pass'];
    $conf_user = $_POST['conf_pass'];
    $error = array();

    if ($_POST['actual_pass']!=$user_data['password']):
        $error [] = "Type your correct current password";
    
    else:
        verAcUser($new_pass,$conf_pass,$error);

    endif;

    if (!empty($error)):
        echo "Invalid Password! <br>";
        foreach ($error as $key) {
            echo $key."<br>";
        }

    else:
        $pass_insert = "UPDATE contas SET password = ('$new_pass') WHERE id = '$id'";
        $result = mysqli_query($dbConnect,$pass_insert);
        header('Location: change_password.php');
    endif;

endif;


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
    
    <h1>CHANGE PASSWORD SESSION <hr></h1>
   
    <form name="change_pass" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    
    <label>Insert your actual password: </label>
    <input type="text" name="actual_pass" id="actual_pass" placeholder="User"><br><br>
    <label>Insert your new password: </label>
    <input type="text" name="new_pass" id="new_pass" placeholder="User"><br><br>
    <label>Confirm your new name: </label>
    <input type="text" name="conf_pass" id="conf_pass" placeholder="User"><br><br>
    <input type="submit" value="Confirm" name="submit">
    <a href="./home.php"><input type="button" name="return" value="Retornar"></a>

    </form>



</body>
</html>