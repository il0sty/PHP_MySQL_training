<?php

session_start();

include_once 'conn.php';
include_once 'AccVerif.php';

$id = $_SESSION ['id_user'];
$sql = "SELECT * FROM contas WHERE id = '$id'";
$result = mysqli_query($dbConnect,$sql);
$user_data = mysqli_fetch_array($result);

if (!empty($_POST['submit'])):

    $new_user = $_POST['new_user'];
    $conf_user = $_POST['conf_user'];
    $error = array();
    
    if ($new_user!=$conf_user):
        $error[] = "The confirm user must be the same as name"; 

    else:

        verAcUser($new_user,$dbConnect,$error);

    endif;

    if (!empty($error)):
        echo "Invalid User! <br>";
        foreach ($error as $key) {
            echo $key."<br>";
        }

    else:
        $user_insert = "UPDATE contas SET user = ('$new_user') WHERE id = '$id'";
        $result = mysqli_query($dbConnect,$user_insert);
        header('Location: change_user.php');
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
    
    <h1>CHANGE USER SESSION <hr></h1>
   
    <form name="change_pass" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    
    <h4>Your actual user is: <?php echo $user_data['user'] ?></h4>
    <label>Insert your new user: </label>
    <input type="text" name="new_user" id="new_user" placeholder="User"><br><br>
    <label>Confirm your new user: </label>
    <input type="text" name="conf_user" id="conf_user" placeholder="User"><br><br>
    <input type="submit" value="Confirm" name="submit">
    <a href="./home.php"><input type="button" name="return" value="Retornar"></a>

    </form>



</body>
</html>