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
                'orderby' => 'date'
            ) ); 
            
            echo '<h1>' . $posts[0]->post_title . '</h1>';
            
            ?>

        </div>
    </div>

</main>

<?php

get_footer();