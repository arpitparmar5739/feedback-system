<?php

require 'database_connection.php';

session_start(); // Starting Session
$message=''; // Variable To Store Message

if (isset($_POST['submit'])) 
{
	if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['name']) || empty($_POST['dept'])) 
	{
		$message = "Fields cannot be empty!";
	}
	else
	{
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		$name=$_POST['name'];
		$dept=$_POST['dept'];

		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		$name = stripslashes($name);
		$dept = stripslashes($dept);
		$name = mysql_real_escape_string($name);
		$dept = mysql_real_escape_string($dept);
		
		//###Encryption to be added###
		$crypt_password = crypt($password,'svits');

		// SQL query to fetch information of registerd users and finds user match.
		
		$admin_add = mysql_query('INSERT INTO admin_login (`name`,`admin`,`password`,`dept`) VALUES("'.$name.'","'.$username.'","'.$crypt_password.'","'.$dept.'")');
		
		if($admin_add)
		{
			$id = mysql_insert_id();
			$message = "Your Admin ID : ".$id ;
			$id=mysql_insert_id();
		}
		else
		{
			$message = "Failed to Signup !";
		}
		
		
	}
}