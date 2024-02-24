<?php
/**
 * Register a Custom Post Type
 *
 * @package CCMK_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CCMK_PostType_Vehicle' ) ) {
	/**
	 * Class responsible for registering a CPT
	 */
	class CCMK_PostType_Brand {

		/**
		 * Declare CPT name
		 *
		 * @var string
		 */
		private string $name = 'vehicle';


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
							'name'                  => __( 'Vehicles', 'carclubmk' ),
							'singular_name'         => _x( 'Vehicle', 'Site post type singular name', 'carclubmk' ),
							'add_new'               => __( 'Add Vehicle', 'carclubmk' ),
							'add_new_item'          => __( 'Add New Vehicle', 'carclubmk' ),
							'edit'                  => __( 'Edit', 'carclubmk' ),
							'edit_item'             => __( 'Edit Vehicle', 'carclubmk' ),
							'new_item'              => __( 'New Vehicle', 'carclubmk' ),
							'view'                  => __( 'View Vehicle', 'carclubmk' ),
							'view_item'             => __( 'View Vehicle', 'carclubmk' ),
							'search_items'          => __( 'Search Vehicles', 'carclubmk' ),
							'not_found'             => __( 'No Vehicles found', 'carclubmk' ),
							'not_found_in_trash'    => __( 'No Vehicles found in trash', 'carclubmk' ),
							'parent'                => __( 'Parent Vehicle', 'carclubmk' ),
							'menu_name'             => __( 'Vehicles', 'carclubmk' ),
							'filter_items_list'     => __( 'Filter Vehicles', 'carclubmk' ),
							'items_list_navigation' => __( 'Vehicles navigation', 'carclubmk' ),
							'items_list'            => __( 'Vehicles list', 'carclubmk' ),
							'featured_image'        => _x( 'Vehicle Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'carclubmk' ),
							'set_featured_image'    => _x( 'Set vehicle image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'carclubmk' ),
							'remove_featured_image' => _x( 'Remove vehicle image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'carclubmk' ),
							'use_featured_image'    => _x( 'Use as vehicle image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'carclubmk' ),
						),
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

                // register_taxonomy_for_object_type( 'category', 'vehicle' );
		        // register_taxonomy_for_object_type( 'post_tag', 'vehicle' );

                $taxonomies = array(
					'brand' => array(
                        'name' => 'Brands',
                        'singular_name' => 'Brand',
                        'object_type' => array( 'vehicle' ),
                        'public'                => true,
                        'publicly_queryable'    => true,
                        'hierarchical'          => true,
					),
                    'model' => array(
                        'name' => 'Models',
                        'singular_name' => 'Model',
                        'object_type' => array( 'vehicle' ),
                        'public'                => true,
                        'publicly_queryable'    => true,
                        'hierarchical'          => true,
					),
					'year' => array(
                        'name' => 'Year',
                        'singular_name' => 'Year',
                        'object_type' => array( 'vehicle' ),
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

	new CCMK_PostType_Brand();
}
