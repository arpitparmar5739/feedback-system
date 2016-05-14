<?php
require('session.php');

if(!isset($_SESSION['login_fc']))
{
    header('Location: index.php');
}
?>
<html>
<head>
    <title>Feedback System</title>
    <script>
        function custom_print() {
            var print_button = document.getElementById("print_button");
            print_button.style.display = "none";
            window.print();
            print_button.style.display = "block";
        }
    </script>
    
    <link href="css/style.css" rel="stylesheet" type="text/css" />

	<style type="text/css" media="print">
		@page {
			size:"landscape";
		}
	</style>
	
    <style>
        html {
            font-size: 10px;
        }

        body {
            text-align: center;
            padding:10px;
        }

        table {
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
            border: 2px groove black;
            word-wrap: break-word;
            table-layout: fixed;
        }

        th {
            font-size: 16px;
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 3px solid black;
            height: 40px;
            padding: 5px;
            width: 200px;
        }

        td {
        }

        TableGenerator {
            padding: 0;
            //width:100%;
            box-shadow: 10px 10px 5px #888888;
            border: 1px solid #000000;
            -moz-border-radius-bottomleft: 0px;
            -webkit-border-bottom-left-radius: 0px;
            border-bottom-left-radius: 0px;
            -moz-border-radius-bottomright: 0px;
            -webkit-border-bottom-right-radius: 0px;
            border-bottom-right-radius: 0px;
            -moz-border-radius-topright: 0px;
            -webkit-border-top-right-radius: 0px;
            border-top-right-radius: 0px;
            -moz-border-radius-topleft: 0px;
            -webkit-border-top-left-radius: 0px;
            border-top-left-radius: 0px;
        }

        .CSSTableGenerator table {
            border-collapse: collapse;
            border-spacing: 0;
            //width:100%;
            //height:100%;
            padding: 0px;
        }

        .CSSTableGenerator tr:last-child td:last-child {
            -moz-border-radius-bottomright: 0px;
            -webkit-border-bottom-right-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .CSSTableGenerator table tr:first-child td:first-child {
            -moz-border-radius-topleft: 0px;
            -webkit-border-top-left-radius: 0px;
            border-top-left-radius: 0px;
        }

        .CSSTableGenerator table tr:first-child td:last-child {
            -moz-border-radius-topright: 0px;
            -webkit-border-top-right-radius: 0px;
            border-top-right-radius: 0px;
        }

        .CSSTableGenerator tr:last-child td:first-child {
            -moz-border-radius-bottomleft: 0px;
            -webkit-border-bottom-left-radius: 0px;
            border-bottom-left-radius: 0px;
        }

        .CSSTableGenerator tr:hover td {
        }

        .CSSTableGenerator tr:nth-child(odd) {
            background-color: #d6d6ff;
        }

        .CSSTableGenerator tr:nth-child(even) {
            background-color: #ffffff;
        }

        .CSSTableGenerator td {
            vertical-align: middle;
            border: 1px solid black;
            border-width: 0px 1px 1px 0px;
            text-align: left;
            padding: 7px;
            font-size: 14px;
            font-family: Arial;
            font-weight: normal;
            color: #000000;
        }

        .CSSTableGenerator tr:last-child td {
            border-width: 0px 1px 0px 0px;
        }

        .CSSTableGenerator tr td:last-child {
            border-width: 0px 0px 1px 0px;
        }

        .CSSTableGenerator tr:last-child td:last-child {
            border-width: 0px 0px 0px 0px;
        }

        .CSSTableGenerator tr:first-child td {
            background: -o-linear-gradient(bottom, #aaaaff 5%, #5656ff 100%);
            background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #aaaaff), color-stop(1, #5656ff) );
            background: -moz-linear-gradient( center top, #aaaaff 5%, #5656ff 100% );
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#aaaaff", endColorstr="#5656ff");
            background: -o-linear-gradient(top,#aaaaff,5656ff);
            background-color: #aaaaff;
            border: 0px solid #000000;
            text-align: center;
            border-width: 0px 0px 1px 1px;
            font-size: 14px;
            font-family: Trebuchet MS;
            font-weight: bold;
            color: #ffffff;
        }

        .CSSTableGenerator tr:first-child:hover td {
            background: -o-linear-gradient(bottom, #aaaaff 5%, #5656ff 100%);
            background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #aaaaff), color-stop(1, #5656ff) );
            background: -moz-linear-gradient( center top, #aaaaff 5%, #5656ff 100% );
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#aaaaff", endColorstr="#5656ff");
            background: -o-linear-gradient(top,#aaaaff,5656ff);
            background-color: #aaaaff;
        }

        .CSSTableGenerator tr:first-child td:first-child {
            border-width: 0px 0px 1px 0px;
        }

        .CSSTableGenerator tr:first-child td:last-child {
            border-width: 0px 0px 1px 1px;
        }
    </style>

</head>

<?php 

$department = $_POST["selected_department"];


?>

<body>

    <div id="logout">        
            <a href="logout.php"><input type="button" value="Log Out" id="button" /></a>        
    </div>

    <button style="position: fixed; left: 10px; top: 10px;" onclick="custom_print()" id="print_button">Print</button>
    <div style="text-align: center; margin-top: 1%;">
        <h1 style="font-size: 35px;"><?php echo $department; ?> Department Faculty Feedback</h1>
    </div>


    <?php                      
    require 'database_connection.php';

    echo '<div style = "font-weight:bold;font-size:15px;">Date :- '.date("d/m/Y",time()).'</div>';


    $query = "SELECT * FROM teacher_report WHERE `branch` = '".$department."' ORDER BY avg DESC";
    $result=mysql_query($query);
    $numfields = mysql_num_fields($result);


    echo '<div class=CSSTableGenerator><table>'."\n".'<tr>';
    $columns = array();

    echo '<th>S.No.</th>';
    echo '<th>Faculty-ID</th>';
    echo '<th>Teacher Name</th>';
    echo '<th>Branch</th>';
    echo '<th>Total no. of students given feedback</th>';
    for ($i=3; $i < $numfields-1; $i++) // Header
    { 
        if($i>=3 && $i!=3){/*for not displaying the id of the teachers.*/
            echo '<th>'.str_replace('_',' ',mysql_field_name($result, $i)).'</th>'; 
            //$columns[$i] = mysql_field_name($result, $i);
        }
    }
    echo '<th>Average</th>'; 

    for ($i=0; $i < $numfields; $i++) // Header
    { 
        $columns[$i] = mysql_field_name($result, $i);
    }




    if($result = mysql_query($query))
    {
        $j =1 ;
        while($row = mysql_fetch_assoc($result)) // Header
        { 
            echo '<tr>';
            echo '<td>'.$j.'</td>';
            for ($i=0; $i < $numfields; $i++)
            {           
                //if($i!=3)
                {
                    echo '<td>'.$row[$columns[$i]].'</td>';
                }            
            }
            echo '</tr>';
            $j++;
        }
    }
    echo '</table>';


    ?>

    <div style="margin-top: 100px; font-size: 20px;">
        Signature<br />
        Feedback Co-ordinator<br />
        SVITS, Indore
    </div>
<script src="hiding_buttons.js"></script>
</body>
</html>
