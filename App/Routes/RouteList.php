<?php
namespace App\Routes;
use Core\Route;

class RouteList{    
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Registre aqui todas as rotas web existentes na sua aplicação. Elas serão 
    | automaticamente carregadas pelo core do framework que as deixará disponíveis
    |
    */
    public function __construct(Route $route){
        $route->get("/", "start");
        $route->get("salve", "test");
        $route->get("outra", "start@logar");
        $route->get("mais/rota", "test@ota");
    }
}

