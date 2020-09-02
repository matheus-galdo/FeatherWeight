<?php
namespace FeatherWeight\Route;

use FeatherWeight\Route\RouteInterface;
use FeatherWeight\Route\RouteRegister;

class Sources  implements RouteInterface{    
    /*
    |--------------------------------------------------------------------------
    | Web Routes - Sources
    |--------------------------------------------------------------------------
    |
    | Rotas especiais para carregar arquivos para a aplicação, como javascript, css 
    | imagens, videos, etc.
    |
    */
    public function createRoutes(RouteRegister $route){
        $route->get("css/main.css", "test@css");
        $route->get("js/main.js", "test@js");
        $route->get("images/delcidio.jpg", "test@image");
    }
}
