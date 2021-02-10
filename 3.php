<?php

function getContent()
{   
    $str = '<html>
				<head>
					<title>{{TITLE}}</title>
				</head>
				<body>
					 {{CONTENT}}
				</body>
		   </html>';
	   
	return	$str;   
}
$str = getContent();

function replaceTitle($string_1, $string_2, $str)
{	
    $title = str_replace($string_1, $string_2, $str);
    return $title;
}
 
function replaceContent($str_1, $str_2, $str)
{
	$content = str_replace("{{CONTENT}}", $str_2, $str);
    return $content;
}

 function getReplace($string, $string_2, $str)
{	
	if($string == 'title') {
		return $str = replaceTitle('{{TITLE}}', $string_2, $str);		
	}elseif($string == 'content') {
		return $str = replaceContent('{{CONTENT}}', $string_2, $str);
	}else return false;
}
  $content = getReplace('content', 'Hello world!', $str);
 echo $title = getReplace('title', 'Главная страница', $content);
