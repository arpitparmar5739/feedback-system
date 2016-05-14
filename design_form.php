<?php

	require 'require.php';
	require 'session.php';
	
if(!isset($_SESSION['login_admin']))
{
	header('Location: index.php');
}
?>
<html>
<head>
    <title>Feedback | Design Form</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="chosen/docsupport/style.css">
	<link rel="stylesheet" href="chosen/docsupport/prism.css">
	<link rel="stylesheet" href="chosen/chosen.css">

    <style>
        body{
            background:#f0f0ff;
        }
        .container{
            
            margin-top:7%;
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
            width:70%;
            margin-left:auto;
            margin-right:auto;
            background:linear-gradient(rgb(238, 247, 255),rgb(193, 196, 217));
            border-radius:20px;
            padding:20px;
        }

        .div_upper{

            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size:20px;
        }

         .div_lower{

            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size:20px;
        }


        .select_div{
            display:inline-block; 
            margin:10px;
            /*border-left:1px solid black;
            border-right:1px solid black;*/
        }

        .text_skill{
            padding:9px;
            // width:25%;
            margin-bottom:10px;
            background:white;//linear-gradient(rgb(220, 229, 255),rgb(180, 192, 219));
            border:none;
            border-radius:10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.30);
            font-size:14px;
            font-weight:600;
        }

        .text_div{
            display:inline-block; 
            margin:10px;
        }

        .submit{
            margin-top:20px;
            padding:9px;
            width:10%;
            margin-bottom:10px;
            background:white;//linear-gradient(rgb(167, 167, 167),rgb(182, 255, 0));
            border:none;
            border-radius:10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.50);
            font-size:14px;
            font-weight:600;

        }

        .submit:hover{
            background:linear-gradient(rgb(64, 131, 255),rgb(129, 209, 212));
        }

    </style>


</head>
<body>

    <div id="logout">        
            <a href="logout.php"><input type="button" value="Log Out" id="button" /></a>
    </div>
	
    <?php
	if(isset($_POST['sem']))
    {
        $branch = $_POST['branch'];
        $section = $_POST['section'];
        $name = $_POST['form_name'];
        $rows = $_POST['no_teacher'];
        $sem = $_POST['sem'];
		
        $cols = 9;
        
		//Fetch data of all faculties
        $teacher_query = "SELECT * FROM teachers_info ORDER BY tname;";
        $teachers_result = mysql_query($teacher_query) or die(mysql_error());
        
        for($k = 0; $teacher[$k] = mysql_fetch_assoc($teachers_result); $k++) ;
        array_pop($teacher); //removing last empty element
		
		
		//Fetch data of all subjects
		$subject_query = "SELECT * FROM subjects ORDER BY scode;";
        $subjects_result = mysql_query($subject_query) or die(mysql_error());
        
        for($x = 0; $subject[$x] = mysql_fetch_assoc($subjects_result); $x++) ;
        array_pop($subject); //removing last empty element
    ?>

   


    <form action="submit_new_form.php" method="POST">
        <div class="container">
        <div class="div_upper">
            <center><p>
	       	: Select all Faculties below :
	        </p>
			</center>
        
		<?php
        for($i = 1  ;$i <= $rows; $i++)
        {
		?>
            <div class=select_div><span style="font-size:14px;"><?php echo $i; ?> : &nbsp;</span>                                            

                <select data-placeholder="Choose a Faculty.." name='f<?php echo $i; ?>' class="chosen-select" style="width:350px;text-align:left;" tabindex="2" required>
                <option value=""></option>
                <?php
					$j = 0;
					while($j<$k)
					{
						$fid = $teacher[$j]['fid'];
						$tname = $teacher[$j]['tname'];

                ?>
						<option value="<?php echo $fid; ?>"><?php echo $tname; ?> </option>
                <?php
						$j++;
					}
                ?>
				
                </select>
				
                <select data-placeholder="Choose a Subject.." name='s<?php echo $i; ?>' class="chosen-select" style="width:350px;" tabindex="2" required>
                <option value=""></option>
                <?php
					$j = 0;
					while($j<$x)
					{
						$sid = $subject[$j]['sid'];
						$sname = "(".$subject[$j]['scode'].") ".$subject[$j]['sname'];

                ?>
						<option value="<?php echo $sid; ?>"><?php echo $sname; ?> </option>
                <?php
						$j++;
					}
                ?>
                </select>
				
			</div>
        
		<?php	
        }	
        ?>
		
		</div>

            <input type="hidden" name='skill1' value="Command over subject with concepts"  />
            <input type="hidden" name='skill2' value="Communication skill in oral / black board / over head"  />
            <input type="hidden" name='skill3' value="Regularity / Availability"  />
            <input type="hidden" name='skill4' value="Behaviour / Helpful co-operative"  />
            <input type="hidden" name='skill5' value="Encouragement towards subject improvement"  />
            <input type="hidden" name='skill6' value="Attitude towards problems of students"  />
            <input type="hidden" name='skill7' value="Attentiveness towards assessment procedure / Evaluation of Tests"  />
            <input type="hidden" name='skill8' value="Guidance for exam point of view"  />
            <input type="hidden" name='skill9' value="Control over the class"  />

  
            <input type="hidden" name='branch' value="<?php echo $branch;?>" />
            <input type="hidden" name='section' value="<?php echo $section;?>" />
            <input type="hidden" name='name' value="<?php echo $name;?>" />
            <input type="hidden" name='sem' value="<?php echo $sem; ?>" />
            <input type="hidden" name='rows' value="<?php echo $rows;?>" />
            <input type="hidden" name='cols' value="<?php echo $cols;?>" />

            <input type="submit" value="Submit" class="submit" />
		</div>	
		
		
  <script src="chosen/jquery.min.js" type="text/javascript"></script>
  <script src="chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
		
    </form>
</body>
</html>
<?php
}
?>