<?php

require_once JS_AFF_DIR . '/vendor/autoload.php';


class js_affiliate_html_templates
{

    public $loader;

    public $twig;

    public function __construct(){

        $this->loader = new \Twig\Loader\FilesystemLoader(JS_AFF_DIR . '/html_templates');

        $this->twig = new \Twig\Environment($this->loader);

    }


}