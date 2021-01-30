<?php
$count = 0;
function getCount()
{
    global $count;
    $count ++;
    return $count;
}
echo getCount().'<br>';
echo getCount().'<br>';
echo getCount().'<br>';
echo getCount().'<br>';


