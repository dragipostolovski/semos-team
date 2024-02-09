<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mystyle.css">
    <?php wp_head(); ?>
</head>
<body>
    
    <?php if( have_posts() ):
        while ( have_posts() ): 
            the_post(); ?>

                <header>
                    <nav>
                        
                    </nav>
                </header>

                <main class="main">
                    <article id="<?php echo the_ID(); ?>">
                        <div class="container">
                            <?php the_content();?>
                        </div>
                    </article>
                </main>

                <footer>

                </footer>

            <?php
        endwhile;
    endif; ?>

    <?php wp_footer(); ?>
</body>
</html>