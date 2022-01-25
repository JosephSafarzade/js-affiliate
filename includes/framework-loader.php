<?php

$files = array(
    "internationalize.php",
    "js_affiliate_post_type.php",
    "js_affiliate_meta_box.php"
);


foreach ($files as $file_name){

    $path = JS_AFF_DIR . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . $file_name;

    if(file_exists($path)){

        require_once($path);

    }else{

        wp_die('Plugin was not able to load following file : <br />' . $path);

    }


}