<?php


class js_affiliate_form_inputs
{


    public function create_text_input(array $args){

        printf(
            "<div class='ui input fluid'>
                        <input type='text' id='%s' name='%s' placeholder='%s' value='%s'>
                    </div>",
            $args['id'],
            $args['name'],
            $args['placeholder'],
            $args['value'],
        );

    }



    public function create_text_input_with_label(array $args){

        printf(
            "<div class='ui input labeled fluid'>
                        <div class='ui label'>%s</div>
                        <input type='text' id='%s' name='%s' placeholder='%s' value='%s'>
                    </div>",
            $args['label'],
            $args['id'],
            $args['name'],
            $args['placeholder'],
            $args['value'],
        );


    }





}

