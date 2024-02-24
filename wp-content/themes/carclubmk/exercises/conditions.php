<?php 

// @link https://www.php.net/manual/en/language.control-structures.php#language.control-structures

$integerNumber1 = 45;
$integerNumber2 = 30;

if( $integerNumber1 > 20 ) {
    echo 'Brojot e pogolem od 20';
}
else {
    echo 'Brojot ne e pogolem od 20';
}

if( $integerNumber1 > $integerNumber2 ) {
    echo "First number is bigger than the second";
} elseif ($integerNumber1 == $integerNumber2 ) {
    echo "The numbers are equal";
} else {
    echo "First n. is smaller than the second one";
}

