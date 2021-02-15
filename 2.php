<?php
$arrey = [
    'Политика' => 'href="http://politics.ru"',
    'Общество' => 'href="http://society.ru"',
    'Экономика' => 'href="http://economy.ru"'
];
foreach ($arrey as $key => $value) {
    echo '<a href="$value">'.$key.'</a><br>';
}
