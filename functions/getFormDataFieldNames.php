<?php
//require_once 'database_connection.php';
function getFormDataFieldNames()
{
    $query = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='feedback_new' AND `TABLE_NAME`='form_data';";
    $query_result = mysql_query($query) or die(mysql_error());
    $ColumnNames = array();
    $i = 0;
    while($row = mysql_fetch_assoc($query_result))
    {
        $ColumnNames[$i] = $row["COLUMN_NAME"];
        $i++;
    }
    return $ColumnNames;
}    
?>