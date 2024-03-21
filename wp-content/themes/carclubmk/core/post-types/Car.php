<?php

add_action( 'init', 'ccmk_register_post_type' );

function ccmk_register_post_type() {

    if ( ! post_type_exists( 'car' ) ) {
                
        register_post_type( 'car',
            array(
                'labels'                    => array(
                    'name'                  => __( 'Cars', 'carclubmk' ),
                    'singular_name'         => _x( 'Car', 'Site post type singular name', 'carclubmk' ),
                    'add_new'               => __( 'Add Car', 'carclubmk' ),
                    'add_new_item'          => __( 'Add New Car', 'carclubmk' ),
                    'edit'                  => __( 'Edit', 'carclubmk' ),
                    'edit_item'             => __( 'Edit Car', 'carclubmk' ),
                    'new_item'              => __( 'New Car', 'carclubmk' ),
                    'view'                  => __( 'View Car', 'carclubmk' ),
                    'view_item'             => __( 'View Car', 'carclubmk' ),
                    'search_items'          => __( 'Search Cars', 'carclubmk' ),
                    'not_found'             => __( 'No Cars found', 'carclubmk' ),
                    'not_found_in_trash'    => __( 'No Cars found in trash', 'carclubmk' ),
                    'parent'                => __( 'Parent Car', 'carclubmk' ),
                    'menu_name'             => __( 'Cars', 'carclubmk' ),
                    'filter_items_list'     => __( 'Filter Cars', 'carclubmk' ),
                    'items_list_navigation' => __( 'Cars navigation', 'carclubmk' ),
                    'items_list'            => __( 'Cars list', 'carclubmk' ),
                    'featured_image'        => _x( 'Car Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'carclubmk' ),
                    'set_featured_image'    => _x( 'Set car image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'carclubmk' ),
                    'remove_featured_image' => _x( 'Remove car image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'carclubmk' ),
                    'use_featured_image'    => _x( 'Use as car image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'carclubmk' ),
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

        $taxonomies = array(
            'brand' => array(
                'name' => 'Brands',
                'singular_name' => 'Brand',
                'object_type' => array( 'car' ),
                'public'                => true,
                'publicly_queryable'    => true,
                'hierarchical'          => true,
            ),
            'model' => array(
                'name' => 'Models',
                'singular_name' => 'Model',
                'object_type' => array( 'car' ),
                'public'                => true,
                'publicly_queryable'    => true,
                'hierarchical'          => true,
            ),
            'season' => array(
                'name' => 'Seasons',
                'singular_name' => 'Season',
                'object_type' => array( 'car' ),
                'public'                => true,
                'publicly_queryable'    => true,
                'hierarchical'          => true,
            )
        );

        create_taxonomies( $taxonomies );

        // register_taxonomy_for_object_type( 'category', 'car' );
        // register_taxonomy_for_object_type( 'post_tag', 'car' );

        flush_rewrite_rules();
    }
}

/**
 * Create taxonomies for custom post type.
 *
 * @param [type] $taxonomies
 * @param boolean $public
 * @param boolean $publicly_queryable
 * @param boolean $hierarchical
 * @return void
 */
function create_taxonomies( $taxonomies, $public = true, $publicly_queryable = true, $hierarchical = true ) {
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