<?php
function mySort($a, $b)
{
	if($a == $b) {
	    echo 'Числа равны';
    }elseif($a > $b){
		for($i = $b; $i <= $a; $i++){
			echo $i.'<br>';
		}
	}else {
		for($i = $a; $i <= $b; $i++){
			echo $i.'<br>';
	    }
	}
}
  mySort(8, 14);