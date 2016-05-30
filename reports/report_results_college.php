<?php
	require('../session.php');
	
	if(!isset($_SESSION['login_fc']))
	{
		header('Location: ../index.php');
	}
    if(isset($_POST["year"]) && !empty($_POST["year"]))
    {
        $year = $_POST["year"];
    }
    else 
    {
        die("Report Not Found");    
    }
?>
<html>
    <head>
        <title>Feedback System</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link href="../css/reports.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <div id="logout">        
                <a href="../logout.php"><input type="button" value="Log Out" id="button" /></a>        
        </div>
        <button style="position:fixed;left:10px;top:10px;" onclick="custom_print()"  id="print_button">Print</button>
        <div style="text-align:center;margin-top:1%;">
            <h1 style="font-size:35px;">Faculty Feedback</h1>
        </div>
        
        <?php
            require '../database_connection.php';
            require '../functions/getFormDataFieldNames.php';
            require '../functions/createTable.php';

            $startindex = 4;
            $totalskills = 9;
            
            echo '<div style = "font-weight:bold;font-size:15px;">Date :- '.date("d/m/Y",time()).'</div>';
            $columns = getFormDataFieldNames();

            echo '<div class=CSSTableGenerator>';
            $table = array(array());
            $j=0;
            $Head[$j++] = "S.No.";
            $Head[$j++] = "Faculty-ID";
            $Head[$j++] = "Teacher Name";
            $Head[$j++] = "Branch";
            $Head[$j++] = "Total no. of students given feedback";
            for ($i=$startindex; $i < $startindex+$totalskills; $i++) // Header
            {
                    $Head[$j++] = str_replace('_',' ',$columns[$i]); 
            }
            $Head[$j] = "Average";
            
            $query = "SELECT @z:=@z+1 S_No,a.`fid`,b.`tname`,b.`dept`,a.`counter`,a.`$columns[$startindex]`,a.`$columns[5]`
                     ,a.`$columns[6]`,a.`$columns[7]`,a.`$columns[8]`,a.`$columns[9]`,a.`$columns[10]`
                     ,a.`$columns[11]`,a.`$columns[12]`,FORMAT((a.`$columns[$startindex]`+a.`$columns[5]`+a.`$columns[6]`
                     +a.`$columns[7]`+a.`$columns[8]`+a.`$columns[9]`+a.`$columns[10]`+a.`$columns[11]`+a.`$columns[12]`)
                     /$totalskills,2) AS avg FROM teacher_report a, teachers_info b,(SELECT @z:=0) AS z WHERE a.`fid`=b.`fid` 
                     AND a.`session`=$year and a.`counter`!=0 ORDER BY avg DESC";
            $result = mysql_query($query) or die(mysql_error());
            
            $table[0] = $Head;            
            $i=1;
            while ($row = mysql_fetch_array($result,MYSQL_NUM)) 
            {
                $table[$i]=$row;
                $i++;
            }
            createTable($table,FALSE);          
        ?>
        
        <div style="margin-top:90px;font-size:20px;">
            Signature<br />
            Feedback Co-Ordinator<br />
            SVITS, Indore
        </div>
        <script src="../hiding_buttons.js"></script>
    </body>
</html>