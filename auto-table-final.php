<?php
	require 'require.php';
	require 'session.php';
	
	if(!isset($_SESSION['login_student']) && !isset($_SESSION['form_id']))
	{
		header('Location: index.php');
	}

    $form_id = $_SESSION['form_id'];
    $table_name = "form_data";

    $form_name_query = "SELECT `form_name` FROM feedback_forms WHERE form_id=$form_id;";
    $name_result = mysql_query($form_name_query) or die(mysql_error());
    $name_array = mysql_fetch_assoc($name_result);
    $form_name = $name_array['form_name'];

    $query = "SELECT * FROM form_data WHERE form_id=$form_id";
    $result=mysql_query($query);
    $numfields = mysql_num_fields($result);
    $total_skills = 9;
    $firstSkill = "Command_over_subject_with_concepts";
    $indexColumn = 1;
?>

        <html>
        <head>
            <title>Feedback Form</title>
            <link href="css/style.css" rel="stylesheet" type="text/css" />
            <link href="css/style_information_fof.css" rel="stylesheet" type="text/css" />
            <link href="css/auto_table_final.css" rel="stylesheet" type="text/css" />
        </head>
        <body style="background:#d6d6ff;padding:15px;">

        <div style="margin:auto; margin-top:-10px ; text-align:center ;">
        <span style="font-size:40px;font-weight:bold;text-shadow:0 1px 2px black;"><img src="images/logo.png" /><!-- Shri Vaishnav Institute Of Technology And Science, Indore --></span>
        <!-- <h1 style="margin-top:-20px;">Feedback Form</h1> -->
        <h2 style="margin-top:5px;margin-bottom:-10px;">----- <?php echo $form_name; ?> -----</h2>

        <form action="feedback-submission.php" method="POST">

<?php
    require "functions/getFormDataFieldNames.php";

    echo '<div class=CSSTableGenerator id=table><table style="">'."\n".'<tr>';
    echo '<th>Teachers</th>';
    echo '<th>Subject</th>';
    
    $columns = getFormDataFieldNames();
    
    for($i = 0 ; $i < $numfields-1 ; $i++)
    {
        if($columns[$i] == $firstSkill)
            break;    
    }
    
    $skillStartIndex = $i;      /*  To get the starting index of the skills  */
    
    for ($j = $skillStartIndex ; $j < $total_skills + $skillStartIndex; $j++) // Header
    { 
        echo '<th width="200px">'.str_replace('_',' ',$columns[$j]).'</th>'; 
    }

    echo "</tr>\n";
    $index_column_name = $columns[$indexColumn-1];
    $teacher_column_name = "tname";
    $subject_column_name = "sname";
    $fid_column_name = $columns[2];
    $sid_column_name = $columns[3];
    
    $query = "SELECT a.index, b.tname, c.sname FROM form_data a, teachers_info b, subjects c WHERE b.fid=a.fid AND c.sid=a.sid AND a.form_id=$form_id";
    //$result = mysql_query($query) or die(mysql_error());
    
    if($result = mysql_query($query))
    {
        if (mysql_num_rows($result) > 0)
        {
            while($row = mysql_fetch_assoc($result))
            {
                //echo '<tr><td>'.$row[$tid_column_name].'</td>';
                echo '<tr><td>'.$row[$teacher_column_name].'</td>';
                echo '<td>'.$row[$subject_column_name].'</td>';
                
                for($i=1 ; $i<=$total_skills ; $i++)
                {
                    /*
                    * Add here if you want to add the option of the select box in the form
                    * or if you want to add something else to all the select boxes in the 
                    * dynamically generated feedback page.                         
                    */

                    echo '<td><select name='.$row[$index_column_name].'_'.$i.' required> 
                                <option value=""></option>
                                <option value="20">1</option>
                                <option value="40">2</option>
                                <option value="60">3</option>
                                <option value="80">4</option>
                                <option value="100">5</option>
                                </select></td>';                       
                }
            }
        }
    }

    else
    {        
        echo "Error : Could not run query!!!";
    }
    echo "</table></div>\n"
?>
        <br />
        <textarea rows="4" cols="100" placeholder="Comments(optional)" name="comment" style="box-shadow:0 0 5px black;padding:10px;margin-top:20px;font-size:14px;font-family:'Times New Roman';" /></textarea><br /><br />
        <strong>Note : Values can not be changed once you hit the Submit button !</strong><br /><br />
        <input type="submit" value="Submit Feedback" style="width:250px;height:40px;font-size:20px;" class="submit_button" id="submit_button_id" onclick="" />
        </form>

        
    
        <div id="information_and_fof_id" class="information_and_fof_class">
                <div id="sliding_button">
                    <img src="images/info_arrow.png" id="sliding_button_image_id" width=40 height=40 class="sliding_button_image" onclick="sliding()" />
                </div>
                <div style="margin-top:-20px;font-size:40px;">
                    <strong>INSTRUCTIONS</strong>
                    <hr style="color:white;" />
                </div>
                <div class="information_container">
                    <div class="information_of_info_box">
                    <div style="text-align:center;"><b>(1)</b><hr /></div>
                        Each section can be rated as follows :
                        <ul>
                            <li>1 : Very Bad</li>
                            <li>2 : Bad</li>
                            <li>3 : Good</li>
                            <li>4 : Very Good</li>
                            <li>5 : Excellent</li>
                        </ul>
                    </div>
                    <div class="information_of_info_box">
                    <div style="text-align:center;"><b>(2)</b><hr /></div>
                        Comments are optional and are submitted completely <b>Anonymously</b>.
                        <br />
                        Means your identity is not stored while submitting your comment, <b>comments are submitted completely anonymously</b>.
                        <br />
                        <br />
                    </div>
                    <div class="information_of_info_box">
                    <div style="text-align:center;"><span style="font-size:25px;"><b>Note</b></span><hr /></div>
                        You can not change the values once you click the <b>"Submit Feedback"</b> button.
                        <br />
                        <br />
                    </div>
                </div>
            </div>

        </div>


        <script>
            function sliding()
            {
                var sliding_div = document.getElementById("information_and_fof_id");
                var sliding_div_button = document.getElementById("sliding_button_image_id");
                
                sliding_div.classList.toggle("information_and_fof_class");
                sliding_div.classList.toggle("information_and_fof_class_active");

                sliding_div_button.classList.toggle("sliding_button_image");
                sliding_div_button.classList.toggle("sliding_button_image_active");

            }

        </script>

        </body>
        </html>