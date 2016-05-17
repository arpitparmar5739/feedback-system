<?php

require 'require.php';
require('session.php');
if(!isset($_SESSION['login_fc']))
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
            <a href="logout.php"><input type="button" value="Log Out" id="button" /></a>        
    </div>
<div id="profile">
<br />

    <div style="margin-top:-3%;margin-bottom:2%;">
        <img src="images/logo.png" style="margin:0 auto 0 auto;" />
    </div>

    <div style="color:white;display:block;">
        <span style="box-shadow:0 0 10px rgba(0,0,0,0.6);background:rgb(79, 79, 79);padding:15px;">Feedback System | Feedback Co-ordinator Panel</span>
    </div>
    <div id="info">
        <div class="welcome"><i>Feedback Co-ordinator : <?php echo $row_fc['name']; ?></i></div>
        <hr />
    </div>
    
</div>

<div class="operations">
	<div class="operation_container">
        <a href="reports.php">Generate Reports</a>
    </div>
	<div class="operation_container">
        <a href="fc_stats.php">Statistics</a>
    </div>
	<br /><br /><br />
	<div class="operation_container">
        <a href="generate_session.php">Generate New Session</a>
    </div>
	<div class="operation_container">
        <a href="verify_page.php">Verify Admin</a>
    </div>
</div>

</body>
</html>