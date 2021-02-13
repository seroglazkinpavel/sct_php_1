<?php

function evenOdd()
{
    for($i = 0; $i <= 10; $i++){
        if($i == 0){			
			echo  "0 тоже четное число<br>";
        }elseif($i % 2 == 0){    
		    echo "$i - четное число <br>";
        }else echo "$i - не четное число <br>";
    }
}
evenOdd();
