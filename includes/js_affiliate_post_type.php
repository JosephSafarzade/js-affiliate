<?php


class js_affiliate_post_type
{

    public function __construct(){

        add_action( 'init', array($this,'js_aff_create_affiliate_post_type'),0 );

        add_action( 'init', array($this,'js_aff_create_affiliate_source_taxonomy'), 0 );

        add_action( 'manage_posts_custom_column',array($this,'js_action_custom_columns_content'), 10, 2 );

        add_filter('manage_js_aff_posts_columns',array($this,'js_filter_columns') );

        add_filter('manage_edit-js_aff_sortable_columns',array($this,'js_set_sortable_columns'));

        add_action( 'pre_get_posts', array($this,'js_sort_custom_column_query') );


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




    public function js_aff_create_affiliate_source_taxonomy(){

        $labels = array(
            'name'              => _x( 'Sources', 'taxonomy general name', 'js-affiliate' ),
            'singular_name'     => _x( 'Source', 'taxonomy singular name', 'js-affiliate' ),
            'search_items'      => __( 'Search Sources', 'js-affiliate' ),
            'all_items'         => __( 'All Sources', 'js-affiliate' ),
            'view_item'         => __( 'View Source', 'js-affiliate' ),
            'parent_item'       => __( 'Parent Source', 'js-affiliate' ),
            'parent_item_colon' => __( 'Parent Source:', 'js-affiliate' ),
            'edit_item'         => __( 'Edit Source', 'js-affiliate' ),
            'update_item'       => __( 'Update Source', 'js-affiliate' ),
            'add_new_item'      => __( 'Add New Source', 'js-affiliate' ),
            'new_item_name'     => __( 'New Genre Source', 'js-affiliate' ),
            'not_found'         => __( 'No Genres Source', 'js-affiliate' ),
            'back_to_items'     => __( 'Back to Source', 'js-affiliate' ),
            'menu_name'         => __( 'Source', 'js-affiliate' ),
        );

        $args = array(
            'labels'            => $labels,
            'hierarchical'      => false,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => false,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'source' ),
            'show_in_rest'      => true,
        );

        register_taxonomy( 'js_aff_source', 'js_aff', $args );


    }



    function js_filter_columns( $columns ) {
        // this will add the column to the end of the array
        unset($columns['date']);

        $columns['source'] = 'Source Type';

        $columns['date'] = 'Date';
        //add more columns as needed

        // as with all filters, we need to return the passed content/variable
        return $columns;
    }


    function js_action_custom_columns_content ( $column_id, $post_id ) {

        if($column_id == 'source'){

            $meta_value = get_post_meta($post_id,'js_aff_source_name',true);

            if( $meta_value == '' ){

                $meta_value = '-';

            } else {

                $meta_value = get_term_by('id',$meta_value,'js_aff_source')->name;

            }

            echo $meta_value;

        }

    }



    function js_set_sortable_columns( $columns )
    {

        $columns['source'] = 'Source Type';

        return $columns;
    }



    function js_sort_custom_column_query( $query )
    {
        $orderby = $query->get( 'orderby' );

        if ( 'source' == $orderby ) {

            $meta_query = array(
                'relation' => 'OR',
                array(
                    'key' => 'js_aff_source_name',
                    'compare' => 'NOT EXISTS', // see note above
                ),
                array(
                    'key' => 'js_aff_source_name',
                ),
            );

            $query->set( 'meta_query', $meta_query );

            $query->set( 'orderby', 'meta_value' );

        }
    }




}


$js_affiliate_class = new js_affiliate_post_type();