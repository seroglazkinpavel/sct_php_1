<?php
function mySort($a, $b)
{
	if($a == $b) {
	    echo 'Числа равны';
    }elseif($a > $b) {
        echo "$b $a";
    }else echo "$a $b";
}
  mySort(8, 4);







