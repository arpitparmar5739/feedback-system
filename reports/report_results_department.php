<?php
    require '../session.php';
    require '../database_connection.php';
    require '../functions/getFormDataFieldNames.php';
    require '../functions/createTable.php';

    if(!isset($_SESSION['login_fc']))
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
        <title>Feedback System</title>
        
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link href="../css/reports.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="logout">        
                <a href="../logout.php"><input type="button" value="Log Out" id="button" /></a>        
        </div>

        <button style="position: fixed; left: 10px; top: 10px;" onclick="custom_print()" id="print_button">Print</button>
        <div style="text-align: center; margin-top: 1%;">
            <h1 style="font-size: 35px;"><?php echo $department; ?> Department Faculty Feedback</h1>
        </div>
        
        <?php                      
            echo '<div style = "font-weight:bold;font-size:15px;">Date :- '.date("d/m/Y",time()).'</div>';
            $columns = getFormDataFieldNames();

            $query = "SELECT @z:=@z+1 S_No,a.`fid`,b.`tname`,b.`dept`,a.`counter`,a.`$columns[$startindex]`,a.`$columns[5]`
                        ,a.`$columns[6]`,a.`$columns[7]`,a.`$columns[8]`,a.`$columns[9]`,a.`$columns[10]`
                        ,a.`$columns[11]`,a.`$columns[12]`,FORMAT((a.`$columns[$startindex]`+a.`$columns[5]`+a.`$columns[6]`
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
            for ($i=$startindex+1; $i <= $totalskills + $startindex ; $i++) // Header
            { 
                    $table[0][$i] = str_replace('_',' ',$columns[$i-1]); 
            }

            $table[0][$i] = 'Average';
            
            $i = 1;
            while ($row = mysql_fetch_array($result,MYSQL_NUM)) 
            {
                $table[$i]=$row;
                $i++;
            }
            createTable($table,FALSE);    
        ?>

        <div style="margin-top: 100px; font-size: 20px;">
            Signature<br />
            Feedback Co-ordinator<br />
            SVITS, Indore
        </div>
        <script src="../hiding_buttons.js"></script>
        <script>
            function custom_print() {
                var print_button = document.getElementById("print_button");
                print_button.style.display = "none";
                window.print();
                print_button.style.display = "block";
            }
        </script>
    </body>
</html>
