<?php

session_start();

include_once 'conn.php';
include_once 'AccVerif.php';

$id = $_SESSION['id_user'];
$sql = "SELECT * FROM contas WHERE id = '$id'";
$result = mysqli_query($dbConnect,$sql);
$user_data = mysqli_fetch_array($result);

if (!empty($_POST['submit'])):

    $new_user = $_POST['new_user'];
    $conf_user = $_POST['conf_user'];
    
    if ($new_name!=$conf_name):
        $error[] = "The confirm name must be the same as name"; 

    else:

        if ($user_data['name']==$new_name):
            $error[] = "Choose a name diferent than your current name";

        endif;

        verAcName($new_name,$error);

    endif;

    if (!empty($error)):
        echo "Invalid Name! <br>";
        foreach ($error as $key) {
            echo $key."<br>";
        }

    else:
        $name_insert = "UPDATE contas SET name = ('$new_name') WHERE id = '$id'";
        $result = mysqli_query($dbConnect,$name_insert);
        header('Location: change_name.php');
    endif;

endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Name Session</title>
</head>
<body>

    <h1>CHANGE NAME SESSION<hr></h1>
    <h3>Follow these steps to change your name</h3>
    <form name="change_name" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    
    <h4>Your actual name is: <?php echo $user_data['name'] ?></h4>
    <label>Insert your new name: </label>
    <input type="text" name="new_name" id="new_name" placeholder="Name"><br><br>
    <label>Confirm your new name: </label>
    <input type="text" name="conf_name" id="conf_name" placeholder="Name"><br><br>
    <input type="submit" value="Confirm" name="submit">
    <a href="./home.php"><input type="button" name="return" value="Retornar"></a>

    </form>

</body>
</html>