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

    $new_user = $_POST['new_user'];
    $conf_user = $_POST['conf_user'];
    $error = array();
    
    if ($new_user!=$conf_user):
        $error[] = "The confirm user must be the same as name"; 

    else:

        verAcUser($new_user,$dbConnect,$error);

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
            <h1>CHANGE USER SESSION</h1>
        </div>
    </div>
    
    <div id="mid">
        <div id="mid_box">
            <?php
                if(!empty($_POST['submit'])):
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
            <h3>Your actual user is: <?php echo $user_data['user'] ?></h4>
            <div id="mid_content">
                <form name="change_pass" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <label>Insert your new user: </label>
                    <input type="text" name="new_user" id="new_user" placeholder="User"><br><br>
                    <label>Confirm your new user: </label>
                    <input type="text" name="conf_user" id="conf_user" placeholder="User"><br><br>
                    <input class="buttom" type="submit" value="Confirm" name="submit">
                    <a class="buttom" href="./home.php">Return</a>
                </form>
            </div>
        </div>
    </div>



</body>
</html>