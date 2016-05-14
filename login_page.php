<?php

require 'require.php';
include('login.php');

if(isset($_SESSION['login_student']))
{
	header('Location: student_panel.php');
}
else if(isset($_SESSION['login_admin']))
{
	header('Location: admin_panel.php');
}
else if(isset($_SESSION['login_fc']))
{
	header('Location: fc_panel.php');
}
else if(isset($_SESSION['login_principal']))
{
	header('Location: principal_panel.php');
}

?>

<!DOCTYPE html>
<html style="height:100%;margin:0;">
<head>
<meta charset="utf-8">
<title>Feedback | Login</title>
<link rel="stylesheet" type="text/css" href="css/login.css" />
</head>
<body style="text-align:center;background:linear-gradient(rgb(234, 241, 255),rgb(149, 185, 255)) no-repeat;background-position:fixed;margin:0;">

    <div style="">
        <img src="images/logo.png" style="margin:0 auto 0 auto;" />
    </div>

    <div class="container" style="margin-bottom:25px;">
	    <section id="content">

		    <form action="login_page.php" method="POST">
			    <h1>Feedback System Login</h1>
			    <div>
				    <input type="text" name="username" placeholder="Username" required="" id="username" />
			    </div>
			    <div>
				    <input type="password" name="password" placeholder="Password" required="" id="password" />
			    </div>
			    <div>
				    <input type="submit" name="submit" value="Log in" />
			    </div>
		    </form>
    </div>

	<div style="background:linear-gradient(white,rgb(210,255,255));width:70%;margin:0 auto 0 auto;border-radius:10px;padding:5px;box-shadow:0 0 2px black;text-shadow:0 0 0.5px black;">
    
	<div style="width:30%;margin:0px auto 0 auto;">
		<div style="color:#b22222;font-weight:bold;font-size:20px;">
			Vision of SVITS
		</div>
		<div>
			"Develop SVITS as a global brand by 2025."
		</div>
    </div>

	<hr />

	<div style="width:90%;margin:0 auto 0 auto;">
		<div style="color:#b22222;font-weight:bold;font-size:20px;">
			Mission of SVITS
		</div>
		<div>
			"To be a globally recognized premier technical Institute that produces engineers, technical innovators and entrepreneurs, imparts quality technical education and inculcate ethical values among students to enhance employability and accept challenges for the benefit of the society"
		</div>
    </div>
	</div>

<div style="position:fixed;bottom:6%;font-weight:bold;left:5px;padding:10px;font-size:15px;background:linear-gradient(white,rgb(210,255,255));border-radius:10px;box-shadow:0 0 2px black;text-shadow: 0 0 0.5px rgba(0,0,0,0.3);">
	<div style="color:#b22222;font-weight:bold;font-size:15px;">
			The Developers :
		</div><hr />
	Arpit Parmar<br /><br />
	Aditya Sharma
</div>

<div style="position:fixed;bottom:6%;font-weight:bold;right:5px;padding:10px;font-size:13px;background:linear-gradient(white,rgb(210,255,255));border-radius:10px;box-shadow:0 0 2px black;">
	<div style="color:#b22222;font-weight:bold;font-size:13px;">
			The Mentors :
		</div><hr />
	Mr. Anand Singh<br />Rajawat<br /><br />
	Mr. Chetan Chouhan
</div>

<div style="position:fixed;bottom:0;background:white;font-size:13px;left:0;right:0;widht:30%;margin:0 auto 0 auto;padding:2px;">
	<b>( A Creation of Software Development Cell SVITS, Indore )</b>
</div>

</body>
</html>