<?php
namespace FeatherWeight;

use FeatherWeight\Http\HttpHandler;

/**
 * Chama uma controller de acordo com o resultado do $route->requestController
 */
class Core{
    protected $method;
    protected $uri;

    public function __construct(){

        


        //recebe um request
        $app = new HttpHandler();
        



        //devolve um respose
        echo $app->HttpResponse();




        // echo $route->requestController();

        // $whoops = new Run();
        // $whoops->pushHandler(new PrettyPageHandler);
        // $whoops->register();
    }

    
}