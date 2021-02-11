<?php

function evenOdd()
{
    for($i = 0; $i <= 10; $i++){
        if($i % 2 == 0){
            echo "$i - четное число <br>";
        }else echo "$i - не четное число <br>";
    }
}
evenOdd();


