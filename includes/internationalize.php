<?php

add_action( 'init', 'js_aff_load_plugin_textdomain' );


function js_aff_load_plugin_textdomain() {

    load_plugin_textdomain( 'js-affiliate', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

}