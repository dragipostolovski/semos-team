<?php

// Se mora da bide dodadeno vo functions.php
// Za da ne trupame se na isto mesto kodot moze da go podelime.
// Se kreira nov fajl i so require_once ili require ke go vklucime tuka za WP da moze da go procita.
require_once 'core/theme-setup.php';

/**
 * This function will return array of workers with their information.
 *
 * @return array
 */
function workers() {
    return array(
        array(
            'first_name' => 'Nikolina',
            'last_name' => 'Stojanova',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'details' => array(
                'date_of_birth' => 1989,
                'age' => 35,
                'height' => 183,
                'weight' => 95
            ),
            'contact' => array(
                'email' => 'nikolina@email.com'
            ),
            'color' => 'rgba(255, 116, 82, 1)'
        ),
        array(
            'first_name' => 'Verica',
            'last_name' => 'Stoilkovska',
            'desc' => 'Auctor augue mauris augue neque. Fringilla est ullamcorper eget nulla facilisi etiam dignissim diam.',
            'details' => array(
                'date_of_birth' => 1988,
                'age' => 35,
                'height' => 175,
                'weight' => 85
            ),
            'contact' => array(
                'email' => 'verica@email.com'
            ),
            'color' => 'rgba(38, 132, 255, 1)'
        ),
        array(
            'first_name' => 'Zorica',
            'last_name' => 'Nedelkovska',
            'desc' => 'Dignissim enim sit amet venenatis urna cursus eget.',
            'details' => array(
                'date_of_birth' => 1932,
                'age' => 32,
                'height' => 174,
                'weight' => 70
            ),
            'contact' => array(
                'email' => 'zorica@email.com'
            ),
            'color' => 'rgba(87, 217, 163, 1)'
        ),
        array(
            'first_name' => 'Simona',
            'last_name' => 'Joveska',
            'desc' => 'Viverra suspendisse potenti nullam ac tortor vitae purus. Scelerisque in dictum non consectetur a erat nam.',
            'details' => array(
                'date_of_birth' => 1966,
                'age' => 62,
                'height' => 174,
                'weight' => 70
            ),
            'contact' => array(
                'email' => 'simona@email.com'
            ),
            'color' => 'rgba(255, 196, 0, 1)'
        )
    );
};

require_once 'exercises/isOlder.php';
require_once 'exercises/classes.php';