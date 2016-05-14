<?php

	require 'require.php';
	require('session.php');
	
	if(!isset($_SESSION['login_fc']))
	{
		header('Location: index.php');
	}

		if(!isset($_POST['form_id']))
		{
			die("Invalid Operation !");
		}
		
		$form_id = $_POST['form_id'];
		
		$comment_table_name='form_comments';
		
		$query_result = mysql_query("SELECT comment,cid from $comment_table_name WHERE form_id=$form_id") or die(mysql_error());
	
		$num = mysql_num_rows($query_result);
		
		
?>
<html>

<head>
	<style>
	body{
		text-align:center;
		font-family:sans-serif;
	}
	
	.heading{
		margin-top:20px;
		font-size:30px;
		font-family:sans-serif;
		font-weight:bold;
	}
		.container{
			
			width:70%;
			margin:30px auto 15px auto;
			background:#f0f0ff;
			padding:20px;
			box-shadow:0 0 10px rgba(0,0,0,.5);
			border-radius:20px;
		}
		
		.textarea{
			margin:20px;
			resize:none;
		}
	</style>

    <link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
    <div id="logout">        
            <a href="logout.php"><input type="button" value="Log Out" id="button" /></a>        
    </div>
   		<div>
			
				<div class="heading">
					Comments
				</div>
			
			<?php
			if($query_result)
			{
				if($num == 0)
				{
					echo "<br /><br /><br />No comments found !!!";
				}
				while($row = mysql_fetch_assoc($query_result)) // Header
				{ 
					
					echo '<div class="container">';
					echo 'Comment ID : '.$row['cid'].'<br />';
						echo '<textarea rows="4" cols="100" readonly="readonly" class="textarea">'.$row['comment'].'</textarea>';
					echo '</div>';
					$j++;
				}
				
			}
			?>
		</div>	
			
</body>
<html>
