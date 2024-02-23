<?php

function hello_world() {
    echo "Hello, World!";
}
// se povikuva
// Ke ispecati Hello, world! ne mora echo bidejki funkcijata ne vraka nisto
hello_world();


function sumOfTwoNumbers($a, $b) {
    return $a + $b;
}
echo sumOfTwoNumbers(5, 6); 
// Koga funkcijata vraka rezultata mora da go ispecatime so echo.
// Output: 120

function count_words($str) {
    // gotova funkcija od PHP broi zborovi vo recenica
    return str_word_count($str);
}
echo count_words("This is a sample sentence."); // Output: 5