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
        header("Content-type: text/css; charset=utf-8");
        return "div{
    color: red;
}";
    }

    public static function js(View $view)
    {
        header("Content-type: text/js; charset=utf-8");
        return "alert('funcionou')";
    }

    public static function image(View $view)
    {
        header("Content-type: image/jpeg");
        return file_get_contents(__DIR__."/../../public/images/delcidio.jpg");
    }
}