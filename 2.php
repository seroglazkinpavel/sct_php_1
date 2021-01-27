<?php
/**
 * @param int $a
 * @param int $b
 * @param int $c
 * @return int
 */

function getResult(int$a, int$b, int$c = 5):int
{
    return min($a, $b, $c);
}

var_dump(getResult('1',-7));