<?php

class js_affiliate_template_file
{

    public function __construct(){

        add_filter('single_template', array($this,'js_aff_load_single_template_file'));

    }


    function js_aff_load_single_template_file($single) {

        global $post;

        if ( $post->post_type == 'js_aff' ) {

            if ( file_exists( JS_AFF_DIR . '/templates/single.php' ) ) {

                return JS_AFF_DIR . '/templates/single.php';

            }

        }

        return $single;

    }


}


$js_affiliate_template_file = new js_affiliate_template_file();