<?php

class js_affiliate_scripts
{

    public function __construct(){

        add_action( 'admin_enqueue_scripts',array($this,'js_aff_load_admin_scripts') );


    }


    public function js_aff_load_admin_scripts(){

        wp_enqueue_style( 'js-affiliate-css', JS_AFF_PLUGIN_ASSETS_CSS_URL . '/style.css', array()  ,JS_AFF_VERSION );

        wp_enqueue_style( 'semantic-ui-css', JS_AFF_PLUGIN_ASSETS_CSS_URL . '/semantic.min.css', array()  ,JS_AFF_VERSION );

        wp_enqueue_script( 'semantic-ui-js', JS_AFF_PLUGIN_ASSETS_JS_URL . '/semantic.min.js', array('jquery')  ,JS_AFF_VERSION );

        wp_enqueue_script( 'js-affiliate-js', JS_AFF_PLUGIN_ASSETS_JS_URL . '/scripts.js', array('jquery')  ,JS_AFF_VERSION );

    }

}


$js_affiliate_scripts = new js_affiliate_scripts();

