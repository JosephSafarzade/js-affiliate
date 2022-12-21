<?php

class js_affiliate_woocommerce_functions
{

    public $js_affiliate_core_functions;

    public function __construct(){

        $this->js_affiliate_core_functions = new js_affiliate_core_functions();

        add_action('woocommerce_order_status_completed',array($this,'js_aff_check_affiliate_cookie_on_thank_you_page'));

    }


    public function js_aff_check_affiliate_cookie_on_thank_you_page($order_id){

        if(isset($_COOKIE['affiliate-item-id']) && $_COOKIE['affiliate-item-id'] != '' ){

            update_post_meta($order_id,'affiliate-id',$_COOKIE['affiliate-item-id']);

            $this->js_affiliate_core_functions->js_aff_increase_affiliate_item_purchase($_COOKIE['affiliate-item-id']);

            $_COOKIE['affiliate-item-id'] = '';

            unset($_COOKIE['affiliate-item-id']);

        }

    }




}

$js_affiliate_woocommerce_functions = new js_affiliate_woocommerce_functions();
