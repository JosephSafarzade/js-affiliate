<?php

global $post;

$js_affiliate_core_functions = new js_affiliate_core_functions();

$title = get_the_title($post->ID);

if(!isset($_COOKIE['affiliate-item-id']) || $_COOKIE['affiliate-item-id']==''){

    $js_affiliate_core_functions->js_aff_increase_affiliate_item_visit($post->ID);

    setcookie('affiliate-item-id',$post->ID, 0 , "/");

}

//die();

if($_SERVER['QUERY_STRING'] != ''){

    $redirect_url = get_post_meta($post->ID,'affiliate-redirect-to',true) . "?" . $_SERVER['QUERY_STRING'];

}else{

    $redirect_url = get_post_meta($post->ID,'affiliate-redirect-to',true);
    
}


if($redirect_url != ''){

    wp_redirect( $redirect_url , 302 );

    exit;

}

