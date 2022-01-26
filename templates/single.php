<?php

global $post;

$title = get_the_title($post->ID);

setcookie('affiliate-item', $title , 0 , "/");

$redirect_url = get_post_meta($post->ID,'affiliate-redirect-to',true);

if($redirect_url != ''){

    wp_redirect( $redirect_url , 302 );

    exit;

}

