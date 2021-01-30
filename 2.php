<?php

function getCount()
{
	static $count = 0;
	$count ++;
	return $count;
}
echo getCount().'<br>';
echo getCount().'<br>';
echo getCount().'<br>';
