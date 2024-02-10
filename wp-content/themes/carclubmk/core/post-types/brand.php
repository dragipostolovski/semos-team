<?php
/**
 * Register a Custom Post Type
 *
 * @package PE_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'PE_PostType_Lesson' ) ) {
	/**
	 * Class responsible for registering a CPT
	 */
	class PE_PostType_Brand {

		/**
		 * Declare CPT name
		 *
		 * @var string
		 */
		private string $name = 'lesson';


		/**
		 * Construct
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'register_post_type' ) );
		}

		/**
		 * Register post type
		 */
		public function register_post_type() {
			if ( ! is_blog_installed() ) {
				return;
			}

			if ( ! post_type_exists( $this->name ) ) {
                
				register_post_type(
					$this->name,
					array(
						'labels'                    => array(
							'name'                  => __( 'Lessons', 'projectsengine' ),
							'singular_name'         => _x( 'Lesson', 'Site post type singular name', 'projectsengine' ),
							'add_new'               => __( 'Add Lesson', 'projectsengine' ),
							'add_new_item'          => __( 'Add New Lesson', 'projectsengine' ),
							'edit'                  => __( 'Edit', 'projectsengine' ),
							'edit_item'             => __( 'Edit Lesson', 'projectsengine' ),
							'new_item'              => __( 'New Lesson', 'projectsengine' ),
							'view'                  => __( 'View Lesson', 'projectsengine' ),
							'view_item'             => __( 'View Lesson', 'projectsengine' ),
							'search_items'          => __( 'Search Lessons', 'projectsengine' ),
							'not_found'             => __( 'No Lessons found', 'projectsengine' ),
							'not_found_in_trash'    => __( 'No Lessons found in trash', 'projectsengine' ),
							'parent'                => __( 'Parent Lesson', 'projectsengine' ),
							'menu_name'             => __( 'Lessons', 'projectsengine' ),
							'filter_items_list'     => __( 'Filter Lessons', 'projectsengine' ),
							'items_list_navigation' => __( 'Lessons navigation', 'projectsengine' ),
							'items_list'            => __( 'Lessons list', 'projectsengine' ),
							'featured_image'        => _x( 'Lesson Avatar', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'projectsengine' ),
							'set_featured_image'    => _x( 'Set avatar image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'projectsengine' ),
							'remove_featured_image' => _x( 'Remove avatar image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'projectsengine' ),
							'use_featured_image'    => _x( 'Use as avatar image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'projectsengine' ),
						),
						'menu_icon'           => 'dashicons-course',
						'public'              => true,
						'exclude_from_search' => false,
						'publicly_queryable'  => true,

						// bool - Whether to generate and allow a UI for managing this post type in the admin. Default is value of $public.
						'show_ui'			  => true,
						
						'show_in_menu'		  => true,
						'show_in_nav_menus'   => true,
						'show_in_rest'        => true,
						'has_archive'         => true,
						'capability_type'	  => 'post',
						'capabilities'		  => array(),
						'rewrite'			  => array(),
						'can_export'		  => true,
						'supports'            => array( 'title', 'excerpt', 'thumbnail', 'editor', 'comments', 'page-attributes', 'custom-fields' ),
						'menu_position'       => 7,
					)
				);

                register_taxonomy_for_object_type( 'category', 'lesson' );
		        register_taxonomy_for_object_type( 'post_tag', 'lesson' );

                $taxonomies = array(
                    'course' => array(
                        'name' => 'Courses',
                        'singular_name' => 'Course',
                        'object_type' => array( 'lesson' ),
                        'public'                => true,
                        'publicly_queryable'    => true,
                        'hierarchical'          => true,
					),
					'part' => array(
                        'name' => 'Parts',
                        'singular_name' => 'Part',
                        'object_type' => array( 'lesson' ),
                        'public'                => true,
                        'publicly_queryable'    => true,
                        'hierarchical'          => true,
                    )
                );

                $this->create_taxonomies( $taxonomies );


			}

			flush_rewrite_rules();
		}

        /**
         * Create taxonomies for custom post type.
         *
         * @return void
         */
        public function create_taxonomies( $taxonomies, $public = true, $publicly_queryable = true, $hierarchical = true ) {
            foreach ( $taxonomies as $key => $taxonomy ) {
                // Add new taxonomy, make it hierarchical like categories first do the translations part for GUI
                $labels = array(
                    'name'              => _x( $taxonomy['name'], 'taxonomy general name' ),
                    'singular_name'     => _x( $taxonomy['singular_name'], 'taxonomy singular name' ),
                    'search_items'      => __( 'Search ' . $taxonomy['name'] ),
                    'all_items'         => __( 'All ' . $taxonomy['name'] ),
                    'parent_item'       => __( 'Parent ' . $taxonomy['singular_name'] ),
                    'parent_item_colon' => __( 'Parent '.$taxonomy['singular_name'].':' ),
                    'edit_item'         => __( 'Edit ' . $taxonomy['singular_name'] ),
                    'update_item'       => __( 'Update ' . $taxonomy['singular_name'] ),
                    'add_new_item'      => __( 'Add New ' . $taxonomy['singular_name'] ),
                    'new_item_name'     => __( 'New '.$taxonomy['singular_name'].' Name' ),
                    'menu_name'         => __( $taxonomy['name'] ),
                );

                // Now register the taxonomy
                register_taxonomy( $key, $taxonomy['object_type'], array(
                    'labels'                => $labels,
                    'show_in_rest'          => true,
                    'show_ui'               => true,
                    'show_admin_column'     => true,
                    'rewrite'               => array( 'slug' => $key ),

                    'public'                => $taxonomy['public'],
                    'publicly_queryable'    => $taxonomy['publicly_queryable'],
                    'hierarchical'          => $taxonomy['hierarchical'],
                ) );
            }
        }
	}

	new PE_PostType_Lesson();
}
