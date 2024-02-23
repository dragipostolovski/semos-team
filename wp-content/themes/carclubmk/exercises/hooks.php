<!-- 
    Hooks во WordPress се механизам за динамичко додавање или изменување на функционалноста на WordPress. 
    Постојат два типа hooks во WordPress: акција (actions) и филтри (filters).

    Првите додаваат код.
    Вторите зимаат парамтер го менувуаат и потота го враќаат.

    За секој hook мора да се поврзе функција.
 -->

 <?php

add_action( 'wp_enqueue_scripts', 'ccmk_enqueue_scripts' );
add_action( 'after_setup_theme', 'theme_setup_functions' );
add_action( 'wp_head', 'hook_javascript' );
add_action( 'wp_footer', 'buffer_end' );

