<?php

if(!isset($_SESSION['login_fc']))
{
	header('Location: index.php');
}

$message=''; // Variable To Store Message

if (isset($_POST['submit'])) 
{
	if (empty($_POST['id'])) 
	{
		$message = "Please supply Admin ID !";
		echo "<script>";
		echo "alert('$message');";
		echo "</script>";
	}
	else
	{
		// Define $id
		$id=$_POST['id'];

		// To protect MySQL injection for Security purpose
		$id = stripslashes($id);
		$id = mysql_real_escape_string($id);
		
		
		$verified = mysql_query("UPDATE admin_login SET verified = 1 WHERE id = '$id'");
		
		if($verified)
		{
			$message = "Verification Successfull!" ;
			echo "<script>";
			echo "alert('$message');";
			echo "</script>";
		}
		else
		{
			$message = "Failed to Verify !";
			echo "<script>";
			echo "alert('$message');";
			echo "</script>";
		}
		
		
	}
}