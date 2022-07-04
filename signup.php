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

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>

    <h1>SIGN UP</h1>

    <form name="signUser" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

        <label>Name: </label>
        <input type="text" id="name" name="name" placeholder="Name"><br><br>
        <label>User: </label>
        <input type="text" name="user" id="user" placeholder="User"><br><br>
        <label>Password: </label>
        <input type="password" name="password" id="password" placeholder="Password"><br><br>
        <label>Confirm Password: </label>
        <input type="password" name="confPassword" id="confPassword" placeholder="Confirm Password"><br><br>
        <input type="submit" value="Confirmar" name="confirm"> 
        <a href="./login.php"><input type="button" name="return" value="Retornar"></a>
        
    </form>
</body>
</html>