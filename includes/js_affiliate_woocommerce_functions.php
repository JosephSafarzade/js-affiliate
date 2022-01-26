<?php

class js_affiliate_woocommerce_functions
{

    public function __construct(){

        add_action('woocommerce_thankyou',array($this,'js_aff_check_affiliate_cookie_on_thank_you_page'));

    }


    public function js_aff_check_affiliate_cookie_on_thank_you_page(){

        if(isset($_COOKIE['affiliate-item']) && $_COOKIE['affiliate-item'] != '' ){

            //Do Something !
            
        }

    }

}

$js_affiliate_woocommerce_functions = new js_affiliate_woocommerce_functions();
