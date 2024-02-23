<?php

get_header(); ?>

<main class="site-main">

    <div class="front-page">
        <div class="front-page__inner">
            
            <?php

            get_template_part( 'sections/beginner', 'v1' ); ?>

            <!-- section array workers -->
            <section class="c-worker">
                <div class="c-worker__inner container">
                   
                    <?php foreach( workers() as $worker ) { ?>
                        <div class="c-worker__card">

                            <div class="c-worker__header" style="--color: <?php echo $worker['color']; ?>;"></div>
                            <div class="c-worker__body">
                                <div class="c-worker__img">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/profile.png'; ?>" alt="<?php echo $worker['first_name']; ?>" />
                                </div>
                                <div class="c-worker__title">
                                    <h3 class="worker__heading">
                                        <?php echo $worker['first_name']; ?> <?php echo $worker['last_name']; ?>
                                    </h3>
                                </div>
                                <div class="c-worker__desc">
                                    <?php echo $worker['desc']; ?>
                                </div>
                            </div>

                        </div>
                    <?php } ?>

                </div>
            </section>

            
        </div>
    </div>

</main>

<?php get_footer(); ?>
