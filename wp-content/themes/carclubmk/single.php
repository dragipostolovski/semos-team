<?php

get_header(); ?>

<main class="site-main">

    <article class="article">
        <div class="article__inner container">

            <div class="article__title">
                <h1><?php echo get_the_title(); ?></h1>
            </div>

            <div class="article__date">
                <?php echo get_the_date('d.m.Y'); ?>
            </div>

            <div class="article__content">
                <?php echo get_the_content(); ?>
            </div>

        </div>
    </article>

</main>

<?php get_footer(); ?>