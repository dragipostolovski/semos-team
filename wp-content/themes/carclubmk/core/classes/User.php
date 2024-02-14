<?php

namespace projectsengine;

use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use WP_Query;
use WP_Error;
use WP_User_Query;
use projectsengine\Email;

/**
 * Everyting post related.
 * 
 * @since      1.0.0
 * @package    projectsengine
 * @subpackage core/classes/Post
 * @author     Dragi Postolovski <contact@projectsengine.com>
 */
class PE_User {

    /**
	 * The plugin's unique identifier.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The plugin's unique identifier.
	 */
	private $theme_domain;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * API namespace.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $namespace    API namespace.
	 */
	private $namespace;


    public function __construct() {

		$this->theme_domain = wp_get_theme()->get( 'TextDomain' );
		$this->version 		= wp_get_theme()->get( 'Version' );
		$this->namespace 	= 'projectsengine-api/v1';

        add_action( 'user_contactmethods', array( $this, 'user_contact_methods' ) );
        add_action( 'init', array( $this, 'custom_author_base' ) );

		add_action( 'rest_api_init', array( $this, 'pe_register_routes' ) );
		add_action( 'init', array( $this, 'disable_admin_panel_for_clients' ) );
		add_action( 'after_setup_theme', array( $this, 'disable_admin_bar' ) );	
	}

	public function pe_register_routes() {
		register_rest_route( 
			'projectsengine-api/v1', 
			'/account',
			 array(
				array(
					'methods' => WP_REST_Server::CREATABLE,
					'callback' => array( $this, 'account' ),
					'permission_callback' => function ($request) {
						if( ! is_user_logged_in() )	{
							return new WP_Error( 'hacker', __( "Please leave immediately.", "projectsengine" ) );
						}
	
						return true;
					}
				)
			 ),
		);

		register_rest_route( 
			'projectsengine-api/v1', 
			'/social-media',
			 array(
				array(
					'methods' => WP_REST_Server::CREATABLE,
					'callback' => array( $this, 'social_media' ),
					'permission_callback' => function ($request) {
						if( ! is_user_logged_in() )	{
							return new WP_Error( 'hacker', __( "Please leave immediately.", "projectsengine" ) );
						}
	
						return true;
					}
				)
			 ),
		);

		register_rest_route( 'projectsengine-api/v1', '/subscribe', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array( $this, 'subscribe' ),
			'validate_callback' => function() {
				return true;
			},
			'permission_callback' => '__return_true',
		));

		register_rest_route( 'projectsengine-api/v1', '/subscribe-2', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array( $this, 'subscribe2' ),
			'validate_callback' => function() {
				return true;
			},
			'permission_callback' => '__return_true',
		));


		register_rest_route( 'projectsengine-api/v1', '/download', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array( $this, 'download' ),
			'validate_callback' => function() {
				return true;
			},
			'permission_callback' => '__return_true',
		));

		register_rest_route( $this->namespace, '/cookie', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array( $this, 'cookie' ),
			'validate_callback' => function() {
				return true;
			},
			'permission_callback' => '__return_true',
		));

		register_rest_route( $this->namespace, '/guest-post', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array( $this, 'guest_post' ),
			'validate_callback' => function() {
				return true;
			},
			'permission_callback' => '__return_true',
		));

		register_rest_route( $this->namespace, '/contact', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array( $this, 'contact' ),
			'validate_callback' => function() {
				return true;
			},
			'permission_callback' => '__return_true',
		));
	}

   	/**
	 * Add additional contact methods on edit user.
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	public function user_contact_methods( $fields ) {
        // Disable the Yoast fields they suck
        unset( $fields['facebook'] );
        unset( $fields['instagram'] );
        unset( $fields['linkedin'] );
        unset( $fields['linkedin'] );
        unset( $fields['myspace'] );
        unset( $fields['linkedin'] );
        unset( $fields['pinterest'] );
        unset( $fields['soundcloud'] );
        unset( $fields['tumblr'] );
        unset( $fields['twitter'] );
        unset( $fields['youtube'] );
        unset( $fields['wikipedia'] );

		// Add my new and better user fields/methods
		$fields['_user_subscribe'] = __( 'Subscribed', $this->theme_domain );
		$fields['_user_verify'] = __( 'Verified', $this->theme_domain );
		$fields['_user_visible'] = __( 'Publicly visible', $this->theme_domain );
        $fields['_user_linkedin'] = __( 'LinkedIn', $this->theme_domain );
        $fields['_user_github'] = __( 'Github', $this->theme_domain );
        $fields['_user_gitlab'] = __( 'Gitlab', $this->theme_domain );
        $fields['_user_video'] = __( 'Video', $this->theme_domain );
        $fields['user_nicename'] = __( 'User URL', $this->theme_domain );

		return $fields;
	}

    /**
	 * Custom author base
	 * Different url: /user/dragipostolovski instead of /author/dragipostolovski
	 */
	public function custom_author_base() {
		global $wp_rewrite;
	
		$wp_rewrite->author_base = 'user';
	}

	/**
     * Register an account route.
     *
     * @param WP_REST_Request $request
     *
     * @return WP_REST_Response
     */
    public function account( WP_REST_Request $request ) {
		$fields = $request->get_params();

		if( !is_user_logged_in() )
			return new WP_REST_Response( [
                'response' 	=> false,
                'message' 	=> __( 'You are not logged in.', $this->theme_domain ),
                'class' 	=> 'alert-error'
            ] );
		
		$args = [
			'ID'				=> intval( $fields['ID'] ),
			'display_name' 		=> $fields['first_name'] . ' ' . $fields['last_name'],
			'first_name'		=> $fields['first_name'],
			'last_name'			=> $fields['last_name'],
			'user_description'	=> $fields['user_description'],
			'user_email'		=> $fields['user_email'],
			'user_url'			=> $fields['user_url']

		];

        $user = $this->get_user( 'user_nicename', $fields['user_nicename'] );

        if( $user && $user[0]->ID != $fields['ID'] ) {
            return new WP_REST_Response( [
                'response' 	=> false,
                'message' 	=> __( 'The URL you entered already exists.', $this->theme_domain ),
                'class' 	=> 'alert-error'
            ] );
        }

        $userID  = wp_update_user( $args );

        if ( is_wp_error( $userID ) ) {
            return new WP_REST_Response( [
                'response'  => false,
                'message'   => __( 'Account creation failed.', $this->theme_domain ),
                'class'     => 'alert-error'
            ] );
        }

        $this->update_url( $fields['user_nicename'], $fields['ID'] );

		$tags = array_filter( explode( ',', str_replace( ' ', '', $fields['user_tags'] ) ) );

		update_user_meta( $userID, '_user_tags', $tags );
		update_user_meta( $userID, '_user_hobbies', $fields['user_hobbies'] );
		update_user_meta( $userID, '_user_video', $fields['user_video'] );

        return new WP_REST_Response( [
            'response'  => true,
            'message'   => __( 'Account updated successfully.', $this->theme_domain ),
            'class'     => 'alert-success'
        ] );
    }

	/**
     * Social media of the user.
     *
     * @param WP_REST_Request $request
     *
     * @return WP_REST_Response
     */
    public function social_media( WP_REST_Request $request ) {
		$fields = $request->get_params();

		if( !is_user_logged_in() )
			return new WP_REST_Response( [
                'response' 	=> false,
                'message' 	=> __( 'You are not logged in.', $this->theme_domain ),
                'class' 	=> 'alert-error'
            ] );
		
		$userID = intval( $fields['ID'] );
		$user = get_user_by( 'ID', $userID );

		$github 	= 'https://github.com/' . $fields['github'];
		// $gitlab 	= 'https://gitlab.com/' . $fields['gitlab'];
		$facebook 	= 'https://www.facebook.com/' . $fields['facebook'];
		$tumblr		= 'https://' . $fields['tumblr'] . '.tumblr.com';
		$x			= 'https://twitter.com/' . $fields['x'];
		$instagram	= 'https://www.instagram.com/' . $fields['instagram'];
		$linkedin	= 'https://www.linkedin.com/in/' . $fields['linkedin'];

		$args = [
			'github' 			=> $fields['github'],
			// 'gitlab'			=> $fields['gitlab'],
			'facebook'			=> $fields['facebook'],
			'tumblr'			=> $fields['tumblr'],
			'x'					=> $fields['x'],
			'instagram'			=> $fields['instagram'],
			'linkedin'			=> $fields['linkedin']

		];

        if ( ! $user ) {
            return new WP_REST_Response( [
                'response'  => false,
                'message'   => __( 'The user does not exist.', $this->theme_domain ),
                'class'     => 'alert-error'
            ] );
        }

		if( !empty( $github ) ) {
			update_user_meta( $userID, '_user_github', $github );
		}

		// if( !empty( $gitlab ) ) {
		// 	update_user_meta( $userID, '_user_gitlab', 'https://gitlab.com/' . $gitlab );
		// }
		
		if( !empty( $facebook ) ) {
			update_user_meta( $userID, '_user_facebook', $facebook );
		}

		if( !empty( $tumblr ) ) {
			update_user_meta( $userID, '_user_tumblr', $tumblr );
		}

		if( !empty( $x ) ) {
			update_user_meta( $userID, '_user_x', $x );
		}
	
		if( !empty( $instagram ) ) {
			update_user_meta( $userID, '_user_instagram', $instagram );
		}

		if( !empty( $linkedin ) ) {
			update_user_meta( $userID, '_user_linkedin', $linkedin );
		}

		update_user_meta( $userID, '_user_social', $args );

        return new WP_REST_Response( [
            'response'  => true,
            'message'   => __( 'Done!', $this->theme_domain ),
            'class'     => 'alert-success'
        ] );
    }

	/**
	 * Bookmark a post.
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function bookmark( WP_REST_Request $request  ) {
        $fields = $request->get_params();
        $post = get_post( $fields['ID'] );
        $currentUser = apply_filters( 'determine_current_user', false );
        $bookmarks = [];

        if( !$currentUser ) {
            return new WP_REST_Response( [
                'response' => false,
                'message' => __( 'The post can\'t be bookmarked, please log in..', $this->theme_domain ),
                'class' => 'alert-warning'
            ] );
        }

        if( !$post ) {
            return new WP_REST_Response( [
                'response' => false,
                'message' => __( 'There was an error, please refresh the page and try again.', $this->theme_domain ),
                'class' => 'alert-error'
            ] );
        }

        if( get_user_meta( $currentUser, '_user_bookmark', true ) ) {
            $bookmarks = get_user_meta( $currentUser, '_user_bookmark', true );
        }

        if( isset( $bookmarks[$post->ID] ) ) {
            $message = __( 'The post is removed from the list.', $this->theme_domain );
            unset(  $bookmarks[$post->ID] );
            update_user_meta( $currentUser, '_user_bookmark', $bookmarks );

            return new WP_REST_Response( ['response' => false, 'message' => $message, 'class' => 'alert-error'] );
        }

        $bookmarks[$post->ID] = get_the_title( $post->ID );

        update_user_meta( $currentUser, '_user_bookmark', $bookmarks );

        $message = __( 'The post is added to your list.', $this->theme_domain );
        return new WP_REST_Response( ['response' => true, 'message' => $message, 'class' => 'alert-success'] );
    }

	/**
	 * Subscribe user.
	 *
	 * @param WP_REST_Request $request
	 * @return json
	 */
	function subscribe( WP_REST_Request $request ) {
		$params 	= $request->get_params();
		$email 		= $params['email'];
		$hash 		= random_string( 32 );
	
		if( $userID = email_exists( $email ) ) {
			update_user_meta( $userID, '_user_subscribe', 'true' );
			update_user_meta( $userID, '_user_verify', 'true' );
	
			return new WP_REST_Response( [
				'response' => false, 
				'message' => __( 'You are already subscribed.', 'projectsengine' ), 
				'class' => 'alert-warning'
			] );
		}
	
		$userID = wp_insert_user( [
			'user_login'    =>  $email,
			'user_email'    => $email,
			'role'          => 'client',
			'user_pass'     =>  random_string( 8 )
		] );
	
		update_user_meta( $userID, '_user_subscribe', $hash );
		update_user_meta( $userID, '_user_verify', $hash );
		update_user_meta( $userID, '_user_visible', $hash );
		update_user_meta( $userID, '_user_password', $hash );
	
		$subject = __( 'Please verify you email', 'projectsengine' );
		$content = sprintf( __( 'Please click <a href="%s?type=%s&user=%s&code=%s">here</a> to verify your email address.' , 'projectsengine' ), site_url() . '/verify', 'subscribe', $userID, $hash );
		
		$object = new Email;
		$object->set_email( $userID, site_url() . '/verify?type=subscribe&user=' . $userID . '&code=' . $hash, 'Verify' );
		$object->send( $email, $subject, $subject, $content );
	
		return new WP_REST_Response( [
			'response' => true,
			'message' => __( 'Thank you for subscribing.', 'projectsengine' ),
			'class' => 'alert-success'
		] );
	}

		/**
	 * Subscribe user.
	 *
	 * @param WP_REST_Request $request
	 * @return json
	 */
	function subscribe2( WP_REST_Request $request ) {
		$params 	= $request->get_params();
		$checked 	= $params['checked'];
		$value 		= 'false';

		if( 'true' === $checked )
			$value = 'true';

		if( is_user_logged_in() ):
			update_user_meta( get_current_user_id(), '_user_subscribe', $value );
	
			return new WP_REST_Response( [
				'response' => true, 
				'message' => __( 'Settings saved.', 'projectsengine' ), 
				'class' => 'alert-warning'
			] );
		endif;
	
		return new WP_REST_Response( [
			'response' => false,
			'message' => __( 'Please log in.', 'projectsengine' ),
			'class' => 'alert-success'
		] );
	}

	/**
	 * Register a user with email and password
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function download( WP_REST_Request $request ) {
		$args 		= $request->get_params();
		$email 		= $args['email'];
		$pageID		= $args['post_id'];
		$hash 		= $this->random_string( 32 );
		$password 	= $this->random_string( 10 );
		$user 		= get_user_by( 'email', $email );

		if( $user ) {
			$subject = __( 'Please check your email', $this->theme_domain );

			$userID = $user->ID;
		}
		else {
			$subject = __( 'Please verify your email', $this->theme_domain );

			$userID = wp_insert_user( [
				'user_login'    =>  $email,
				'user_email'    => $email,
				'role'          => 'client',
				'user_pass'     =>  $password,
			] );

			if ( is_wp_error( $userID ) ) {
				$message = __( 'The user cannot be created.', $this->theme_domain );

				return new WP_REST_Response( [
					'response' => false, 
					'message' => $message,
					'class' => 'alert-error'
				] );
			}
		}

		update_user_meta( $userID, '_user_verify', $hash );
		update_user_meta( $userID, '_user_visible', 'false' );
		update_user_meta( $userID, '_user_subscribe', 'false' );

		$subject = __( 'Please verify you email', 'projectsengine' );
		$content = sprintf( __( 'Please click <a href="%s?type=%s&user=%s&pluginID=%s&code=%s">here</a> to download the plugin.' , $this->theme_domain ), site_url() . '/verify', 'download', $userID, $pageID, $hash );
		
		$object = new Email;
		$object->set_email( $userID, site_url() . '/verify?type=download&pluginID='.$pageID.'&user=' . $userID . '&code=' . $hash, 'Verify' );
		$sent = $object->send( $email, $subject, $subject, $content );

		return new WP_REST_Response( [
			'response' => true,
			'message' => $subject,
			'class' => 'alert-success'
		] );
	}

	/**
     * Cookie consent.
     *
     * @param WP_REST_Request $request
     * @return WP_REST_Response
     */
    public function cookie( WP_REST_Request $request  ) {
        $fields = $request->get_params();
        $post = get_post( $fields['post_id'] );
        // $ip = '77.28.54.14';
        $ip = $this->getIp();
        // $userID = apply_filters( 'determine_current_user', false );

        if( !$post ) {
            $message = __( 'We could not find the page.', $this->theme_domain );
            return new WP_REST_Response( ['response' => true, 'message' => $message, 'class' => 'alert-error'] );
        }

		if( 'publish' !== $post->post_status ) {
			$message = __( 'The post is not published yet.', $this->theme_domain );
            return new WP_REST_Response( ['response' => true, 'message' => $message, 'class' => 'alert-error'] );
		}

		// Count the post view.
        pe_post_view( $fields['post_id'] );
		pe_monthly_post_count_view( $fields['post_id'] );

		$query = new WP_Query(array( 
			'title'			=> $ip,
			'post_type'		=> 'activity',
			'post_status'	=> 'publish'
		));

        if( $activities = $query->posts ) {
            $activityID = $activities[0]->ID;
        }
		else {
			$activityID = wp_insert_post( array( 
				'post_title'	=> $ip,
				'post_type'		=> 'activity',
				'post_status'	=> 'publish'
			));
		}

		$geo = unserialize( file_get_contents( 'http://www.geoplugin.net/php.gp?ip=' . $ip ) );

		if( 200 == $geo['geoplugin_status'] || 206 == $geo['geoplugin_status'] ) {
			update_post_meta( $activityID, '_activity_city', $geo['geoplugin_city'] );
			update_post_meta( $activityID, '_activity_country', $geo['geoplugin_countryName'] );
			update_post_meta( $activityID, '_activity_timezone', $geo['geoplugin_timezone'] );
		}

		$visitID = wp_insert_post( array( 
			'post_title'	=> $ip . ' - ' . $activityID . ' - ' . pe_activity_view( $activityID ) ,
			'post_type'		=> 'activity',
			'post_status'	=> 'publish',
			'post_parent'	=> $activityID,
			'post_excerpt'	=> $fields['post_id']
		));

		update_post_meta( $visitID, '_activity_city', $geo['geoplugin_city'] );
		update_post_meta( $visitID, '_activity_country', $geo['geoplugin_countryName'] );
		update_post_meta( $visitID, '_activity_timezone', $geo['geoplugin_timezone'] );

        $message = __( 'Thank you for visiting Projects Engine.', $this->theme_domain );
        return new WP_REST_Response( [
			'response' => true, 
			'message' => $message, 
			'class' => 'alert-success',
		] );
    }

	public function guest_post( WP_REST_Request $request ) {
		$params = $request->get_params();
		
		$post_title				= $params['post_title'];
		$short_bio				= $params['short_bio'];
		$post_synopsis			= $params['post_synopsis'];

		$full_name 				= $params['full_name'];
		$email 					= $params['email'];

		$agree_to_guidelines	= $params['agree_to_guidelines'];
		// $submission_agreement	= $params['submission_agreement'];

		$additional_comments	= $params['additional_comments'];

		$reCAPTCHA 				= $params['recaptcha'];

		$args = array(
			'post_type'		=> 'message',
			'post_status'	=> 'private',
			'post_title'	=> 'Guest post: ' . $post_title,
			'post_excerpt'	=> $short_bio,
			'post_content'	=> '<!-- wp:paragraph --><p>'.$post_synopsis.'</p><!-- /wp:paragraph -->',
		);
		

		$user = get_user_by( 'email', $email );

		if( $user ) {
			$args['post_author'] = $user->ID;
		}
		
		// Google secret API
		$secretAPIkey = '6LfHzY0lAAAAAFPPtb-VyAYOwjx0h3bjhJOxkX4X';
		// reCAPTCHA response verification
		$verifyResponse = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$reCAPTCHA.'&remoteip='.getIp() );
		// Decode JSON data
		$response = json_decode( $verifyResponse );

		if( !$response->success ) {
			return new WP_REST_Response( [
				'response' => false,
				'message' => __( 'Robot verification failed, please try again.', 'projectsengine' ),
				'class' => 'alert-error'
			] );
		}

		if( !$agree_to_guidelines ) {
			return new WP_REST_Response( [
				'response' => false,
				'message' => __( 'You did not agree with our guidelines.', 'projectsengine' ),
				'class' => 'alert-error'
			] );
		}

		// if( !$submission_agreement ) {
		// 	return new WP_REST_Response( [
		// 		'response' => false,
		// 		'message' => __( 'You did not grant permission for publication.', 'projectsengine' ),
		// 		'class' => 'alert-error'
		// 	] );
		// }

		$ID = wp_insert_post( $args );

		if( is_wp_error( $ID ) ) {
			return new WP_REST_Response( [ 
				'response'	=> true, 
				'message'	=> __( 'There is an error with the form, try again later.', 'projectsengine' ), 
				'class'		=> 'alert-error' 
			] );
		}

		update_post_meta( $ID, '_full_name', $full_name );
		update_post_meta( $ID, '_email', $email );
		update_post_meta( $ID, '_additional_comments', $additional_comments );
		update_post_meta( $ID, '_agree_to_guidelines', ( $agree_to_guidelines ) ? 'true' : 'false' );
		// update_post_meta( $ID, '_submission_agreement', ( $submission_agreement ) ? 'true' : 'false' );


		$message = __( 'Thank you for visiting Projects Engine.', $this->theme_domain );
        return new WP_REST_Response( [
			'response' => true, 
			'message' => $message, 
			'class' => 'alert-success',
		] );
	}

   /**
	* Contact us route.
	*
	* @param WP_REST_Request $request
	*
	* @return WP_REST_Response
	*/
	public function contact( WP_REST_Request $request ) {
	   $params		= $request->get_params();
	   $email 		= $params['email'];
	   $subject	= $params['subject'];
	   $message	= $params['message'];
	   $reCAPTCHA 	= $params['recaptcha'];
   
	   $args = array(
		   'post_type'		=> 'message',
		   'post_status'	=> 'private',
		   'post_title'	=> 'Contact: ' . $subject,
		   'post_excerpt'	=> $message
	   );
   
	   $user = get_user_by( 'email', $email );
   
	   if( $user ) {
		   $args['post_author'] = $user->ID;
	   }
	   
	   // Google secret API
	   $secretAPIkey = '6LfHzY0lAAAAAFPPtb-VyAYOwjx0h3bjhJOxkX4X';
	   // reCAPTCHA response verification
	   $verifyResponse = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$reCAPTCHA.'&remoteip='.getIp() );
	   // Decode JSON data
	   $response = json_decode( $verifyResponse );
   
	   if( !$response->success ) {
		   return new WP_REST_Response( [
			   'response' => false,
			   'message' => __( 'Robot verification failed, please try again.', 'projectsengine' ),
			   'class' => 'alert-error'
		   ] );
	   }
   
	   $ID = wp_insert_post( $args );
   
	   if( is_wp_error( $ID ) ) {
		   return new WP_REST_Response( [ 
			   'response'	=> true, 
			   'message'	=> __( 'There is an error with the form, try again later.', 'projectsengine' ), 
			   'class'		=> 'alert-error' 
		   ] );
	   }
   
	   update_post_meta( $ID, '_contact_email', $email );
	   update_post_meta( $ID, '_contact_subject', $subject );
	   update_post_meta( $ID, '_contact_message', $message );

	   $this->user_subscribe( $email );
   
	   return new WP_REST_Response( [ 
		   'response'	=> true, 
		   'message'	=> __( 'Thank you for contacting us.', 'projectsengine' ), 
		   'class'		=> 'alert-success' 
	   ] );
   }

   /**
	 * Subscribe user.
	 *
	 * @param WP_REST_Request $request
	 * @return json
	 */
	function user_subscribe( $email ) {
		$hash 		= random_string( 32 );
	
		if( $userID = email_exists( $email ) ) {
			update_user_meta( $userID, '_user_subscribe', 'true' );
			update_user_meta( $userID, '_user_verify', 'true' );
	
			return false;
		}
	
		$userID = wp_insert_user( [
			'user_login'    =>  $email,
			'user_email'    => $email,
			'role'          => 'client',
			'user_pass'     =>  random_string( 8 )
		] );

		if( is_wp_error( $ID ) ) {
			return $userID;
		}
	
		update_user_meta( $userID, '_user_subscribe', 'true' );
		update_user_meta( $userID, '_user_verify', 'true' );
		update_user_meta( $userID, '_user_visible', $hash );
		update_user_meta( $userID, '_user_password', $hash );
	
		return true;
	}

	/**
     * Get user by field and value.
     *
     * @param $field
     * @param $value
     *
     * @return array|object|null
     */
    public function get_user( $field, $value ) {
        global $wpdb;

        return $wpdb->get_results(
            $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}users WHERE $field=%s", $value )
        );
    }

	/**
     *
     * $where_format array|string Optional
     * An array of formats to be mapped to each of the values in $where.
     * If it is a string, that format will be used for all the items in $where.
     * A format is one of '%d', '%f', '%s' (integer, float, string).
     * If omitted, all values in $where will be treated as strings.
     *
     * @param $url
     * @param $userID
     *
     * @return bool|int|mysqli_result|resource|null
     *
     * int|false The number of rows updated, or false on error.
     */
    public function update_url( $url, $userID ) {
        global $wpdb;
        $table = $wpdb->prefix.'users';

        return $wpdb->update(
            $table, // $table string Required
            array(
                'user_nicename' => $url
            ), // $data array Required
            array( 'ID' => $userID ), // $where array Required
            array( '%s' ), // $format
            array( '%s' ) // $where_format
        );
    }

	/**
	 * Generate random string
	 */
	public function random_string( $length ) {
		$str = random_bytes( $length );
		$str = base64_encode( $str );
		$str = str_replace( ["+", "/", "="], "", $str );
		$str = substr( $str, 0, $length );

		return $str;
	}

	 /**
     * Get the IP address.
     *
     * @return mixed
     */
    public function getIp() {
        $ip = $_SERVER['REMOTE_ADDR'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }

	/**
     * Redirect clients if they try to access admin area.
     *
     * @return void
     */
    public function disable_admin_panel_for_clients(){
        $role = get_role( 'client' );

        if( is_admin() && !defined('DOING_AJAX') && ( current_user_can('client') ) ){
            wp_redirect( site_url() );
        }
    }

	/**
     * Disable the admin bar for clients.
     *
     * @return void
     */
	public function disable_admin_bar() {
		if ( current_user_can('subscriber') || current_user_can('client') ) {
			show_admin_bar(false);
		}
	}
}

new PE_User;