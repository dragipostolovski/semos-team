<?php

get_header(); ?>

<main class="site-main">

    <div class="article">
        <div class="article__inner container">

            <div class="article__title">
                <h1><?php echo get_the_title(); ?></h1>
            </div>

            <div class="article__title">
                <?php echo get_the_date(); ?>
            </div>

            <div class="article__content">
                <?php echo get_the_content(); ?>
            </div>

        </div>
    </div>

</main>

<?php get_footer(); ?>
