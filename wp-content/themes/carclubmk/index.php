<?php

get_header(); ?>

<main class="site-main">

    <div class="news container">

        <div class="news__title">
            <h1>Quis eleifend quam adipiscing vitae proin sagittis nisl</h1>
        </div>

        <div class="news__articles">

            <?php

            if( have_posts() ) { 
                while( have_posts() ) { 
                    the_post(); ?>

                    <article class="c-article">
                        <div class="c-article__inner">

                            <div class="c-article__title">
                                <h2>
                                    <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a>
                                </h2>
                            </div>

                            <div class="c-article__date">
                                <?php echo get_the_date( 'd.m.Y' ); ?>
                            </div>

                            <div class="c-article__content">
                                <?php the_excerpt(); ?>
                            </div>

                        </div>
                    </article>

                <?php } 
            } ?>

        </div>

    </div>

</main>

<?php get_footer(); ?>
