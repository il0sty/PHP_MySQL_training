<?php

    include_once 'acc_manage.php';
    include_once 'conn.php';

    session_start();

    if (!empty($_SESSION['logged']) && $_SESSION['logged'] == true):
        header("Location: home.php");
    
    else:

        if (!empty($_POST['login'])):
            $login = $_POST['user'];
            $password = $_POST['password'];

            if (empty($login)): //check if user and pass are filled
                $messages[] = "User must be filled <br>";
            elseif (empty($password)):
                $messages[] = "Password must be filled <br>";
            
            else: //search current user at database        
                $sql = "SELECT user FROM contas WHERE user = '$login'";
                $result = mysqli_query($dbConnect,$sql);

                if (mysqli_num_rows($result)>0):
                    $sql = "SELECT * FROM contas WHERE user = '$login' AND password = '$password'";
                    $result = mysqli_query($dbConnect,$sql);

                    if (mysqli_num_rows($result)==1):
                        $user_data = mysqli_fetch_array($result);
                        $_SESSION['logged'] = true;
                        $_SESSION['id_user'] = $user_data['id'];
                        header('Location: home.php');
                    else:
                        $messages[] = "Wrong user or password <br>";
                    endif;

                else:
                    $messages[] = "No user match found <br>";
                endif;
            endif;
        endif;
    endif;
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
    <title>Login</title>
</head>
<body>
    <div id="top"   >
        <div id="top_header">
            <h1>LOGIN</h1>
        </div>
    </div>
    
    <div id="error">
        <?php
        if (!empty($messages)):
            echo "ERROR! <br>" ;
            foreach ($messages as $show) {
                 echo $show."<br>";
             }
        endif;
        ?>
    </div>

<div id="mid">
        <div id="mid_box">    
            <div id="mid_content">
                <form name="signUser" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <label>Username: <label><br><br><input type="text" name="user" id="user" placeholder="Type your username"><br><br><br>
                    <label>Password: <label><br><br><input type="password"  name="password" id="password" placeholder="Type your password"><br><br><br>
                    <input class=buttom type="submit" name="login" id="login" value="Sign in">
                    <a class="link" href="./signup.php"> Create Your Account</a>
                </form>
            </div>
        </div> 
    </div>
</body>
</html>