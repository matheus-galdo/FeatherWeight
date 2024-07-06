<?php

namespace App\Controller;

use FeatherWeight\Database\Database;
use FeatherWeight\View\View;

class StartController{
    public static function index(View $view)
    {
        
        $content = $view->render("home");
        return $view->renderTemplate("FeatherWeight", $content, ["teste" => "main.css"]);
    }

    public static function erro(View $view)
    {
        $content = $view->render("404");
        return $view->renderTemplate("404 - Not Found", $content, ["teste" => "main.css"]);
    }


    public static function list()
    {
        $db = new Database();

        $result = $db->select('news');

        var_dump($result);
    }
}