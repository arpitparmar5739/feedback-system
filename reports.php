<?php

require 'require.php';
require('session.php');

if(!isset($_SESSION['login_fc']))
{
    header('Location: index.php');
}
?>


<!doctype html>

<html>
<head>
    <title>Faculty Reports
    </title>
    <link type="text/css" rel="stylesheet" href="css/style_report.css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div id="logout">        
            <a href="logout.php"><input type="button" value="Log Out" id="button" /></a>        
    </div>

    <div class="main_heading">

    <div style="margin-bottom:30px;margin-top:-7px;">
        <img src="images/logo.png"/>
    </div>
    </div>

     <div style="margin-top:-75px;margin-bottom:60px;font-family:sans serif;">
    <span style="color:white;font-size:30px;box-shadow: 0 0 10px rgba(0,0,0,0.6);background: rgb(79, 79, 79);padding: 15px;">    
         Feedback System | Feedback Co-ordinator Reports
    </span>
    </div>
	<br /><input type="button" onclick="location.href='fc_panel.php';" value="Go Back" /><br /><br />
    <div>

        <div class="college_department">
            <div class="college_report">
                <form action="report_results_college.php" method="POST">
                    <div>
                        <h1>College level report</h1>
                    </div>
                    <br />
                    <br />
                    <input type="submit" value="Show Report" />
                </form>
            </div>
            <div class="department_report">
                <form action="report_results_department.php" method="POST">
                    <div>
                        <h1>Department level report</h1>
                    </div>
                    <select name="selected_department" required="required">
                        <option value="">(Select)</option>
                        <option value="CS">CS</option>
                        <option value="IT">IT</option>
                        <option value="EC">EC</option>
                        <option value="EX">EX</option>
                        <option value="EI">EI</option>
                        <option value="CE">Civil</option>
                        <option value="ME">Mechanical</option>
                        <option value="TX">Textile</option>
                        <option value="AU">Automobile</option>
                    </select>
                    <br />
                    <br />
                    <input type="submit" value="Show Report" />
                </form>
            </div>

        </div>

        <div class="semester_faculty">
            <div class="semester_report">
                <form action="report_results_semester.php" method="POST">

                    <div>
                        <h1>Semester level report</h1>
                    </div>

                    <select name="selected_branch" required="required">
                        <option value="">(Select)</option>
                        <option value="CS">CS</option>
                        <option value="IT">IT</option>
                        <option value="EC">EC</option>
                        <option value="EX">EX</option>
                        <option value="EI">EI</option>
                        <option value="CE">Civil</option>
                        <option value="ME">Mechanical</option>
                        <option value="TX">Textile</option>
                        <option value="AU">Automobile</option>
                    </select>

                    <select name="selected_section" required="required">
                        <option value="">(Select)</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>

                    <select name="selected_sem" required="required">
                        <option value="">(Select)</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                    </select>
                    <br />
                    <br />
                    <input type="submit" value="Show Report" />

                </form>
            </div>

            <div class="faculty_report">
                <form action="report_results_faculty.php" method="POST">
                    <div>
                        <h1>Individual faculty report</h1>
                    </div>
                    <div>
                        <select name='selected_teacher' class="select_teacher" required="required">
                            <option value="">(Select)</option>
                            <?php
                            $query =  "SELECT `fid`,`tname` from teacher_report";
                            $query_result = mysql_query($query) or die(mysql_error());
                            
                            while($row = mysql_fetch_assoc($query_result))
                            {   
                                echo '<option value = '.$row['fid'].'>'.$row['tname'].'</option>';
                            }
                            ?>

                        </select>
                    </div>

                    <br />

                    <input type="submit" value="Show Report" />

                </form>
            </div>
        </div>
    </div>
	
</body>
</html>
