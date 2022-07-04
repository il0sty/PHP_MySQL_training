<?php

    include_once 'conn.php';  

   function InsertAccDB($name,$user,$pass,$dbConnect) {

        $query_account = "INSERT INTO contas (name,user,password) VALUES ('".$name."','".$user."','".$pass."') "; //query account and setting databse configuration
        $connect = $dbConnect->prepare($query_account);
        $connect->execute(); 

    }