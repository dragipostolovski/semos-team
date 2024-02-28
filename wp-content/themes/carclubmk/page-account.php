<?php get_header('login'); ?>
    <header>
        <div class="container">
            <nav>
                <li class="link"></li>
                <li class="link"></li>
                <li class="link"></li>
            </nav>
        </div>
    </header>

    <?php get_option(); ?>
    <?php update_option( 'option', 'Nikola'); ?>

    <div class="container">
        <form id="login">
            <input type="text" name="email" />
            <input type="password" name="password" />

            <input type="submit" value="Log in">
        </form>

        <?php echo get_the_content(); ?>
    </div>
<?php get_footer(); ?>