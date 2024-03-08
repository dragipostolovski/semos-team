<?php

if ( ! function_exists( 'theme_setup_functions' ) ) {

	/**
	 * Setup theme
	 */
	function theme_setup_functions() {
		/*
		 * Makes custom available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on custom, use a find and
		 * replace to change 'custom' to the name of your theme in all
		 * template files.
		 */
		load_theme_textdomain( 'carclubmk', get_template_directory() . '/languages' );

		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switches default core markup for search form, comment form,
		 * and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Gutenberg full-width group support
		 */

		add_theme_support( 'align-wide' );

		/*
		 * This theme uses a custom image size for featured images, displayed on
		 * "standard" posts and pages.
		 */
		add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

		// phpcs:ignore
		// set_post_thumbnail_size(300, 400, true);

		add_image_size( 'ccmk_medium', 400, 300, false );
		add_image_size( 'ccmk_small', 200, 200, false );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary'  => __( 'Primary', 'projectsengine' ),
				'footer'   => __( 'Footer', 'projectsengine' ),
			)
		);

		/*
		 * Enable excerpt for page by default.
		 * See https://codex.wordpress.org/Function_Reference/add_post_type_support
		 */
		add_post_type_support( 'page', 'excerpt' );
	}

	add_action( 'after_setup_theme', 'theme_setup_functions' );
}

if ( ! function_exists( 'ccmk_enqueue_scripts' ) ) {
	function ccmk_enqueue_scripts() {
		wp_enqueue_style( 'ccmk-styles', get_template_directory_uri() . '/assets/style.css', array(), filemtime( get_template_directory() . '/assets/style.css' ) );

		$post 			= get_queried_object();
		$user_id 		= 0;
		$post_slug 		= '';
		$theme_domain 	= wp_get_theme()->get( 'TextDomain' );
		$version      	= wp_get_theme()->get( 'Version' );
		$theme_name   	= wp_get_theme()->get( 'Name' );
		$namespace    	= $theme_domain . '-api/v1';
		$post_type 		= '';

		if( is_singular( 'plugin' ) ):
			$post_type = 'plugin';
		endif;
		
		if( is_user_logged_in() ) {
			$user_id = get_current_user_id();
		}
        
		if( $post && !is_archive() ):
        	$post_slug = $post->post_name;
		endif;

		wp_enqueue_script( 'ccmk-script', get_template_directory_uri() . '/assets/js/script.js', array(), filemtime( get_template_directory() . '/assets/js/script.js' ), array( 'strategy' => 'async', 'in_footer' => true ) );
		wp_enqueue_script( 'ccmk-script-tickets', get_template_directory_uri() . '/assets/js/tickets.js', array(), filemtime( get_template_directory() . '/assets/js/tickets.js' ), array( 'strategy' => 'async', 'in_footer' => true ) );
		wp_localize_script( 'ccmk-script', $theme_domain, array(
			'ajax_url'  			=> admin_url( "admin-ajax.php" ),
			'site_url'  			=> site_url(),
			'nonce'     			=> wp_create_nonce( 'wp_rest' ),
			'namespace' 			=> $namespace,
			'post_slug' 			=> $post_slug,
            'post_id' 				=> get_queried_object_id(),
			'is_user_logged_in'		=> is_user_logged_in(),
			'user_id' 				=> $user_id,
			'post_type'				=> $post_type
		) );
	}

	add_action( 'wp_enqueue_scripts', 'ccmk_enqueue_scripts' );
}

if ( ! function_exists( 'ccmk_admin_enqueue_scripts' ) ) {
	function ccmk_admin_enqueue_scripts() {
		wp_enqueue_style( 'ccmk-admin-styles', get_template_directory_uri() . '/assets/css/admin.css', array(), filemtime( get_template_directory() . '/assets/css/admin.css' ) );

		$theme_domain 	= wp_get_theme()->get( 'TextDomain' );

		wp_enqueue_script( 'ccmk-admin-script', get_template_directory_uri() . '/assets/js/admin.js', array(),  wp_get_theme()->get( 'Version' ), array( 'strategy' => 'async', 'in_footer' => true ) );
		wp_localize_script( 'ccmk-admin-script', $theme_domain, array(
			'site_url'  			=> site_url(),
			'nonce'     			=> wp_create_nonce( 'wp_rest' ),
			'screen'				=> get_current_screen()
		) );
	}

	add_action( 'admin_enqueue_scripts', 'ccmk_admin_enqueue_scripts' );
}