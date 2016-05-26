<style>
   
    table
    {
        border:1px solid black;
        border-collapse : collapse;
        margin-left: auto;
        margin-right : auto;
        page-break-inside:auto
    }
    thead ,td, th 
    {
        padding: 20px 70px;
        border-bottom : 1px solid black;
        page-break-inside:avoid; 
        page-break-after:auto;
    }
    thead 
    { 
        display:table-header-group;
        border : 1px solid black;        
    }
    tfoot { display:table-footer-group; }
</style>
<?php

require '../require.php';
require '../session.php';
if(!isset($_SESSION['login_fc']) and !isset($_SESSION['login_admin']))
{
    header('Location: ../index.php');
}
?>


<?php
    require "../database_connection.php";
    require "createTable.php";
    
    if(isset($_POST["submit"]))
    {
        if(isset($_POST["selected_branch"]) && isset($_POST["selected_section"]) && isset($_POST["selected_sem"]))
        {
            $branch = $_POST["selected_branch"];
            $section = $_POST["selected_section"];
            $sem = $_POST["selected_sem"];
            
            $query = "SELECT `enrollno`,`password`,`branch`,`section`,`sem` FROM students_login WHERE
                      `branch`='$branch' AND `sem`=$sem AND `section`='$section'";
            $result = mysql_query($query) or die(mysql_error());
            $table = array(array());
            $table[0] = ["Username","Password","Branch","Section","Sem"];
            $i=1;
            while($row = mysql_fetch_array($result,MYSQL_NUM))
            {
                $table[$i] = $row;
                $i++;
            }
            createTable($table,TRUE);
        }
        else 
        {
            echo "something went wrong!";
        }
    }
    else 
    {
?>
    <form action="uidpass.php" method="POST">
        <div>
            <h1>Uid Passwords</h1>
        </div>

        <select name="selected_branch" required="required">
            <option value="">(Select)</option>
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
        <input type="submit" name="submit" />
    </form>
<?php
    }
?>