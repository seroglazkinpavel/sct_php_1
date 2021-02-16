<?php
$arr_1 = [2, 5, 7, 6];
$arr_2 = [3, 2, 5, 1, 9];
$result = array_diff($arr_1, $arr_2);
echo '<pre>';
print_r($result);
echo '</pre><br>';

$result_1 = array_diff($arr_2, $arr_1);
echo '<pre>';
print_r($result_1);
echo '</pre>';