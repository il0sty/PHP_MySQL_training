<?php   

        include_once 'acc_manage.php';
        include_once 'AccVerif.php';
        include_once 'db_insert.php';   
        include_once 'conn.php';

        if(!empty($_POST['confirm'])): //confirm button - click verification
            
            $verName = verAcName($_POST['name'],$messages);
            $verUser = verAcUser($_POST['user'],$dbConnect,$messages);
            $verPass = verAcPass($_POST['password'],$_POST['confPassword'],$messages);
            $account = new account($verName,$verUser,$verPass); //account creation as an object            

        endif;        


    ?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css"/>
        <!-- Font Nunito Bold 700 Italic 'font-family: 'Nunito', sans-serif;'-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Sign Up</title>
</head>
<body>
    
    <div id="top">
        <div id="top_header">
            <h1>CREATE YOUR ACCOUNT</h1>
        </div>
    </div>
    <div id="mid">
        <div id="mid_box">
            <?php
            if(!empty($_POST['confirm'])): 
                if (empty($messages)): //account verification               
                    InsertAccDb($account->getName(),$account->getUser(),$account->getPassword(),$dbConnect); //using function to insert data in the database
                    echo "Account Created! <br> <br>";
                else:                    
                    echo "Invalid Account! <br> <br>";
                    foreach ($messages as $text):
                        echo "$text <br>";
                    endforeach;
                endif;
    
            endif;

            ?>
            <div id="mid_content">
                <form name="signUser" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <label>Name: </label><br><br>
                    <input type="text" id="name" name="name" placeholder="Type Your Name"><br><br><br>
                    <label>User: </label><br><br>
                    <input type="text" name="user" id="user" placeholder="Type Your User"><br><br><br>
                    <label>Password: </label><br><br>
                    <input type="password" name="password" id="password" placeholder="Type Your Password"><br><br><br>
                    <label>Confirm Password: </label><br><br>
                    <input type="password" name="confPassword" id="confPassword" placeholder="Confirm Your Password"><br><br><br>
                    <input class ="buttom" type="submit" value="Confirm" name="confirm">
                    <a class="buttom" href="./login.php">Return</a>
            </div>
            
            </form>
        </div>
    </div>
</body>
</html>