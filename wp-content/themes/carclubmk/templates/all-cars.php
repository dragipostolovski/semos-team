<?php

/**
 * Template Name: All Cars
 * Template post type: page
 */

 get_header(); ?>

<main class="site-main">

    <div class="all-cars">
        <div class="all-cars__inner container">

            <h1><?php echo get_the_title(); ?></h1>

            <div class='car-filters'>
                <?php $terms = get_terms( 
                    array(
                        'taxonomy'   => 'season',
                        'hide_empty' => false,
                    )
                ); 
                
                foreach( $terms as $term ): ?>
                    <span data-year="<?php echo $term->slug; ?>"> <?php echo $term->name; ?></span>
                <?php endforeach; ?>
            </div>


            <div class="car-select">
                <?php $terms = get_terms( 
                    array(
                        'taxonomy'   => 'brand',
                        'hide_empty' => false,
                    )
                );  ?>

                <select name="brand-select">
                    <?php 
                    foreach( $terms as $term ): ?>
                        <option value="<?php echo $term->slug; ?>"> <?php echo $term->name; ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
            

            <?php $posts = get_posts( array(
                'post_type'   => 'car',
                'order' => 'ASC',
                'orderby' => 'date',

                // 'tax_query' => array(
                //     'relation' => 'OR',
                //     array(
                //         'taxonomy' => 'brand',
                //         'field' => 'slug',
                //         'terms' => 'toyota',
                //     ),
                //     array(
                //         'taxonomy' => 'brand',
                //         'field' => 'slug',
                //         'terms' => 'mercedes',
                //     )
                // ),
            ) ); ?>
            
            <div class="car-results">

                <?php
                if( $posts ):

                    foreach( $posts as $post ):
                        $ID = $post->ID;
                        $title = $post->post_title; ?>
                        
                        <div class="car">
                            <h3 class="car__title"><?php echo $title; ?></h3>
                        </div>

                        <?php

                    endforeach;

                endif;
                
                ?>

            </div>

        </div>
    </div>

</main>

<?php

get_footer();