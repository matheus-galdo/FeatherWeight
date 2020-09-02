<?php
namespace App\Routes;

use FeatherWeight\Route\RouteInterface;
use FeatherWeight\Route\RouteRegister;

class RouteList implements RouteInterface{    
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Registre aqui todas as rotas web existentes na sua aplicação. Elas serão 
    | automaticamente carregadas pelo core do framework que as deixará disponíveis
    |
    */
    public function createRoutes(RouteRegister $route){
        $route->get("/", "start");
    }
}

