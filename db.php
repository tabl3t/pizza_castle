<?php

$host = "mysql.railway.internal";

$user = "root";                     

$pass = "wgoSYVkZwaKMnSzDtNzpKyswivbHORxf";          

$db   = "railway"; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}

?>
