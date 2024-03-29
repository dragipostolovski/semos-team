<?php

// Se mora da bide dodadeno vo functions.php
// Za da ne trupame se na isto mesto kodot moze da go podelime.
// Se kreira nov fajl i so require_once ili require ke go vklucime tuka za WP da moze da go procita.
require_once 'core/theme-setup.php';

define( 'CCMK_REST_ROUTE', 'ccmk-api/v1' );


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

/**
 * Change the title output.
 *
 * @param string $title
 * @param string $post_id
 * 
 * @return string
 */
function filter_title_function( $title, $post_id ) {
    $post = get_post( $post_id );

    if( $post->post_type == 'page' ) {
	    return 'Title: ' . $title;
    }

    return $title;
}
// add_filter( 'the_title', 'filter_title_function', 10, 2 );

add_action( 'rest_api_init', 'ccmk_register_routes');

function ccmk_register_routes() {

    register_rest_route( CCMK_REST_ROUTE, '/filter-cars', array(
        'methods' => WP_REST_Server::CREATABLE, // post
        'callback' => 'filter_cars',
        'validate_callback' => function() {
            return true;
        },
        'permission_callback' => '__return_true',
    ));

    
    register_rest_route( CCMK_REST_ROUTE, '/register', array(
        'methods' => WP_REST_Server::CREATABLE, // post
        'callback' => 'register_user',
        'validate_callback' => function() {
            return true;
        },
        'permission_callback' => '__return_true',
    ));

}

function filter_cars( WP_REST_Request $request ) {
    $params = $request->get_params();
    $term = $params['term'];

    $posts = get_posts( array(
        'post_type'   => 'car',
        'order' => 'ASC',
        'orderby' => 'date',

        'tax_query' => array(
            // 'relation' => 'OR',
            array(
                'taxonomy' => 'season',
                'field' => 'slug',
                'terms' => $term,
            ),
        ),
    ) );

    if( !$posts ) {
        return array(
            'response' => false,
            'message' => 'Sorry we did not found any cars.',
            'class' => 'alert-error',
        );
    }

    $html = '';

    foreach( $posts as $post ):
        $title = $post->post_title;

        ob_start(); ?>

        <div class="car">
            <h3 class="car__title"><?php echo $title; ?></h3>
        </div>

        <?php 

        $html = ob_get_clean(); 

    endforeach;

    return array(
        'response' => true,
        'message' => __( 'Thank you for subscribing.', 'projectsengine' ),
        'class' => 'alert-success',
        'posts' => $html
    );
}

function register_user( WP_REST_Request $request ) {
    $params = $request->get_params();
    $email = $params['email'];
    $password = $params['password'];

    get_user_by( 'email', $email );

    wp_insert_post( );

    return array(
        'response' => true,
        'message' => __( 'Thank you for subscribing.', 'projectsengine' ),
        'class' => 'alert-success',
        'posts' => $html
    );
}


// add_filter( 'the_title', 'change_single_title', 10, 2 );

function change_single_title( $post_title, $post_id ) {
    if( !is_admin() && is_single() ) {
        return 'Title: '. $post_title;
    }

    return $post_title;
}

add_filter( 'the_content', 'change_single_content', 10, 1 );

function change_single_content( $content ) {
    return $content . '<p>This is content</p>';
}

function ccmk_your_function() {
    echo 'This is inserted at the bottom';
}
// add_action( 'wp_footer', 'ccmk_your_function' );