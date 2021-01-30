<?php
$a = 24;
$first = $a;
function up(&$x, $t)
{
	global $first;
	$x = $x + $t;
	$fluct = $x - $first;
	return "Первоначальня температура $first, колебания $fluct, конечное состояние $x";
}

function down(&$x, $t)
{
	global $first;
	$x = $x - $t;
	$fluct = $x - $first;
	return "Первоначальня температура $first, колебания $fluct, конечное состояние $x";
}
echo up($a, 4).'<br>';

echo down($a, 5).'<br>';

echo up($a, 1).'<br>';

echo down($a, 2).'<br>';

