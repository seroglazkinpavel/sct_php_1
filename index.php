<?php
    $a = 30;
    $b = 10;
    $add = $a + $b;
    $subtract = $a - $b;
    $multiply = $a * $b;
    if($b == 0) echo 'На 0 делить нельзя';
	if($b !== 0) $divide = $a / $b;
    $operation = $add;
    $isAvailableCalculation = true;
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Урок 8</title>
    </head>
    <body>
        <main>
            <?php
				if(!$isAvailableCalculation) echo 'вычисления не доступно';				
			?>               
            <select <?php if(!$isAvailableCalculation) echo 'hidden';?>>
                <option disabled>Выберите действие</option>
                <option <?php if($operation == $add) echo "selected"?> value="add"><?=$add .' = ' . "$a".' + '."$b"?></option>
                <option <?php if($operation == $subtract) echo "selected"?> value="subtract"><?=$subtract?></option>
                <option <?php if($operation == $multiply) echo "selected"?> value="multiply"><?=$multiply?></option>
                <option <?php if($operation == $divide) echo "selected"?> value="$divide"><?=$divide?></option>
            </select>
        </main>
    </body>
</html>
   