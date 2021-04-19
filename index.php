<?php
include 'module_global.php';
$content = getContent();
if (empty($content)) {
    return;
}
echo str_replace('{{__CONTENT__}}', $content, file_get_contents(__DIR__ . '/html/main.html'));