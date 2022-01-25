<?php


class js_affiliate_post_type
{

    public function __construct(){

        add_action( 'init', array(__CLASS__,'js_aff_create_affiliate_post_type') );

    }

    function js_aff_create_affiliate_post_type() {

        $labels = array(
            'name'                  => _x( 'Affiliates', 'Post type general name', 'js-affiliate' ),
            'singular_name'         => _x( 'Affiliate', 'Post type singular name', 'js-affiliate' ),
            'menu_name'             => _x( 'Affiliates', 'Admin Menu text', 'js-affiliate' ),
            'name_admin_bar'        => _x( 'Affiliates', 'Add New on Toolbar', 'js-affiliate' ),
            'add_new'               => __( 'Add New Affiliate', 'js-affiliate' ),
            'add_new_item'          => __( 'Add New Affiliate', 'js-affiliate' ),
            'new_item'              => __( 'New Affiliate', 'js-affiliate' ),
            'edit_item'             => __( 'Edit Affiliate', 'js-affiliate' ),
            'view_item'             => __( 'View Affiliate', 'js-affiliate' ),
            'all_items'             => __( 'All Affiliates', 'js-affiliate' ),
            'search_items'          => __( 'Search Affiliates', 'js-affiliate' ),
            'parent_item_colon'     => __( 'Parent Affiliate:', 'js-affiliate' ),
            'not_found'             => __( 'No Affiliates found.', 'js-affiliate' ),
            'not_found_in_trash'    => __( 'No Affiliates found in Trash.', 'js-affiliate' ),
            'featured_image'        => _x( 'Affiliate Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'js-affiliate' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'js-affiliate' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'js-affiliate' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'js-affiliate' ),
            'archives'              => _x( 'Affiliate archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'js-affiliate' ),
            'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'js-affiliate' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Affiliate', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'js-affiliate' ),
            'filter_items_list'     => _x( 'Filter Affiliates list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'js-affiliate' ),
            'items_list_navigation' => _x( 'Affiliates list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'js-affiliate' ),
            'items_list'            => _x( 'Affiliates list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'js-affiliate' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'aff' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title'),
        );

        register_post_type( 'js_aff', $args );

    }



}


$js_affiliate_class = new js_affiliate_post_type();