<?php
include 'lib.php';
$content = getContent();
if (empty($content)) {
    return;
}
echo str_replace(
    ['{{__MENU__}}', '{{__CONTENT__}}'],
    [getMenu(), $content],
    file_get_contents(__DIR__ . '/html/main.html')
);