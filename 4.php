<?php
function multiplicationTable()
{
    $rows = 9;
    $cols = 9;

    for ($tr = 1; $tr <= $rows; $tr ++)

    {

        echo "<table  border='1' align='center' width='250' style='border-collapse: collapse;'>\n";

        echo "\t<tr>\n";

        for($td = 1;$td <=$cols; $td++)

        {

            echo "\t\t<td width='25'style='text-align: center;'>" .$tr * $td."</td>\n";

        }

        echo "\t</tr>\n";

    }

    echo "</table>";
}
multiplicationTable();