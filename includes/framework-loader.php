<?php

$files = array(
    "internationalize.php",
    "js_affiliate_core_functions.php",
    "js_affiliate_html_templates.php",
    "js_affiliate_scripts.php",
    "js_affiliate_post_type.php",
    "js_affiliate_meta_box.php",
    "js_affiliate_template_file.php",
    "js_affiliate_woocommerce_functions.php",
    "js_affiliate_admin_page.php"
);


foreach ($files as $file_name){

    $path = JS_AFF_DIR . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . $file_name;

    if(file_exists($path)){

        require_once($path);

    }else{

        wp_die('Plugin was not able to load following file : <br />' . $path);

    }


}