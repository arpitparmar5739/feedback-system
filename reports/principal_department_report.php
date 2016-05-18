<?php
    require '../session.php';
    require '../database_connection.php';
    require '../functions/getFormDataFieldNames.php';
    require '../functions/createTable.php';

    if(!isset($_SESSION['login_principal']))
    {
        header('Location: ../index.php');
    }
    $startindex = 4;
    $totalskills = 9;
    
    if(isset($_POST["selected_department"]) && isset($_POST["year"]) && !empty($_POST["selected_department"]) && !empty($_POST["year"]))
    {
        $department = $_POST["selected_department"];
        $year = $_POST["year"];
    }
    else
    {
        die("Report Not Found!");
    }
?>

<html>
    <head>
		<style>
			html{
				font-size:10px;
			}
			body{
				text-align:center;
			}

			table{
				margin-top:10px;
				margin-left:auto;
				margin-right:auto;
				border:2px groove black;
				word-wrap: break-word;
				table-layout:fixed; 
			}
			
			th
			{
					font-size:16px;
					border-left:1px solid black;
					border-right:1px solid black;
					border-bottom : 3px solid black;
					height : 40px;
					padding : 5px;        
					width:200px;
			}
		</style>
		<link href="../css/reports.css" rel="stylesheet" type="text/css" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
	</head>
    <body>
		<button style="position:fixed;left:10px;top:10px;" onclick="custom_print()"  id="print_button">Print</button>
		<div id="logout">        
				<a href="../logout.php"><input type="button" value="Log Out" id="button" /></a>        
		</div>

		<div style="text-align:center;margin-top:1%;">
			<h1 style="font-size:35px;"><?php echo $department; ?> Department Faculty Feedback</h1>
		</div>
		
		<?php                      
            echo '<div style = "font-weight:bold;font-size:15px;">Date :- '.date("d/m/Y",time()).'</div>';
            $columns = getFormDataFieldNames();

            $query = "SELECT @z:=@z+1 S_No,a.`fid`,b.`tname`,b.`dept`,a.`counter`,FORMAT((a.`$columns[$startindex]`+a.`$columns[5]`+a.`$columns[6]`
                        +a.`$columns[7]`+a.`$columns[8]`+a.`$columns[9]`+a.`$columns[10]`+a.`$columns[11]`+a.`$columns[12]`)
                        /$totalskills,2) AS avg FROM teacher_report a, teachers_info b,(SELECT @z:=0) AS z WHERE 
                        a.`fid`=b.`fid` AND a.`session`=$year AND b.`dept`='$department' ORDER BY avg DESC"; 
            $result=mysql_query($query) or die(mysql_error());
            
            echo '<div class=CSSTableGenerator><table>'."\n".'<tr>';
            $table = array(array());
    
            $table[0][0] = 'S.No.';
            $table[0][1] = 'Faculty-ID';
            $table[0][2] = 'Teacher Name';
            $table[0][3] = 'Branch';
            $table[0][4] = 'Total no. of students given feedback';
            $table[0][5] = 'Average';
            
            $i = 1;
            while ($row = mysql_fetch_array($result,MYSQL_NUM)) 
            {
                $table[$i]=$row;
                $i++;
            }
            createTable($table,FALSE)    
        ?>

		<div style="margin-top:100px;font-size:20px;">
			Signature<br />
			Principal<br />
			SVITS, Indore
		</div>
			<script src="../hiding_buttons.js"></script>
			<script>
			function custom_print()
			{
				var print_button = document.getElementById("print_button");
				print_button.style.display = "none";
				window.print();
				print_button.style.display = "block";
			}
		</script>
	</body>
</html>

