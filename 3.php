<?php
$x = "";
var_dump($c = empty($x));// bool(true)
echo '<br>';
$x = null;
var_dump($c = empty($x));// bool(true)
echo '<br>';
$x;
var_dump($c = empty($x));// bool(true)
echo '<br>';
$X;
var_dump($c = empty($x));// bool(true)
echo '<br>';
$x = array();
var_dump($c = empty($x));// bool(true)
echo '<br>';
$x = array('a', 'b');
var_dump($c = empty($x));// bool(false)
echo '<br>';
$x = "0";
var_dump($c = empty($x));// bool(true)
echo '<br>';
$x = false;
var_dump($c = empty($x));// bool(true)
echo '<br>';
$x = true;
var_dump($c = empty($x));// bool(false)
echo '<br>';
$x = 1;
var_dump($c = empty($x));// bool(false)
echo '<br>';
$x = 42;
var_dump($c = empty($x));// bool(false)
echo '<br>';
$x = 0;
var_dump($c = empty($x));// bool(true)
echo '<br>';
$x = -1;
var_dump($c = empty($x));// bool(false)
echo '<br>';
$x = 1;
var_dump($c = empty($x));// bool(false)
echo '<br>';
$x = "1";
var_dump($c = empty($x));// bool(false)
echo '<br>';
$x = "-1";
var_dump($c = empty($x));// bool(false)
echo '<br>';
$x = "php";
var_dump($c = empty($x));// bool(false)
echo '<br>';
$x = "true";
var_dump($c = empty($x));// bool(false)
echo '<br>';
$x = "false";
var_dump($c = empty($x));// bool(false)
