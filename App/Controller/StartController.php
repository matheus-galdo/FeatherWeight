<?php

namespace App\Controller;

use Core\Presentation\View;

class StartController{
    public static function index(View $view)
    {
        // return "isso aqui é o method INDEX função da controller TEST";
        return $view->render("opa");
    }

    public static function logar()
    {
        return "isso aqui é o method LOGAR função da controller TEST";
    }

    public static function ota()
    {
        return "isso aqui é o method OTA função da controller TEST";
    }
}