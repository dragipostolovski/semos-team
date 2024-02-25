<?php 

// Any PHP script is built out of a series of statements. A statement can be an assignment, a function call, a loop, a conditional statement or 
// even a statement that does nothing (an empty statement). Statements usually end with a semicolon. 
// In addition, statements can be grouped into a statement-group by encapsulating a group of statements with curly braces. 
// A statement-group is a statement by itself as well. 

// @link https://www.php.net/manual/en/language.control-structures.php#language.control-structures

/**
 * require
 * include
 * require_once
 * include_once
 */

/**
 * if
 * else
 * elseif/else if
 */

/**
 * while
 * do-while
 * for
 * foreach
 * break
 * continue
 * switch
 */


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

// require_once 'path/to-file';
// require 'path/to-file';

// If the code from a file has already been included, it will not be included again.
// If the file is not found will show a Warning. Require will throw an Error
// include_once 'path/to/file';


/**
 * 
 * ob_start() - ob_start — Turn on output buffering
 * ob_get_contents() - Return the contents of the output buffer
 * ob_end_clean() - Clean (erase) the contents of the active output buffer and turn it off
 * ob_end_flush() - Flush (send) the return value of the active output handler and turn the active output buffer off
 * 
 */

/**
 * Display message for the total count of the students.
 *
 * @return void
 */
function countElementsInArray() {
    $students = array('Elena', 'Marija', 'Zoran');

    ob_start(); ?>

    <div class="students-count">
        <p>The total number of the students is <?php echo count( $students ); ?> </p>
    </div>
    <?php 

    $html = ob_get_contents();

    return $html;

    // echo ob_get_clean();
}

countElementsInArray();