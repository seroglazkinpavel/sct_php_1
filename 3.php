<?php

$jsonString = '
{                                         
  "рабочий телефон": 89050506568,                       
  "домашний телефон": 8905050654,            
  "соседский телефон": 335566
}                                         
';
// преобразования строки JSON в виде ассоциированного массива

$cart = json_decode( $jsonString, true);
echo '<pre>';
print_r($cart);
echo '</pre><br>';

// Функция json_encode() принимает массив и возвращает строку JSON

echo json_encode( $cart, JSON_UNESCAPED_UNICODE );


