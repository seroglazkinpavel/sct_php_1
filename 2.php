<?php
function getResult($a, $b, $result)
{
    switch ($result) {
        case 'sum':
            echo $a + $b;
            break;
        case 'sub':
            echo $a - $b;
            break;
        case 'mult':
            echo $a * $b;
            break;
        case 'div':
            If($b == 0){
                echo 'На 0 делить нельза';
            }elseif($b != 0) {
                echo $a / $b;
            }
            break;
        default:
            echo "Такого математического действия нет";
    }
}
getResult(4, 1, 'div');
