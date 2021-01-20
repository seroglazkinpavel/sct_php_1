<?php
$x = "";
$c = (bool)$x;
var_dump($c);// bool(false)
echo '<br>';
$x = null;
$c = (bool)$x;
var_dump($c);// bool(false)
echo '<br>';
$x;
$c = (bool)$x;
var_dump($c);// bool(false)
echo '<br>';
$c = (bool)$X;
var_dump($c);// bool(false)
echo '<br>';
$x = array();
$c = (bool)$x;
var_dump($c);// bool(false)
echo '<br>';
$x = array('a', 'b');
$c = (bool)$x;
var_dump($c);// bool(true)
echo '<br>';
$x = "0";
$c = (bool)$x;
var_dump($c);// bool(false)
echo '<br>';
$x = false;
$c = (bool)$x;
var_dump($c);// bool(false)
echo '<br>';
$x = true;
$c = (bool)$x;
var_dump($c);// bool(true)
echo '<br>';
$x = 1;
$c = (bool)$x;
var_dump($c);// bool(true)
echo '<br>';
$x = 42;
$c = (bool)$x;
var_dump($c);// bool(true)
echo '<br>';
$x = 0;
$c = (bool)$x;
var_dump($c);// bool(false)
echo '<br>';
$x = -1;
$c = (bool)$x;
var_dump($c);// bool(true)
echo '<br>';
$x = 1;
$c = (bool)$x;
var_dump($c);// bool(true)
echo '<br>';
$x = "1";
$c = (bool)$x;
var_dump($c);// bool(true)
echo '<br>';
$x = "-1";
$c = (bool)$x;
var_dump($c);// bool(true)
echo '<br>';
$x = "php";
$c = (bool)$x;
var_dump($c);// bool(true)
echo '<br>';
$x = "true";
$c = (bool)$x;
var_dump($c);// bool(true)
echo '<br>';
$x = "false";
$c = (bool)$x;
var_dump($c);// bool(true)