<?php

get_header(); ?>

<main class="site-main">

    <article class="article">
        <div class="article__inner container">
            
            <?php
            
            if( have_posts() ):
                while( have_posts() ): 
                    the_post(); ?>

                    <div class="article__title">
                        <h1><?php the_title(); ?></h1>
                    </div>

                    <div class="article__date">
                        <?php echo the_date('d.m.Y'); ?>
                    </div>

                    <div class="article__content">
                        <?php echo the_content(); ?>
                    </div>
                    
                <?php endwhile;
            endif; ?>

        </div>
    </article>

</main>

<?php get_footer(); ?>