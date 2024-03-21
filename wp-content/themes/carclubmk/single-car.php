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
                        <?php the_date('d.m.Y'); ?>
                    </div>

                    <div class="article__content">
                        <?php the_content(); ?>
                    </div>

                    <div class="comments">

                        <?php

                        $comments_args = array(
                            // Change the title of send button 
                            'label_submit' => __( 'Send', 'textdomain' ),
                            // Change the title of the reply section
                            'title_reply' => __( 'Write a Reply or Comment', 'textdomain' ),
                            // Remove "Text or HTML to be displayed after the set of comment fields".
                            'comment_notes_after' => '',
                            // Redefine your own textarea (the comment body).
                            'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
                        );
                        comment_form( $comments_args ); ?>

                    </div>
                    
                <?php endwhile;
            endif; ?>

        </div>
    </article>

</main>

<?php get_footer(); ?>