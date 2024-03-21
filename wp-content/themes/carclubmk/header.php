<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="site_content" class="site-content">
    <header class="site-header">
        <div class="site-header__inner container">

            <?php 

            if( has_nav_menu( 'primary' ) ):

                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container' => 'nav',
                    'container_class' => 'site-navigation',
                    'menu_class' => 'site-navigation__list',
                )); 
            
            else: ?>

                <nav class="site-navigation">
                    <ul class="site-navigation__list">
                        <li class="site-navigation__item">
                            <a href="/" alt="Home">Home</a>
                        </li>
                        <li class="site-navigation__item">
                            <a href="/about" alt="About">About</a>
                        </li>
                        <li class="site-navigation__item">
                            <a href="/news" alt="News">News</a>
                        </li>
                        <li class="site-navigation__item">
                            <a href="/contact" alt="Contact">Contact</a>
                        </li>
                    </ul>
                </nav>

            <?php endif; ?>
            
        </div>
    </header>