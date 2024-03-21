<?php

get_header(); ?>

<main class="site-main">

    <div class="news container">

        <div class="news__title">
            <h1><?php echo single_post_title('', false ); ?></h1>
        </div>

        <div class="news__articles">

            <?php

            if( have_posts() ):
                while( have_posts() ): 
                    the_post(); ?>

                    <article class="c-article">
                        <div class="c-article__inner">

                            <div class="c-article__header">
                                <div class="c-article__thumbnail">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            </div>

                            <div class="c-article__body">
                                <div class="c-article__title">
                                    <h2>
                                        <div class="c-article__cat">
                                            <?php the_category(' '); ?>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                </div>

                                <div class="c-article__date">
                                    <?php the_date( 'd.m.Y' ); ?>
                                </div>

                                <div class="c-article__content">
                                    <?php the_excerpt(); ?>
                                </div>

                                <div class="c-article__tags">
                                    <?php the_tags('', ' ', ''); ?>
                                </div>
                            </div>

                        </div>
                    </article>

                <?php endwhile;
            endif; ?>

        </div>

    </div>

</main>

<?php get_footer(); ?>
