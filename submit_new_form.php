<?php
	require 'session.php';
	
	if(!isset($_SESSION['login_admin']))
	{
		header("Location: index.php");
	}
?>

<?php

if(isset($_POST['f1']) && isset($_POST['s1']) && isset($_POST['skill1']) && isset($_POST['rows']) && isset($_POST['cols']) && isset($_POST['branch']) && isset($_POST['section']) && isset($_POST['name']))
	{
        $branch = $_POST['branch'];
        $section = $_POST['section'];
        $sem = $_POST['sem'];
        $name = $_POST['name'];
		$rows = $_POST['rows'];
		$cols = $_POST['cols'];

        $date_created = date('Y-m-d',time());
        
        $add_form_query = "INSERT INTO feedback_forms (form_name, branch, section, sem, rows, cols, date_created) VALUES ('$name','$branch','$section',$sem,$rows,$cols,'$date_created')";
        $result = mysql_query($add_form_query) or die(mysql_error());
        
        $form_id = mysql_insert_id();
	
	
 		//Extracting data from previous form
		for($i=1;$i<=$rows;$i++)
		{
			$fids[$i] = $_POST['f'.$i];
		}
		for($i=1;$i<=$rows;$i++)
		{
			$sids[$i] = $_POST['s'.$i];
		}
		
		
		$insert_query = "INSERT INTO form_data (form_id,fid,sid) VALUES(";
		
		for($y = 1; $y<=$rows ; $y++)
		{
			$insert_query = $insert_query.$form_id.",".$fids[$y].",".$sids[$y]."),(";
		}
		
		$insert_query = substr($insert_query,0 ,-2 );

		$add_result = mysql_query($insert_query) or die(mysql_error());
		
		if($add_result && $result)
		{
			
?>
<html>
<head>
    <title>Feedback | Form Created! </title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div id="logout">        
            <a href="logout.php"><input type="button" value="Log Out" id="button" /></a>        
    </div>

<div style="margin:auto; margin-top:50px ; text-align:center ; box-shadow:0 0 5px rgba(0,0,0,0.7) ; box-radius:20px ; width:60% ; padding:20px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
<h2> Form Created Successfully for Semester <?php echo $sem; ?> ! </h2>
<p>Form ID : <?php echo $form_id; ?></p>
<a href="create_form.php" style="text-decoration:none; color:black;"><button>Create more forms</button></a>
</div>
</body>
</html>

<?php
		}
		
		
	}
	else
	{
		echo "Error : Fields not set !";
	}

?>
