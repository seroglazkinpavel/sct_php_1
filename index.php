<?php
    $a = 30;
    $b = 10;
    $add = $a + $b;
    $subtract = $a - $b;
    $multiply = $a * $b;
    if($b == 0) echo 'На 0 делить нельзя';
	if($b !== 0) $divide = $a / $b;
    $operation = 'divide';
    $isAvailableCalculation = false;
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
                <?php if($operation == 'add') echo '<option "selected" value="add">'."$add".'</option>';?>
                <?php if($operation == 'subtract') echo '<option "selected" value="subtract">'."$subtract".'</option>';?>
                <?php if($operation == 'multiply') echo '<option "selected" value="multiply">'."$multiply".'</option>';?>
                <?php if($operation == 'divide') echo '<option "selected" value="divide">'."$divide".'</option>';?>
            </select>
        </main>
    </body>
<<<<<<< HEAD
</html>  
=======
</html>
   
>>>>>>> origin/lesson_8
