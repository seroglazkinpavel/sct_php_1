<?php
$arrey = [
    'телефоны' => ['мобильные телефоны', 'радиотелефоны', 'проводные телефоны' ],
    'мебель' => ['кресло', 'диван', 'стол'],
    'товары для автомобиля' => ['чехлы', 'колеса', 'топливо']
];
foreach ($arrey as $key => $value) {
    echo "<b>$key</b> =>";
        foreach ($value as $value) {
            echo '--'.$value;
    }
	 echo '<br>';
}
