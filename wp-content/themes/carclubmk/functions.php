<?php

require_once 'core/theme-setup.php';

$productPrice = 2;
$price = 1;
const DDV = 5;


function getSum( $n1, $n2 ) {
   if( $n1 > 0 && $n2 > 0 ) {
        $sum = $n1 + $n2;
        return $sum; // 11
   }

   return 'Wrong price!';
}

$priceSum = getSum( $price, DDV ); // 2 + 11

// echo $priceSum;

if( is_int( $priceSum ) ) {
    $sum = $productPrice + $priceSum; // 2 + 11 = 13
    // echo 'The price is ' . $sum . 'den';
}

