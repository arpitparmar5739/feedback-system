<?php

require 'require.php';
require 'session.php';

if(!isset($_SESSION['login_admin']))
{
    header("Location: index.php");
}
?>

<?php

        if(isset($_POST['fid']) && isset($_POST['tname']) && isset($_SESSION['dept']) && !empty($_POST['fid']) && !empty($_POST['tname']) && !empty($_SESSION['dept']))
        {
            $fid = $_POST['fid'];
            $tname = $_POST['tname'];
            $dept = $_SESSION['dept'];
            
            $add_query = "INSERT INTO teachers_info (fid, tname, dept) VALUES('$fid','$tname','$dept')";
            $add_result = mysql_query($add_query) or die(mysql_error());

            $report_add_query = "INSERT INTO teacher_report (fid) VALUES ('$fid')";
            $report_result = mysql_query($report_add_query) or die(mysql_error());

            if($add_result && $report_result)
            {
				
				echo '<script>';
				echo 'alert("Faculty added successfully !");';
				echo '</script>';
				
            }
        }

        ?>

<html>
<head>
    <title>Add Faculty</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; vertical-align: middle; text-align: center;">
    <div id="logout">        
            <a href="logout.php"><input type="button" value="Log Out" id="button" /></a>        
    </div>
    <div style="background: linear-gradient(rgb(255, 255, 255),rgba(0, 0, 0, 0.10)); padding: 20px; width: 70%; margin: auto; margin-top: 50px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.6); border-radius: 20px;text-align:center;">
        <p>
            Add Faculty :
        </p>

        <form action="add_teacher.php" method="POST" style="text-align:center;">
            <div>
                <div style="margin:10px auto 10px auto;">
                    Faculty ID  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    
                        <input type="number" name="fid" required autofocus />
                </div>
                <div style="margin:10px auto 10px auto;">
                    Faculty Name :                   
                        <input type="text" name="tname" required />
                    
                </div>
            </div>
            <input type="submit" value="Add" />
        </form>

    </div>
</body>
</html>