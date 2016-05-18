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
    
    if(isset($_POST["selected_branch"]) && isset($_POST["selected_section"]) && isset($_POST["selected_sem"]) 
    && isset($_POST["year"]) && !empty($_POST["selected_branch"]) && !empty($_POST["year"])
    && !empty($_POST["selected_section"]) && !empty($_POST["selected_sem"]))
    {
        $selected_branch = $_POST["selected_branch"];
        $year = $_POST["year"];
        $selected_sem = $_POST["selected_sem"];
        $selected_section = $_POST["selected_section"];
    }
    else
    {
        echo "Report Not Found!";
        die();
    }
    $columns = getFormDataFieldNames();
?>
<html>
    <head>
        <style>
            html {
                font-size: 10px;
            }

            body {
                text-align: center;
                padding:10px;
            }

            .heading {
                margin-top: 2%;
                margin-bottom: 1%;
                font-size: 35px;
                font-weight: bold;
            }

            #comment_button {
                top: 70px;
                right: 10px;
            }

            table {
                margin-top: 10px;
                margin-left: auto;
                margin-right: auto;
                border: 2px groove black;
                word-wrap: break-word;
                table-layout: fixed;
            }

            th {
                font-size: 16px;
                border-left: 1px solid black;
                border-right: 1px solid black;
                border-bottom: 3px solid black;
                height: 40px;
                padding: 5px;
                width: 200px;
            }

        </style>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link href="../css/reports.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <button style="position: fixed; left: 10px; top: 10px;" onclick="custom_print()" id="print_button">Print</button>
        <div id="logout">
            <a href="../logout.php">
                <input type="button" value="Log Out" id="button" /></a>
        </div>
        
        <?php
            echo '<div class="heading">'.$selected_branch.'-'.$selected_section.'(Sem - '.$selected_sem.') Faculty Report</div>';
            echo '<div style = "font-weight:bold;font-size:15px;">Date :- '.date("d/m/Y",time()).'</div>';

            $query = "SELECT `form_id` FROM feedback_forms WHERE `branch`='$selected_branch' AND `sem`=$selected_sem AND `section`='$selected_section' AND `session`=$year";
            $result=mysql_query($query) or die(mysql_error());
            $form_id_array = mysql_fetch_assoc($result);
            $form_id = $form_id_array["form_id"];

            if($form_id==null)
            {
                die('<div class="heading">Feedback not created and hence not found!</div>');
            }
            
            $table = array(array());
            $table[0][0] = 'S.No';
            $table[0][1] = 'Faculty-ID';
            $table[0][2] = 'Teacher Name';
            $table[0][3] = 'Subject';
            
            echo '<div class=CSSTableGenerator>';
            
            for ($i=$startindex; $i < $totalskills+$startindex ; $i++) // Header
            { 
                $table[0][$i] = str_replace('_',' ',$columns[$i]); 
            }

            $table[0][$i] = 'Average'; 
            
            $query = "SELECT @z:=@z+1 S_No,a.`fid`,b.`tname`,c.`sname`,a.`$columns[$startindex]`,a.`$columns[5]`
                     ,a.`$columns[6]`,a.`$columns[7]`,a.`$columns[8]`,a.`$columns[9]`,a.`$columns[10]`
                     ,a.`$columns[11]`,a.`$columns[12]`,FORMAT((a.`$columns[$startindex]`+a.`$columns[5]`+a.`$columns[6]`
                     +a.`$columns[7]`+a.`$columns[8]`+a.`$columns[9]`+a.`$columns[10]`+a.`$columns[11]`+a.`$columns[12]`)
                     /$totalskills,2) AS avg FROM form_data a,teachers_info b,subjects c,(SELECT @z:=0) AS z 
                     WHERE a.`form_id`=$form_id AND a.`fid` = b.`fid` AND a.`sid`=c.`sid` ORDER BY avg DESC;";
            $result=mysql_query($query) or die(mysql_error());

            $i=1;
            while ($row = mysql_fetch_array($result,MYSQL_NUM)) 
            {
                $table[$i]=$row;
                $i++;
            }
            createTable($table,FALSE);
        ?>
        <form action="show_comment.php" method="POST">
            <input type="hidden" value="<?php echo $form_id; ?>" name="form_id" />
            <input type="submit" formtarget="_blank" value="Show Comments" style="position: fixed;" id="comment_button">
        </form>

        <div style="margin-top: 90px; font-size: 20px;">
            Signature<br />
            Feedback Co-ordinator<br />
            SVITS, Indore
        </div>
        <script>
            function custom_print() {
                var print_button = document.getElementById("print_button");
                var comment_button = document.getElementById("comment_button");
                var logout_button = document.getElementById("logout");

                logout.style.display = "none";
                print_button.style.display = "none";
                comment_button.style.display = "none";

                window.print();

                print_button.style.display = "block";
                comment_button.style.display = "block";
                logout.style.display = "block";
            }
        </script>
    </body>
</html>
