<?php
require 'require.php';
require('session.php');
if(!isset($_SESSION['login_student']))
{
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Feedback | Profile</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style>
      
</style>

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

        <div style="color:white;display:block;" >
            <span style="box-shadow:0 0 10px rgba(0,0,0,0.6);background:rgb(79, 79, 79);padding:15px;">Feedback System | Student Panel</span>
        </div>

    <div id="info">
		<div class="welcome">Username : <i><?php echo $login_session; ?></i></div>
		<!-- <div class="welcome"><i><?php echo $row_student['name']; ?></i></div> -->
        <div class="welcome">Class : <i><?php echo $row_student['branch'].'-'.$row_student['section'];?></i></div>
        <div class="welcome">Sem : <?php echo $row_student['sem']?></i></div>
        <hr />
    </div>
</div>

<div class="operations">


  <?php
	if($row_student['counter']>0)
	{
		die( "<h2>Form has already been filled by you ! You can not resubmit the form now !</h2>" );
	}
	$form_id_query = mysql_query("SELECT * FROM feedback_forms WHERE branch = '".$row_student['branch']."' AND section = '".$row_student['section']."' AND sem = '".$row_student['sem']."' ");
	
	$no_forms = mysql_num_rows($form_id_query);
	
	if($no_forms == 0)
	{
		die( "No forms for you to fill !" );
	}
	
	else if($no_forms != 1)
	{
		die( "Form Conflicts ! Contact the Administrator of the feedback system !" );
	}
	
	else
    {
        $form_data = mysql_fetch_assoc($form_id_query);	
	    $_SESSION['form_id'] = $form_data['form_id'];
    }
  ?>

<div class="operation_container">
<a href="auto-table-final.php" class="fill_feedback" >Fill Feedback Form</a>
</div>
</div>
</body>
</html>