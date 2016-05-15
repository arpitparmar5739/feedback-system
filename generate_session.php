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
		<b>Current Session : </b><?php echo $current_session; ?><br /><br />
        <form action="generate_session.php" method="POST">
		<input type="submit" value="Generate New Session for <?php echo $current_session+1 ;?>" name="submit_session"/>
		</form>
    </div>
</div>

</body>
</html>

<?php
if(isset($_POST['submit_session']))
{
	$date_created = date('Y-m-d',time());
	$new_session = $current_session+1;
	$session_added=mysql_query("INSERT INTO session_details (`session`,`date`) VALUES ($new_session,$date_created)") or die(mysql_error());
	
	$teacher_report_default=mysql_query("ALTER TABLE `teacher_report` CHANGE `session` `session` INT(5) NOT NULL DEFAULT $new_session") or die(mysql_error());
	
	$feedback_forms_default=mysql_query("ALTER TABLE `feedback_forms` CHANGE `session` `session` INT(5) NOT NULL DEFAULT $new_session") or die(mysql_error());
	
	
	$teacher_report_extract = mysql_query("SELECT fid FROM teacher_report WHERE session = $current_session ;") or die(mysql_error());
	
	$insert_query = "INSERT INTO teacher_report (`fid`) VALUES ";
	while($row = mysql_fetch_assoc($teacher_report_extract))
	{
		$insert_query = $insert_query."(".$row['fid']."),";
	}
	
	$insert_query = substr($insert_query,0 ,-1);
	$teacher_report_initialized = mysql_query($insert_query) or die(mysql_error());
	
	if($session_added && $teacher_report_default && $feedback_forms_default && $teacher_report_initialized)
	{
		echo "New session generated successfully";
	}

}
?>