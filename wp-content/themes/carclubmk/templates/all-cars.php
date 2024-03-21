<?php

/**
 * Template Name: All Cars
 * Template post type: page
 */

 get_header(); ?>

<main class="site-main">

    <div class="all-cars">
        <div class="all-cars__inner">

            <?php $posts = get_posts( array(
                'post_type'   => 'book'
            ) ); ?>

        </div>
    </div>

</main>

<?php

get_footer();