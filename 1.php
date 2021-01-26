<?php
function ageAddressName($age, $address, $name)
{
    $result = (string)$age;
    $rest = substr($result, -1);
    switch ($rest) {
        case 1:
            echo "Возраст {$age} год, адресс {$address}, имя {$name}";
            break;
        case 2:
            echo "Возраст {$age} года, адресс {$address}, имя {$name}";
            break;
        case 3:
            echo "Возраст {$age} года, адресс {$address}, имя {$name}";
            break;
        case 4:
            echo "Возраст {$age} года, адресс {$address}, имя {$name}";
            break;
        default:
            echo "Возраст {$age} лет, адресс {$address}, имя {$name}";
    }
}
ageAddressName(57, 'Астрахань ул. Боевая д 36', 'Викор');


