<?php 
require 'require.php';
require 'session.php';
require 'functions/getFormDataFieldNames.php';

$skillStartIndex = 4;
$totalSkills = 9;


if (!isset($_SESSION['login_student'])) {
    header('Location: index.php');
} else if (!isset($_SESSION['form_id'])) {
    die("Invalid submission ! This site needs a cookie enabled browser to submit this form.");
}

//  To check for the student counter whether it is 1 or 0  
    $student_counter = $row_student['counter'];
    if($student_counter == 1)
    {
        die("Only one time submission allowed !");
    }	
    $student_counter = 1;
    $student_counter_plus_query = 'UPDATE students_login SET counter = '.$student_counter.' WHERE `enrollno` = "'.$login_session.'";';
    $student_counter_update = mysql_query($student_counter_plus_query) or die(mysql_error());

//Setting Form id
$form_id = $_SESSION['form_id'];

//Setting table name
$table_name = "form_data"; /**** At the end this should be removed ****/


//  Very important lock query for locking the tables to ensure single submission at one time.
$lock_query = 'LOCK Tables form_data WRITE, feedback_forms WRITE, teacher_report WRITE ,form_comments WRITE;';
$lock_result = mysql_query($lock_query);
if(mysql_error())
{
    die("<br />Something went wrong. Error Code : 1<br />");
}

//Making the AUTOCOMMIT value to be 0
mysql_query('SET AUTOCOMMIT=0') or die("AutoCommit cannot be turned OFF 0_o");


if(!empty($_POST["comment"]))
{
    $comment = mysql_real_escape_string(htmlentities($_POST["comment"])); 
	if(!mysql_query("INSERT INTO form_comments (`form_id`,`comment`) VALUES($form_id,'$comment')"))
    {       
        echo "<strong>Note : Your comment was not submitted!!!</strong>";
    }
}


$query = "SELECT `index`,`fid` FROM form_data WHERE form_id=$form_id";
$result = mysql_query($query);
if(mysql_error())
{
    echo mysql_error();
    die("<br />Something went wrong. Error Code : 1024<br />");
}

$numfields = mysql_num_fields($result);
$columns = getFormDataFieldNames();
$average_column_name = $columns[$numfields - 1];
$index_column_name = $columns[0];
$fid_column_name = $columns[2];
$rowNo = array();

if (mysql_num_rows($result) > 0) {
    $counter = 0;
    while ($row = mysql_fetch_assoc($result)) {
        $index[$counter] = $row[$index_column_name];
        $fid[$counter] = $row[$fid_column_name];
        $counter++;
    }
}

$skill_values = array($index);
$select_names = array(array(),array());
$totalRows = count($index);
$values_fd = array();
$values_tr = array();

for ($i = 0; $i < $totalRows; $i++) {
    for ($j = 0; $j < $totalSkills; $j++) {
        $select_names[$i][$j] = $skill_values[0][$i].'_'.($j+1);
        if (!isset($_POST[$select_names[$i][$j]]) or !($_POST[$select_names[$i][$j]] == 20
        or $_POST[$select_names[$i][$j]] == 40
        or $_POST[$select_names[$i][$j]] == 60
        or $_POST[$select_names[$i][$j]] == 80
        or $_POST[$select_names[$i][$j]] == 100)) 
        {
            if (session_destroy()) 
            {
                
            }
            
            die("<div style='font-size:40px;width:70%;margin:20px auto 20px auto;box-shadow:0 0 10px black;text-align:center;padding:20px;'>
                    <p>Something went wrong while submitting the data!!! <br />
                        if you have done anything in the code then you will not be allowed to give feedback again!!!<br /><br />
                        Be Honest Next Time...
                    </p>
                    <p>
                        You have been logged out !
                    </p>
	                <a href='index.php'><input type='button' style='width:50px;height:30px;' value='Login' id='button' /></a><br />
                </div>");
        }
        else 
        {
            $values_fd[$i][$j] = $_POST[$select_names[$i][$j]];
            $values_tr[$i][$j] = $values_fd[$i][$j];     
        }
    }
}

//All values have been stored successfully i have an idea to make this thing even faster by storing the values as average where fid repeats.
//But i am too lazy to do that now so i will do it later or never by the way this thing is also fast enough.

//Updating the form_data table.
$counter_fd_query = "SELECT `counter`,`session` FROM feedback_forms WHERE form_id=$form_id";
$counter_fd = (mysql_fetch_assoc(mysql_query($counter_fd_query))["counter"]);
$year = (mysql_fetch_assoc(mysql_query($counter_fd_query))["session"]);
$query_fd = "SELECT `index`,`$columns[$skillStartIndex]`,`$columns[5]`,`$columns[6]`,`$columns[7]`,`$columns[8]`
                    ,`$columns[9]`,`$columns[10]`,`$columns[11]`,`$columns[12]` 
                    FROM form_data WHERE form_id=$form_id";
$result_fd = mysql_query($query_fd) or die(mysql_error()); 

$i = 0;
while($row = mysql_fetch_assoc($result_fd))
{
    $final_value_1 = ($row[$columns[4]]*$counter_fd+$values_fd[$i][0])/($counter_fd+1);
    $final_value_2 = ($row[$columns[5]]*$counter_fd+$values_fd[$i][1])/($counter_fd+1);
    $final_value_3 = ($row[$columns[6]]*$counter_fd+$values_fd[$i][2])/($counter_fd+1);
    $final_value_4 = ($row[$columns[7]]*$counter_fd+$values_fd[$i][3])/($counter_fd+1);
    $final_value_5 = ($row[$columns[8]]*$counter_fd+$values_fd[$i][4])/($counter_fd+1);
    $final_value_6 = ($row[$columns[9]]*$counter_fd+$values_fd[$i][5])/($counter_fd+1);
    $final_value_7 = ($row[$columns[10]]*$counter_fd+$values_fd[$i][6])/($counter_fd+1);
    $final_value_8 = ($row[$columns[11]]*$counter_fd+$values_fd[$i][7])/($counter_fd+1);
    $final_value_9 = ($row[$columns[12]]*$counter_fd+$values_fd[$i][8])/($counter_fd+1);
    $index = $row[$index_column_name];
    
    $query = "UPDATE form_data SET `$columns[4]`=$final_value_1,`$columns[5]`=$final_value_2
                ,`$columns[6]`=$final_value_3,`$columns[7]`=$final_value_4,
                `$columns[8]`=$final_value_5,`$columns[9]`=$final_value_6
                ,`$columns[10]`=$final_value_7,`$columns[11]`=$final_value_8
                ,`$columns[12]`=$final_value_9 WHERE `index`=$index";
    $result = mysql_query($query);
    if(mysql_error())
    {
        echo mysql_error();
        die("<br />Something went wrong. Error Code : 1025<br />");
    }            
    $i++; 
}
//For updating the counter of the feedback_forms Right now it is commented because it is made to update at the last when 
//auto commit is set equal to 1 again at the end.
//$counter_fd++;
//$query_fdCounter_update = "UPDATE feedback_forms SET counter=$counter_fd WHERE form_id=$form_id";
//$counter_update = mysql_query($query_fdCounter_update) or die("<br />Something went wrong. Error Code : 1026<br />");
//form_data table updated above now lets update the teacher_report
/*
$query = "SELECT teacher_report.`fid`,`counter`,teacher_report.`$columns[4]`,teacher_report.`$columns[5]`,teacher_report.`$columns[6]`
        ,teacher_report.`$columns[7]`,teacher_report.`$columns[8]`,teacher_report.`$columns[9]`,teacher_report.`$columns[10]`,
            teacher_report.`$columns[11]`,teacher_report.`$columns[12]`,form_data.`index` FROM teacher_report,form_data WHERE teacher_report.`fid`=$fid[0] 
            AND form_data.`form_id`=$form_id ORDER BY form_data.`index`";
*/
//Updated Query
$query = "SELECT teacher_report.`fid`,`counter`,teacher_report.`$columns[4]`,teacher_report.`$columns[5]`,teacher_report.`$columns[6]`
        ,teacher_report.`$columns[7]`,teacher_report.`$columns[8]`,teacher_report.`$columns[9]`,teacher_report.`$columns[10]`,
            teacher_report.`$columns[11]`,teacher_report.`$columns[12]` FROM teacher_report WHERE teacher_report.`fid`=$fid[0] AND `session`=$year";

$result_tr = mysql_query($query) or die(mysql_error());
$i=0;
while($row = mysql_fetch_assoc($result_tr))
{
    $counter_tr = $row["counter"];
    $fid_tr = $row["fid"];
    $final_value_1 = ($row[$columns[4]]*$counter_tr+$values_tr[$i][0])/($counter_tr+1);
    $final_value_2 = ($row[$columns[5]]*$counter_tr+$values_tr[$i][1])/($counter_tr+1);
    $final_value_3 = ($row[$columns[6]]*$counter_tr+$values_tr[$i][2])/($counter_tr+1);
    $final_value_4 = ($row[$columns[7]]*$counter_tr+$values_tr[$i][3])/($counter_tr+1);
    $final_value_5 = ($row[$columns[8]]*$counter_tr+$values_tr[$i][4])/($counter_tr+1);
    $final_value_6 = ($row[$columns[9]]*$counter_tr+$values_tr[$i][5])/($counter_tr+1);
    $final_value_7 = ($row[$columns[10]]*$counter_tr+$values_tr[$i][6])/($counter_tr+1);
    $final_value_8 = ($row[$columns[11]]*$counter_tr+$values_tr[$i][7])/($counter_tr+1);
    $final_value_9 = ($row[$columns[12]]*$counter_tr+$values_tr[$i][8])/($counter_tr+1);
    
    $counter_tr++;
    $query_tr_update = "UPDATE teacher_report SET `counter`=$counter_tr,`$columns[4]`=$final_value_1,`$columns[5]`=$final_value_2,
                        `$columns[6]`=$final_value_3,`$columns[7]`=$final_value_4,`$columns[8]`=$final_value_5,
                        `$columns[9]`=$final_value_6,`$columns[10]`=$final_value_7,`$columns[11]`=$final_value_8,
                        `$columns[12]`=$final_value_9 WHERE `fid`=$fid_tr AND `session`=$year";
    $result_tr_update = mysql_query($query_tr_update) or die(mysqli_error());
    $i++;
    
    if($i >= $totalRows)
    {
        break;
    }
    /*
    $query = "SELECT teacher_report.`fid`,`counter`,teacher_report.`$columns[4]`,teacher_report.`$columns[5]`,teacher_report.`$columns[6]`
        ,teacher_report.`$columns[7]`,teacher_report.`$columns[8]`,teacher_report.`$columns[9]`,teacher_report.`$columns[10]`,
            teacher_report.`$columns[11]`,teacher_report.`$columns[12]`,form_data.`index` FROM teacher_report,form_data WHERE teacher_report.`fid`=$fid[$i] 
            AND form_data.`form_id`=$form_id ORDER BY form_data.`index`";
    */
    //Updated Query
    $query = "SELECT teacher_report.`fid`,`counter`,teacher_report.`$columns[4]`,teacher_report.`$columns[5]`,teacher_report.`$columns[6]`
        ,teacher_report.`$columns[7]`,teacher_report.`$columns[8]`,teacher_report.`$columns[9]`,teacher_report.`$columns[10]`,
            teacher_report.`$columns[11]`,teacher_report.`$columns[12]` FROM teacher_report WHERE teacher_report.`fid`=$fid[$i] AND `session`=$year";
    $result_tr = mysql_query($query) or die(mysql_error());
}

//Here Auto Commit is being set equal to 1
mysql_query('SET AUTOCOMMIT=1');
$counter_fd++;
$query_fdCounter_update = "UPDATE feedback_forms SET counter=$counter_fd WHERE form_id=$form_id";
$counter_update = mysql_query($query_fdCounter_update) or die("<br />Something went wrong. Error Code : 1026<br />");
?>

<html>

<head>
    <title>Thank You!</title>
</head>

<body>
    <div style="margin:auto; margin-top:50px ; text-align:center ; box-shadow:0 0 5px rgba(0,0,0,0.7) ; border-radius:20px ; width:60% ; padding:20px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
        <h2> Thank you for your valuable Feedback !</h2> 
<?php 
if (session_destroy()) // Destroying All Sessions
{
        echo "<p>You have been logged out !</p>
        <a href='index.php'>
            <input type='button' value='Login' id='button' />
        </a>"; 
}
mysql_close($conn);
?>
    </div>
</body>
</html>