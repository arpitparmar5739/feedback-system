<?php
require('session.php');
require('verify.php'); //Admin check given in this script, no need to recheck

?>

<html>
<head>	
	<title>Admin Verification</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />

	<link href="css/signup.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
    
    <div id="logout">
        <a href="logout.php">
            <input type="button" value="Log Out" id="button" /></a>
    </div>
    
    <div class="container">

    <form action="" method="POST" id="signup">

        <div class="header">
        
            <h3>Verify Admin</h3>
            
            <p>Supply Admin ID : </p>
            
        </div>
        
        <div class="sep"></div>

        <div class="inputs">
        
			<input type="text" placeholder="Admin ID" name="id" autofocus required/>
			            
            <input type="submit" value="Verify" name="submit" id="submit">
			
        </div>

    </form>

</div>
</body>
</html>
