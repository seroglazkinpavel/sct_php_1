<?php
/**
 * @param $name
 * @param null $address
 * @param null $age
 */
function ageAddressName($name, $address = NULL, $age = NULL)
{
    if(isset($name, $address, $age)) {
        echo "Имя: {$name}. Адрес: {$address}. Возраст: {$age}.";
    }elseif(isset($name, $address)) {
        echo "Имя: {$name}. Адрес: {$address}.";
    }else{
        echo "Имя: {$name}. Возраст: {$age}.";
    }
}
ageAddressName('Pavel', NULL, 43);


