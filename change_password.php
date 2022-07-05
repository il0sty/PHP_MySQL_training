<?php

session_start();

include_once 'conn.php';
include_once 'AccVerif.php';

if(!empty($_SESSION['logged'])!= true):
    header('Location: login.php');
endif;

$id = $_SESSION ['id_user'];
$sql = "SELECT * FROM contas WHERE id = '$id'";
$result = mysqli_query($dbConnect,$sql);
$user_data = mysqli_fetch_array($result);

if (!empty($_POST['submit'])):

    $new_pass = $_POST['new_pass'];
    $conf_pass = $_POST['conf_pass'];
    $error = array();

    if ($_POST['actual_pass']!=$user_data['password']):
        $error [] = "Type your correct current password";
    
    else:
        verAcPass($new_pass,$conf_pass,$error);

    endif;

endif;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css"/>
        <!-- Font Nunito 'font-family: 'Nunito', sans-serif;'-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <div id="top">
        <div id="top_header">
            <h1>CHANGE PASSWORD SESSION <br></h1>
        </div>
    </div>
   

    <div id="mid">
        <div id="mid_box">
            <?php        
                if (!empty($_POST['submit'])):
                    if (!empty($error)):
                        echo "Invalid Password! <br>";
                        foreach ($error as $key) {
                            echo $key."<br>";
                        }
                        echo "<br>";
                
                    else:
                        $pass_insert = "UPDATE contas SET password = ('$new_pass') WHERE id = '$id'";
                        $result = mysqli_query($dbConnect,$pass_insert);
                        header('Location: change_password.php');
                    endif;
                endif;
            ?>

            <div id="mid_content">
                <form name="change_pass" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        
                <label>Insert your actual password: </label>
                <input type="password" name="actual_pass" id="actual_pass" placeholder="Actual Password"><br><br>
                <label>Insert your new password: </label>
                <input type="password" name="new_pass" id="new_pass" placeholder="New Password"><br><br>
                <label>Confirm your new name: </label>
                <input type="password" name="conf_pass" id="conf_pass" placeholder="Confirm New Password"><br><br>
                <input class="buttom" type="submit" value="Confirm" name="submit">
                    <a class="buttom" href="./home.php">Retornar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>