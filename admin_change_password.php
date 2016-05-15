<?php
require('require.php');
require('session.php');
if(!isset($_SESSION['login_admin']))
{
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback | Change Password</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
   
    <div id="logout">
        <a href="logout.php">
            <input type="button" value="Log Out" id="button" /></a>
    </div>

    <div id="profile">
    <div style="">
        <img src="images/logo.png" style="margin:0 auto 0 auto;" />
    </div>
        <div style="color: white; display: block;margin-top:15px;">
            <span style="box-shadow:0 0 10px rgba(0,0,0,0.6);background:rgb(79, 79, 79);padding:15px;">Feedback System | Admin Panel</span>
        </div>
        <div id="info">
            <div class="welcome"><i><?php echo $row_admin['name']; ?></i></div>
            <div class="welcome"><i>Department : <?php echo $row_admin['dept']; ?></i></div>
            <hr />
        </div>
    </div>

    <div class="operations">
	<form action="admin_change_password.php" method="POST">
		OLD PASSWORD &nbsp;: <input type="password" name="old_password" placeholder="Old Password" required /><br /><br />
		NEW PASSWORD : <input type="password" name="new_password" placeholder="New Password" required /><br /><br />
		RETYPE &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="password" name="re_new_password" placeholder="Retype New Password" required /><br /><br />
		<input type="submit" name="submit" value="Change Password" />
	</form>
    </div>
	

</body>
</html>

<?php
if(isset($_POST['submit']) && !empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['re_new_password']))
{
	$old_password = mysql_real_escape_string($_POST['old_password']);
	$new_password = mysql_real_escape_string($_POST['new_password']);
	$re_new_password = mysql_real_escape_string($_POST['re_new_password']);
	
	$crypt_old_password = crypt($old_password,'svits');
	$crypt_new_password = crypt($new_password,'svits');
	
	$admin_query = mysql_query("select * from admin_login where password='$crypt_old_password' AND admin='$login_session'");
	$rows_admin = mysql_num_rows($admin_query);
	
	if($rows_admin == 1)
	{
		if($new_password == $re_new_password)
		{
			$id = $row_admin['id'];
			$update_query = "UPDATE `admin_login` SET `password` = '$crypt_new_password' WHERE `id` = $id";
			if(mysql_query($update_query))
			{
				?>
				<script>
				alert("Password changed successfully !");
				window.location.href = 'admin_panel.php'; //Back to admin panel.
				</script>
				<?php
			}			
		}
		else
		{
			?>
			<script>
			alert("Retyped password doesnot match !");
			</script>
			<?php
			die();
		}
	}
	else
	{
		?>
		<script>
		alert("Old password incorrect !");
		</script>
		<?php
		die();
	}

}
?>
