<?php
require('session.php');
require('verify.php'); //Admin check given in this script, no need to recheck

?>

<!DOCTYPE html>
<html>
<head>
<title>Feedback | Profile</title>
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
        <div class="welcome"><i>Feedback Co-ordinator : <?php echo $row_fc['name']; ?></i></div>
        <hr />
    </div>
    
</div>

<div class="operations">
    
	<?php
	$check_query = mysql_query("SELECT id FROM admin_login WHERE verified=0");
	$num_rows = mysql_num_rows($check_query);
	if($num_rows == 0)
	{
		echo "<h2>All admins are verified !</h2>";
	}
	else {
	?>
	<form action = "verify_page.php" method="POST" >
	<div class=CSSTableGenerator id=table ><table style="">
	
	<tr><th>Admin ID</th>
	<th>Admin Name</th>
	<th>Admin Username</th>
	<th>Department</th>
	<th>Verify Admin</th></tr>
	
<?php
	$admin_query = "SELECT id,name,admin,dept FROM admin_login WHERE verified = 0 ORDER BY id DESC";
	if($result = mysql_query($admin_query) or die(mysql_error()))
	{
		$numfields = mysql_num_fields($result);
		
		$columns = array();
		
		for ($i=0; $i < $numfields; $i++)
		{
			$columns[$i] = mysql_field_name($result, $i);
            
		}
		while($row = mysql_fetch_assoc($result))
		{   
			echo '<tr>';
            
			for ($i=0; $i < $numfields; $i++)
			{            
				echo '<td>'.$row[$columns[$i]].'</td>';      
                      
			}
              
			echo '<td><button type="submit" name = "id" value="'.$row[$columns[0]].'">Verify</button></td>';
			echo '</tr>';            
		}
	}
    else
    {
        echo 'query not done';
    }
	echo '</table>';
	echo '</form>';
	}
	?>
	<br /><input type="button" onclick="location.href='fc_panel.php';" value="Go Back" />
	</div>
</div>

</body>
</html>