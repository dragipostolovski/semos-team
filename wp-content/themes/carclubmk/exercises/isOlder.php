<?php

// Example 1
function isOlder_v1( $a, $b ) {
    $isOlder = true;

    if( $a > $b ) {
        $isOlder = false;
    }

    return $isOlder;
}

// Example 2
function isOlder_v2( $a, $b ) {
    if( $a > $b ) {
        return true;
    }

    return  false;
}

/**
 * Example 3
 * 
 * Check if first parameter is bigger.
 *
 * @param int $a
 * @param int $b
 * 
 * @return boolean
 */
function isOlder_v3( $a, $b ) {
    return $a > $b;
}

// Example 4
function isOlder_v4($a, $b) {
    return ( $a > $b ) ? true : false;
}

function isOlder_v5($a, $b) {
    if ( $a > $b ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Two arrays and find out who is older.
 *
 * @param array $worker1
 * @param array $worker2
 * @return void
 */
function whoIsOlder( $worker1, $worker2 ) {
    $name1 = $worker1['first_name'] . ' ' . $worker1['last_name'];
    $name2 = $worker2['first_name'] . ' ' . $worker2['last_name'];

    $age1 = $worker1['details']['age'];
    $age2 = $worker2['details']['age'];

    if( $age1 > $age2 ) {
        echo "$name1 is older than $name2";
    }
    elseif ( $age1 === $age2 ) {
        echo "$name1 and $name2 are the same age.";
    }
    else {
        echo "$name1 is not older than $name2";
    }
}