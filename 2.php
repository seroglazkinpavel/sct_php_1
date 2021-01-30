<?php

function getCount()
{
    static $coun = 0;
    $count ++;	
    return $count;
}
echo getCount().'<br>';
echo getCount().'<br>';
echo getCount().'<br>';
