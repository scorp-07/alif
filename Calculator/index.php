<?php

require_once "Calculator.php";

$calc = Calculator::setCalc("input.txt", "*");
print_r($calc);