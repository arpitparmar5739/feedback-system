<?php

require 'require.php';
require('session.php');
if(!isset($_SESSION['login_admin']))
{
    header('Location: index.php');
}
?>

<html>
<head>
    <title>Feedback | New Form</title>
    <style>
        body {
            background: #f0f0ff;
        }
    </style>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; vertical-align: middle; text-align: center;">

    <div id="logout">
        <a href="logout.php">
            <input type="button" value="Log Out" id="button" /></a>
    </div>

    <div style="background: linear-gradient(rgb(255, 255, 255),rgba(0, 0, 0, 0.10)); padding: 20px; width: 70%; margin: auto; margin-top: 50px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.6); border-radius: 20px;">

        <h2>
            <u>New Feedback Form</u>
        </h2>

        <form id="create" action="design_form.php" method="post">

            <p>

                <table style="margin: auto">
                    <tr>
                        <td>Branch : </td>
                        <td>
                            <div style="background:white;width:65px;">
                                <input type="text" name="branch" value="<?php echo $row_admin['dept']; ?>" readonly />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Section </td>
                        <td>
                            <select name="section" required>
                                <option value="">(Select)</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Sem 
                        </td>
                        <td>
                            <input type="number" name="sem" min=0 max=8 required/>
                        </td>
                    </tr>
                </table>
            </p>

            <div style="padding: 10px; margin: auto; box-shadow: 0 0 5px rgba(0, 0, 0, 0.6); border-radius: 20px;">
                <table style="margin: auto">
                    <tr>
                        <td>Number of Faculties :</td>
                        </td>
                                <td>
                                    <input type="number" name="no_teacher" min=0 max=20 required />
                    </tr>
					
					<!--<input type="hidden" name="no_skill" value="9" />-->
                    <!--<tr>
                                <td>Number of Skills :</td>
                                <td><input type="number" name="no_skill" required /></td>
                            </tr>-->

                </table>
            </div>

            <p>
                <input type="reset" value="Clear" />
                <input type="submit" value="Create Form" />
            </p>
			<input type="button" onclick="location.href='admin_panel.php';" value="Back to Admin Panel" />

        </form>

    </div>
</body>
</html>
