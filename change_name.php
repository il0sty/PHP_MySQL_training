<?php

session_start();

if(!empty($_SESSION['logged'])!= true):
    header('Location: login.php');
endif;

include_once 'conn.php';
include_once 'AccVerif.php';

$id = $_SESSION['id_user'];
$sql = "SELECT * FROM contas WHERE id = '$id'";
$result = mysqli_query($dbConnect,$sql);
$user_data = mysqli_fetch_array($result);

if (!empty($_POST['submit'])):

    $new_name = $_POST['new_name'];
    $conf_name = $_POST['conf_name'];
    
    if ($new_name != $conf_name):
        $error[] = "The confirm name must be the same as name"; 

    else:

        if ($user_data['name']==$new_name):
            $error[] = "Choose a name diferent than your current name";

        endif;

        verAcName($new_name,$error);

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
        <!-- Font Nunito Bold 700 Italic 'font-family: 'Nunito', sans-serif;'-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Change Name Session</title>
</head>
<body>
    
    <div id="top">
        <div id="top_header">
            <h1>CHANGE NAME SESSION<br></h1>
        </div>
    </div>

    <div id="mid">
        <div id="mid_box">
            <?php
                if (!empty($_POST['submit'])):
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
            <h3>Follow these steps to change your name:</h3>
            <div id="mid_content">
                <form name="change_name" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                
                <h4>Your actual name is: <?php echo $user_data['name'] ?></h4>
                <label>Insert your new name: </label>
                <input type="text" name="new_name" id="new_name" placeholder="Name"><br><br>
                <label>Confirm your new name: </label>
                <input type="text" name="conf_name" id="conf_name" placeholder="Name"><br><br>
                <input class="buttom" type="submit" value="Confirm" name="submit">
                <a class="buttom" href="./home.php">Retornar</a>
            </div>
        </div>
    </div>

    </form>

</body>
</html>