<?php
namespace Core\Presentation;
use Core\Route;

class Sources{    
    /*
    |--------------------------------------------------------------------------
    | Web Routes - Sources
    |--------------------------------------------------------------------------
    |
    | Rotas especiais para carregar arquivos para a aplicação, como javascript, css 
    | imagens, videos, etc.
    |
    */
    public function __construct(Route $route){
        $route->get("css/main.css", "test@css");
        $route->get("js/main.js", "test@js");
        $route->get("images/delcidio.jpg", "test@image");
    }
}

