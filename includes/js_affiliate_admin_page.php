<?php

class js_affiliate_admin_page
{

    public $js_affiliate_html_templates;

    public $js_affiliate_core_functions;


    public function __construct(){




        $this->js_affiliate_core_functions = new js_affiliate_core_functions();

        $this->js_affiliate_html_templates = new js_affiliate_html_templates();


        add_action( 'admin_menu', array($this,'js_aff_register_admin_pages') );


    }


    function js_aff_register_admin_pages() {

        add_menu_page(__( 'JS Affiliate', 'js-affiliate' ), 'JS Affiliate', 'manage_options', 'js-affiliate', array($this,'js_affiliate_render_main_admin_page'));

        add_submenu_page( 'js-affiliate', __( 'JS Affiliate Settings', 'js-affiliate' ),__( 'Settings', 'js-affiliate' ), 'manage_options','js-affiliate-settings', array($this,'js_affiliate_render_setting_admin_page') );

        add_submenu_page( 'js-affiliate', __( 'JS Affiliate Report', 'js-affiliate' ),__( 'Report', 'js-affiliate' ), 'manage_options','js-affiliate-report', array($this,'js_affiliate_render_report_admin_page') );

    }


    public function js_affiliate_render_main_admin_page(){

        $this->js_affiliate_html_templates->example_function();

    }


    public function js_affiliate_render_setting_admin_page(){


    }


    public function js_aff_render_affiliate_item_report_page($item_id){

        $page_title = "Affiliate Items Brief Report";

        $affiliate_orders = $this->js_affiliate_core_functions->js_aff_get_affiliate_item_purchases_list($item_id);

        echo $this->js_affiliate_html_templates->twig->render(
            'affiliate_item_single_report.twig',
            [
                    'page_title'        => $page_title,
                    'affiliate_orders'  => $this->js_affiliate_core_functions->generate_affiliate_item_data_for_detailed_report_page($affiliate_orders)
            ]
        );

    }



    public function js_aff_render_all_affiliate_items_report_page(){


        $page_title = "Affiliate Items Brief Report";

        $affiliate_items = $this->js_affiliate_core_functions->js_aff_get_list_affiliate_items();

        echo $this->js_affiliate_html_templates->twig->render(
            'affiliate_all_items_report.twig',
            [
                'page_title'            => $page_title,
                'affiliate_items_data'  =>  $this->js_affiliate_core_functions->generate_all_affiliate_items_data_report_page($affiliate_items)
            ]
        );

    }



    public function js_affiliate_render_report_admin_page(){

        if(isset($_GET['aff_id'])){

            $page_title = 'Affiliate Report : ' . get_the_title($_GET['aff_id']);

            $this->js_aff_render_affiliate_item_report_page($_GET['aff_id']);


        }else{

            $this->js_aff_render_all_affiliate_items_report_page();
        }

    }

}

$js_affiliate_admin_page = new js_affiliate_admin_page();