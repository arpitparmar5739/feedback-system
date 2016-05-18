<?php
    function createTable($table,$headerBool)
    {
        $NumRows = count($table);
        $NumColumns = count($table[0]);
        if($headerBool==true)
        {
            $headElement = "th";
        }
        else
        {
            $headElement = "td";
        }
        echo "<table>";
        echo "<tr>";
        for($i=0 ; $i < $NumColumns ; $i++)
        {
            $header = $table[0][$i];
            echo "<$headElement>$header</$headElement>";
        }
        echo "</tr>";
        
        for($i=1; $i<$NumRows ; $i++)
        {
            echo "<tr>";
            for($j=0; $j < $NumColumns ; $j++)
            {
                $tData = $table[$i][$j];
                echo "<td>$tData</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
?>