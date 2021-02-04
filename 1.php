<?php
function GetDateFormat($str)
{
	$time = strtotime($str);
	$format = date("d-m-Y", $time);
	return $format;
}
 echo $format = GetDateFormat('2020-01-28');







