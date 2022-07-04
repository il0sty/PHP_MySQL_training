<?php

$host = "localhost"; 
$user = "root"; 
$pass = "";
$dbname = "teste";

$dbConnect = mysqli_connect($host,$user,$pass,$dbname); //setting conection with the MySQL database using the host,user,password and database name

if (mysqli_connect_error()): 	
	echo "Database Connection Error: ".mysqli_connect_error()."<br><br>";
endif;