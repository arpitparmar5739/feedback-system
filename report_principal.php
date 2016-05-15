<?php

require 'session.php';

if(!isset($_SESSION['login_principal']))
{
	header('Location: index.php');
}

?>

<!doctype html>

<html>
<head>
    <title>
        Faculty Reports
    </title>
    <link type="text/css" rel="stylesheet" href="css/style_report.css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="logout">        
            <a href="logout.php"><input type="button" value="Log Out" id="button" /></a>        
    </div>
    <div class="main_heading">

    <div style="margin-bottom:20px;margin-top:-7px;">
        <img src="images/logo.png" />
    </div>
    </div>
    <div style="margin-top:-75px;margin-bottom:60px;font-family:sans serif;">
    <span style="color:white;font-size:30px;box-shadow: 0 0 10px rgba(0,0,0,0.6);background: rgb(79, 79, 79);padding: 15px;">    
         Feedback System | Principal Reports
    </span>
    </div>
    <div class="container">
        <div class="college_report">
            <form action="principal_college_report.php" method="POST">
                <div>
                    <h1>College level report</h1>
                </div>
                <input type="submit" value="Show Report" />
            </form>
        </div>
        <div class="department_report">
            <form action="principal_department_report.php" method="POST">
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
		
		<br /><br /><input type="button" onclick="location.href='principal_panel.php';" value="Go Back" />
		
    </div>
    <br />
    <br />
    <br />
    <script src="hiding_buttons.js"></script>
</body>
</html>