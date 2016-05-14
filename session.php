<?php

require 'database_connection.php';

session_start();// Starting Session

// Storing Session
if(isset($_SESSION['login_student']))
{
	$user=$_SESSION['login_student'];
	
	// SQL Query To Fetch Complete Information Of User
	$ses_sql=mysql_query("SELECT * FROM students_login WHERE enrollno='$user'");
	$row_student = mysql_fetch_assoc($ses_sql);
	$login_session = $row_student['enrollno'];
}
else if(isset($_SESSION['login_admin']))
{
	$user=$_SESSION['login_admin'];
	
	// SQL Query To Fetch Complete Information Of User
	$ses_sql=mysql_query("SELECT * FROM admin_login WHERE admin='$user'");
	$row_admin = mysql_fetch_assoc($ses_sql);
	$login_session = $row_admin['admin'];
	$_SESSION['dept'] = $row_admin['dept'];
}
else if(isset($_SESSION['login_fc']))
{
	$user=$_SESSION['login_fc'];
	
	// SQL Query To Fetch Complete Information Of User
	$ses_sql=mysql_query("SELECT * FROM fc_login WHERE fc='$user'");
	$row_fc = mysql_fetch_assoc($ses_sql);
	$login_session = $row_fc['fc'];
}
else if(isset($_SESSION['login_principal']))
{
	$user=$_SESSION['login_principal'];
	
	// SQL Query To Fetch Complete Information Of User
	$ses_sql=mysql_query("SELECT * FROM principal_login WHERE principal='$user'");
	$row_principal = mysql_fetch_assoc($ses_sql);
	$login_session = $row_principal['principal'];
}

if(!isset($login_session))
{
	header('Location: index.php'); // Redirecting To Home Page
}

?>
