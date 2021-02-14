<?php
$arrey = [
    'Политика' => '<a href="http://politics.ru">Политика</a>',
    'Общество' => '<a href="http://society.ru">Общество</a>',
    'Экономика' => '<a href="http://economy.ru">Экономика</a>'
];
foreach ($arrey as $key => $value) {
    echo "$key => $value" .'<br>';
}
