<?php

/**
 * Template Name: All Cars
 * Template post type: page
 */

 get_header(); ?>

<main class="site-main">

    <div class="all-cars">
        <div class="all-cars__inner container">

            <?php $posts = get_posts( array(
                'post_type'   => 'car',
                'order' => 'ASC',
                'orderby' => 'date',
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'brand',
                        'field' => 'slug',
                        'terms' => 'toyota',
                    ),
                    array(
                        'taxonomy' => 'brand',
                        'field' => 'slug',
                        'terms' => 'mercedes',
                    )
                ),
            ) );
            
            var_dump( $posts );
            
            ?>

        </div>
    </div>

</main>

<?php

get_footer();