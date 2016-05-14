<?php
    $conn_error = '<strong>Could not connect to database.</strong>';
    $mysql_host = 'localhost';
    $mysql_user = 'root';
    $mysql_password = 'Windows10';
    $mysql_db = 'feedback_new';
    
    $con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
    if(mysqli_connect_error())
    {
        die($conn_error);
    }
?>