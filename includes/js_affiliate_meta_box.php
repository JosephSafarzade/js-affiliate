<?php


class js_affiliate_meta_box
{

    public object $js_affiliate_form_inputs;

    public function __construct(){

        $this->js_affiliate_form_inputs = new js_affiliate_form_inputs();

        add_action( 'add_meta_boxes', array($this,'js_aff_register_js_aff_post_type_metabox') );

        add_action( 'save_post', array($this,'js_aff_save_js_aff_post_type_metabox') );

    }




    public function js_aff_register_js_aff_post_type_metabox(){


        add_meta_box(   'js-aff-post-type-metabox',
                        __( 'Affiliate Settings', 'js-affiliate' ),
                        array($this,'js_aff_render_js_aff_post_type_metabox'),
                        'js_aff'
        );

    }


    public function js_aff_render_js_aff_post_type_metabox(){

        $post_id = get_the_ID();

        $post_meta = get_post_meta($post_id);

        wp_nonce_field( 'js_aff_save_metabox', 'js_aff_metabox' );


        $this->js_affiliate_form_inputs->create_text_input_with_label(
            array(
                "label"         => 'Affiliate Title : ',
                "id"            => 'affiliate-title',
                "name"          => 'affiliate-title',
                "placeholder"   => 'Affiliate Title',
                "value"         => $post_meta['affiliate-title'][0]
            )
        );


        $this->js_affiliate_form_inputs->create_text_input_with_label(
            array(
                "label"         => 'Redirect To : ',
                "id"            => 'affiliate-redirect-to',
                "name"          => 'affiliate-redirect-to',
                "placeholder"   => 'Redirect to URL',
                "value"         => $post_meta['affiliate-redirect-to'][0]
            )
        );


    }




    public function js_aff_save_js_aff_post_type_metabox(){



        if ( isset( $_POST['js_aff_metabox'] ) && wp_verify_nonce( $_POST['js_aff_metabox'], 'js_aff_save_metabox' ) ){

            $post_id = get_the_ID();

            $items = array (
                'affiliate-title',
                'affiliate-redirect-to'
            );

            foreach ($items as $item){

                if(is_array($_POST[$item])){

                    $value = implode(",",$_POST[$item]);

                }else{

                    $value = $_POST[$item];

                }

                update_post_meta($post_id,$item,$_POST[$item]);

            }

        }


    }

}

$js_affiliate_meta_box = new js_affiliate_meta_box();