<?php 

$conn_error = '<strong>Could not connect to database.</strong>';
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = 'svvvteamaa';

$mysql_db = 'feedback';

$conn = @mysql_connect($mysql_host,$mysql_user, $mysql_password);

if(!($conn) || !(@mysql_select_db($mysql_db) )) 
{
    die($conn_error);
}
?>
