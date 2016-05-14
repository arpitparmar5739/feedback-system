<?php 

$conn_error = '<strong>Could not connect to database.</strong>';
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = 'Windows10';

$mysql_db = 'feedback_new';

$conn = @mysql_connect($mysql_host,$mysql_user, $mysql_password);

if(!($conn) || !(@mysql_select_db($mysql_db) )) 
{
    die($conn_error);
}
?>