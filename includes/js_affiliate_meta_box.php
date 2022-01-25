<?php


class js_affiliate_meta_box
{

    public function __construct(){

        add_action( 'add_meta_boxes', array(__CLASS__,'js_aff_register_js_aff_post_type_metabox') );

    }

    public function js_aff_register_js_aff_post_type_metabox(){


        add_meta_box(   'js-aff-post-type-metabox',
                        __( 'Affiliate Settings', 'js-affiliate' ),
                        array(__CLASS__,'js_aff_render_js_aff_post_type_metabox'),
                        'js_aff'
        );

    }


    public function js_aff_render_js_aff_post_type_metabox(){



    }

}

$js_affiliate_meta_box = new js_affiliate_meta_box();