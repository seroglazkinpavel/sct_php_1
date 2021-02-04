<?php

function register ($str)
{
    $str = preg_replace('/\s+/', '_', ucfirst(mb_strtolower($str)));
    if((substr($str, -1)) !== '!' && (substr($str, -1)) !== '.' && (substr($str, -1)) !== '?'){
       return $str . '.';
    }

}
$str = 'f S g e D l L';
echo register($str);


