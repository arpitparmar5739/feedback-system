<?php

require 'require.php';
require('session.php');
if(!isset($_SESSION['login_fc']))
{
    header('Location: index.php');
}
?>

<?php	

	if(isset($_SESSION['filter_query']))
	{
		$forms_query = $_SESSION['filter_query'];
	}
	else
	{
		$forms_query = "SELECT form_name,counter from feedback_forms ORDER BY form_name";
	}
	
	if(isset($_POST['dept']))
	{
		if(!empty($_POST['dept']))
		{
			$dept = $_POST['dept'];
			$_SESSION['filter_dept'] = $dept; 
			$forms_query = "SELECT form_name,counter from feedback_forms WHERE branch='$dept' ORDER BY form_name";
		}
		else
		{
			$_SESSION['filter_dept']='All Departments';
			$forms_query = "SELECT form_name,counter from feedback_forms ORDER BY form_name";
		}
	}
	
	$_SESSION['filter_query'] = $forms_query;

	$results = mysql_query($forms_query) or die(mysql_error());
?>

<!DOCTYPE html>
<html>
<head>
<title>Feedback | Statistics</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/auto_table_final.css" rel="stylesheet" type="text/css" />
</head>
<body style="background:white;">
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
        <div class="welcome">Feedback Statistics</div>
        <hr />
    </div>
    
</div>

<div class="operations">
                <h2>Filtered By : 
				<?php 
					if(isset($_SESSION['filter_dept']))
					{
						echo $_SESSION['filter_dept'];
					}
					else
					{
						echo 'All Departments';
					}
				
				?></h2>
				<form action="fc_stats.php" method=POST>
					Filter by departments : <select name="dept">
                                        <option value="">All</option>
                                        <option value="CS">CS</option>
                                        <option value="IT">IT</option>
                                        <option value="EC">EC</option>
                                        <option value="EX">EX</option>
                                        <option value="EI">EI</option>
                                        <option value="CE">CE</option>
                                        <option value="ME">ME</option>
                                        <option value="TT">TX</option>
                                        <option value="AU">AU</option>                                      
					</select>
					<input type="submit" value="Submit" class="submit" />
				</form>
				<div id="stats">
				<div class=CSSTableGenerator id=table>
					<table style="">
				
                    <tr>
						<td><b>Form Name</b></td><td><b>Counter</b></td>
                    </tr>
					
					<?php
					
					while($row = mysql_fetch_assoc($results))
					{
						echo "<tr>";
						echo "<td>".$row['form_name']."</td>"."<td>".$row['counter']."</td>";
						echo "</tr>";
					}
					
					?>
					
					</table>
				</div>
				</div>
</div>

<br /><input type="button" onclick="location.href='fc_panel.php';" value="Go Back" />

	<script src="chosen/jquery.min.js" type="text/javascript"></script>
	<script>
	setInterval(function()
	{
		$('#stats').load('fc_stats.php #stats');
	}, 1000)
	</script>
	
</body>
</html>