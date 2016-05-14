<?php

require 'require.php';
require 'database_connection.php';

session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) 
{
	if (empty($_POST['username']) || empty($_POST['password'])) 
	{
		$error = "Username or Password is invalid";
		
		echo "<script>";
		echo "alert('$error');";
		echo "</script>";
	}
	else
	{
		// Define $username and $password
		$username=$_POST['username'];
		$username=strtoupper($username);
		
		$password=$_POST['password'];

		
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		
		//###Encryption to be added###
		$crypt_password = crypt($password,'svits');

		// SQL query to fetch information of registerd users and finds user match.
		$student_query = mysql_query("select * from students_login where password='$password' AND enrollno='$username'");
		$rows_student = mysql_num_rows($student_query);
		
		
		$admin_query = mysql_query("select * from admin_login where password='$crypt_password' AND admin='$username'");
		$rows_admin = mysql_num_rows($admin_query);
		
		$fc_query = mysql_query("select * from fc_login where password='$password' AND fc='$username'");
		$rows_fc = mysql_num_rows($fc_query);
		
		$principal_query = mysql_query("select * from principal_login where password='$password' AND principal='$username'");
		$rows_principal = mysql_num_rows($principal_query);
		
		
		if ($rows_student == 1) 
		{
			$_SESSION['login_student']=$username; // Initializing Session
			header("Location: student_panel.php"); // Redirecting To Other Page
		}
		else if($rows_admin == 1) 
		{
			$admin_info = mysql_fetch_assoc($admin_query);
	
			if($admin_info['verified'])
			{
				$_SESSION['login_admin']=$username; // Initializing Session
				header("Location: admin_panel.php"); // Redirecting To Other Page
			}
			else
			{
				$error = "Your account is not verified !";
				echo "<script>";
				echo "alert('$error');";
				echo "</script>";
			}
			
		}
		else if($rows_fc == 1)
		{
			$_SESSION['login_fc']=$username; // Initializing Session
			header("Location: fc_panel.php"); // Redirecting To Other Page
		}
		else if($rows_principal == 1)
		{
			$_SESSION['login_principal']=$username; // Initializing Session
			header("Location: principal_panel.php"); // Redirecting To Other Page
		}
		else
		{
			$error = "Username or Password is invalid !";
			echo "<script>";
			echo "alert('$error');";
			echo "</script>";
		}
	
		mysql_close($conn); // Closing Connection
	}
	
}
?>