<?php

function getContent()
{   
    $str_3 = '<html>
				<head>
					<title>{{TITLE}}</title>
				</head>
				<body>
					 {{CONTENT}}
				</body>
		   </html>';
	return	$str_3 ;   
}

function replaceTitle($string_1, $string_2)
{	
	$title = str_replace($string_1, $string_2, "{{TITLE}}");
    return $title;
}
 $title = replaceTitle('{{TITLE}}', 'Главная страница');

function replaceContent($str_1, $str_2)
{
	$content = str_replace($str_1, $str_2, "{{CONTENT}}");
    return $content;
}
 $content = replaceContent('{{CONTENT}}', 'Привет мир');

$str_3 = getContent();

function getReplace($string, $str)
{
	global $str_3;
	if(($string == '{{TITLE}}') || ($string == '{{CONTENT}}')) {
		return $string_3 = str_replace($string, $str, $str_3);
	}else return false;
}
echo $string_3 = getReplace('{{CONTENT}}', 'Главная страница'); 
