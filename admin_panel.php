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
    <title>Feedback | Profile</title>
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
        <div class="operation_container">
            <a href="add_teacher.php">Add Faculty</a>
        </div>
        <div class="operation_container">
            <a href="create_form.php">Create New Form</a>
        </div>
		<div class="operation_container">
            <a href="admin_change_password.php">Change Password</a>
        </div>
    </div>

</body>
</html>
