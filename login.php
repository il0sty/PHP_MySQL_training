<?php

    include_once 'acc_manage.php';
    include_once 'conn.php';

    session_start();

    if (!empty($_SESSION['logged'])  && $_SESSION['logged'] == true):
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
    <title>Login</title>
</head>
<body>
    
    <h1>LOGIN</h1>

    <?php

    if (!empty($messages)):
        foreach ($messages as $show) {
             echo $show."<br>";
         } 
    endif;

    ?>

    <form name="signUser" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

        <label>Nome de Usuário: <label><input type="text" name="user" id="user" placeholder="Usuário"><br><br>
        <label>Senha: <label><input type="password"  name="password" id="password" placeholder="Senha"><br><br>
        <input type="submit" name="login" id="login" value="Entrar">
        <a href="./signup.php"><input type="button" value="Cadastrar-se" ></a>

    </form>

</body>
</html>