<?php
/**
 * Register a Custom Post Type
 *
 * @package PE_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CCMK_PostType_FAQ' ) ) {
	/**
	 * Class responsible for registering a CPT
	 */
	class CCMK_PostType_FAQ {

		/**
		 * Declare CPT name
		 *
		 * @var string
		 */
		private string $name = 'faq';


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
							'name'                  => __( 'Questions', 'projectsengine' ),
							'singular_name'         => _x( 'Question', 'Site post type singular name', 'projectsengine' ),
							'add_new'               => __( 'Add Question', 'projectsengine' ),
							'add_new_item'          => __( 'Add New Question', 'projectsengine' ),
							'edit'                  => __( 'Edit', 'projectsengine' ),
							'edit_item'             => __( 'Edit Question', 'projectsengine' ),
							'new_item'              => __( 'New Question', 'projectsengine' ),
							'view'                  => __( 'View Question', 'projectsengine' ),
							'view_item'             => __( 'View Question', 'projectsengine' ),
							'search_items'          => __( 'Search Questions', 'projectsengine' ),
							'not_found'             => __( 'No Questions found', 'projectsengine' ),
							'not_found_in_trash'    => __( 'No Questions found in trash', 'projectsengine' ),
							'parent'                => __( 'Parent Question', 'projectsengine' ),
							'menu_name'             => __( 'Questions', 'projectsengine' ),
							'filter_items_list'     => __( 'Filter Questions', 'projectsengine' ),
							'items_list_navigation' => __( 'Questions navigation', 'projectsengine' ),
							'items_list'            => __( 'Questions list', 'projectsengine' ),
							'featured_image'        => _x( 'Question Avatar', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'projectsengine' ),
							'set_featured_image'    => _x( 'Set avatar image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'projectsengine' ),
							'remove_featured_image' => _x( 'Remove avatar image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'projectsengine' ),
							'use_featured_image'    => _x( 'Use as avatar image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'projectsengine' ),
						),
						'public'              => false,
						'exclude_from_search' => true,
						'publicly_queryable'  => false,

						// bool - Whether to generate and allow a UI for managing this post type in the admin. Default is value of $public.
						'show_ui'			  => true,
						
						'show_in_menu'		  => true,
						'show_in_nav_menus'   => true,
						'show_in_rest'        => false,
						'has_archive'         => false,
						'capability_type'	  => 'post',
						'capabilities'		  => array(),
						'rewrite'			  => array(),
						'can_export'		  => false,
						'supports'            => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
						'menu_position'       => 9,
					)
				);

                $taxonomies = array(
                    'group' => array(
                        'name' => 'Groupes',
                        'singular_name' => 'Group',
                        'object_type' => array( 'faq' ),
                        'public'                => false,
                        'publicly_queryable'    => false,
                        'hierarchical'          => false,
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

	new CCMK_PostType_FAQ();
}
