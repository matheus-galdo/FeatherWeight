<?php

namespace App\Controller;

use Core\Presentation\View;

class TestController{
    public static function index()
    {
        return "isso aqui é a index da controller";
    }

    public static function logar()
    {
        return "isso aqui é a logar da controller";
    }

    public static function ota(View $view)
    {
        return $view->renderTemplate("opa", "aaa", ["teste" => "main.css"]);
    }

    public static function css(View $view)
    {
        
    }

   
}