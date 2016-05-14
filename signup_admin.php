<?php

require 'require.php';
require('signup_script_admin.php');
?>

<html>
<head>	
	<title>Feedback | Sign-up</title>
	<link href="css/signup.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">

    <form action="" method="POST" id="signup">

        <div class="header">
        
            <h3>Feedback System Admin</h3>
            
            <p>Sign Up</p>
            
        </div>
        
        <div class="sep"></div>

        <div class="inputs">
        
			<input type="text" placeholder="Name" name="name" autofocus required/>
			
            <input type="text" placeholder="Username" name="username" required />
        
            <input type="password" placeholder="Password" name="password" required />
			
			<select name="dept" required>
                                        <option value="">(Select Department)</option>
                                        <option value="CS">CS</option>
                                        <option value="IT">IT</option>
                                        <option value="EC">EC</option>
                                        <option value="EX">EX</option>
                                        <option value="EI">EI</option>
                                        <option value="CE">CE</option>
                                        <option value="ME">ME</option>
                                        <option value="TT">TX</option>
                                        <option value="AU">AU</option>                                      
            </select>
            
            <div class="message">
                <p><?php echo $message; ?></p>
            </div>
            
            <input type="submit" value="SIGN UP" name="submit" id="submit">
        
        </div>

    </form>

</div>
</body>
</html>
