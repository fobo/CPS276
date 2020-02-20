<?php
class Calculator{

    function calc($operand=null,$val1="NaN",$val2="NaN"){
        $result = 0;
        $value = 0;
        if ($operand === null || !is_int($val1) || !is_int($val2)) {
            return "You must enter a string and two numbers. <br>";
        }
        switch ($operand) {
            case '+':
                $value = $val1+$val2;
                $result = "The sum of the numbers is $value <br>";
                return $result;
                break;
            case '-':
                $value = $val1-$val2;
                $result = "The difference of the numbers is $value<br>";
                return $result;
                break;
            case '*':
                $value = $val1*$val2;
                $result = "The product of the numbers is $value<br>";
                return $result;
                break;
            case '/':
                if($val1 == 0|| $val2 == 0){
                    return "Cannot divide by zero. <br>";
                }
                $value = $val1/$val2;
                $result = "The division of the numbers is $value<br>";
                return $result;
                break;
            default:

                return $result;
                break;
        }

    }

}
?>