<?php

class js_affiliate_core_functions
{


    public function js_aff_get_list_affiliate_items(){

        $result = array();

        $args = array(
          'post_type'=>'js_aff',
          'posts_per_page'=>-1,
          'status'=>'any',
          'fields'=>'ids'
        );

        $affiliate_items = get_posts($args);

        foreach($affiliate_items as $affiliate_item){

            $result[$affiliate_item] = get_the_title($affiliate_item);

        }

        return $result;

    }



    public function js_aff_get_running_time_of_affiliate_item($item_id){

        $affiliate_item = get_post($item_id);

        if(!is_null($affiliate_item)){

            $post_publish_date = new DateTime($affiliate_item->post_date);

            $striped_post_publish_date = $post_publish_date->format('Y-m-d');

            $now = new DateTime();

            $difference = $now->diff($post_publish_date, true);

            return $difference->days;

        } else {

            return false;

        }

    }





    public function js_aff_get_affiliate_item_visits($item_id){

        $affiliate_item_visit_count = get_post_meta($item_id,'js_aff_visit_count',true);

        if($affiliate_item_visit_count == ''){

            return 0;

        }

        return $affiliate_item_visit_count;

    }



    public function js_aff_get_affiliate_item_purchases($item_id){

        $affiliate_item_visit_count = get_post_meta($item_id,'js_aff_purchase_count',true);

        if($affiliate_item_visit_count == ''){

            return 0;

        }

        return $affiliate_item_visit_count;

    }


    public function js_aff_increase_affiliate_item_visit($item_id){

        $affiliate_item_visit_count = get_post_meta($item_id,'js_aff_visit_count',true);

        if($affiliate_item_visit_count == ''){

            $affiliate_item_visit_count = 0;

        }

        $affiliate_item_new_visit_count = (int)$affiliate_item_visit_count + 1;

        update_post_meta($item_id,'js_aff_visit_count',$affiliate_item_new_visit_count);

    }



    public function js_aff_increase_affiliate_item_purchase($item_id){

        $affiliate_item_purchase_count = get_post_meta($item_id,'js_aff_purchase_count',true);

        if($affiliate_item_purchase_count == ''){

            $affiliate_item_purchase_count = 0;

        }

        $affiliate_item_new_purchase_count = (int)$affiliate_item_purchase_count + 1;

        update_post_meta($item_id,'js_aff_purchase_count',$affiliate_item_new_purchase_count);

    }



    public function js_aff_get_affiliate_item_conversation_rate($item_id){

        $affiliate_item_visit_count = (int) $this->js_aff_get_affiliate_item_visits($item_id);

        $affiliate_item_purchase_count = (int) $this->js_aff_get_affiliate_item_purchases($item_id);

        return (float)($affiliate_item_purchase_count / $affiliate_item_visit_count) * 100;

    }



    public function js_aff_get_affiliate_item_purchases_list($affiliate_id){

        $args = array(
            'post_type' => 'shop_order',
            'posts_per_page'=>-1,
            'fields'=> 'ids',
            'post_status'       =>  array_keys( wc_get_order_statuses() ),
            'meta_query'=>array(
                array(
                    'key'=>'affiliate-id',
                    'value'=>$affiliate_id,
                    'compare'=>'='
                )
            )
        );

        $affiliate_orders = get_posts($args);

        return $affiliate_orders;

    }



    public function js_aff_get_order_items($order_object){

        $items = array();

        foreach ($order_object->get_items() as $item_id => $item ) {

            // Get an instance of corresponding the WC_Product object
            $product        = $item->get_product();

            $active_price   = $product->get_price(); // The product active raw price

            $regular_price  = $product->get_sale_price(); // The product raw sale price

            $sale_price     = $product->get_regular_price(); // The product raw regular price

            $product_name   = $item->get_name(); // Get the item name (product name)

            $item_quantity  = $item->get_quantity(); // Get the item quantity

            $item_subtotal  = $item->get_subtotal(); // Get the item line total non discounted

            $item_subto_tax = $item->get_subtotal_tax(); // Get the item line total tax non discounted

            $item_total     = $item->get_total(); // Get the item line total discounted

            $item_total_tax = $item->get_total_tax(); // Get the item line total  tax discounted

            $item_taxes     = $item->get_taxes(); // Get the item taxes array

            $item_tax_class = $item->get_tax_class(); // Get the item tax class

            $item_tax_status= $item->get_tax_status(); // Get the item tax status

            $item_downloads = $item->get_item_downloads(); // Get the item downloads

            // Displaying this data (to check)
            $items[] =  $product_name.' | Quantity: '.$item_quantity;

        }

        return $items;

    }



    public function js_aff_get_order_coupons($order){

        $coupons = array();

        foreach( $order->get_coupon_codes() as $coupon_code ) {

            $coupons[] = $coupon_code;

        }

        return $coupons;



    }




    public function generate_all_affiliate_items_data_report_page($affiliate_items){

        $affiliate_items_data = array();

        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        foreach ($affiliate_items as $affiliate_item_id => $affiliate_item_value){

            $affiliate_items_data[$affiliate_item_id]['name'] = $affiliate_item_value;

            $affiliate_items_data[$affiliate_item_id]['running_for'] = $this->js_aff_get_running_time_of_affiliate_item($affiliate_item_id);

            $affiliate_items_data[$affiliate_item_id]['detail_link'] = $actual_link . "&aff_id=" . $affiliate_item_id;

            $affiliate_items_data[$affiliate_item_id]['visits'] = $this->js_aff_get_affiliate_item_visits($affiliate_item_id);

            $affiliate_items_data[$affiliate_item_id]['purchases'] = $this->js_aff_get_affiliate_item_purchases($affiliate_item_id);

            $affiliate_items_data[$affiliate_item_id]['conversation'] = $this->js_aff_get_affiliate_item_conversation_rate($affiliate_item_id);

        }

        return $affiliate_items_data;

    }




    public function generate_affiliate_item_data_for_detailed_report_page($affiliate_orders){

        $affiliate_orders_data = array();

        foreach ($affiliate_orders as $affiliate_order){

            $order = wc_get_order( $affiliate_order );

            $affiliate_orders_data[$affiliate_order]['order-data'] = $order->get_data();

            $affiliate_orders_data[$affiliate_order]['order-data']['date_created'] = $affiliate_orders_data[$affiliate_order]['order-data']['date_created']->date('Y-m-d');

            $affiliate_orders_data[$affiliate_order]['order-items'] = implode(",",$this->js_aff_get_order_items($order));

            $affiliate_orders_data[$affiliate_order]['order-coupons'] = implode(",",$this->js_aff_get_order_coupons($order));

        }


        return $affiliate_orders_data;


    }



    public function js_generate_affiliate_sources_for_drop_down_input(){

        $result = array();

        $source_list = get_terms( array(
            'taxonomy' => 'js_aff_source',
            'hide_empty' => false,
        ) );

       //var_dump($source_list);

        foreach ($source_list as $source_item){

            $result[$source_item->term_id] = $source_item->name;

        }


        return $result;


    }










}

$js_affiliate_core_functions = new js_affiliate_core_functions();