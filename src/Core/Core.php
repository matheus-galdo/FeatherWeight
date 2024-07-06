<?php
namespace FeatherWeight;

use FeatherWeight\Http\HttpHandler;

/**
 * Recebe uma requisição HTTP e gera uma resposta de acordo com o resource solicitado
 */
class Core{
    protected $method;
    protected $uri;

    public function __construct(){
        //recebe um request
        $app = new HttpHandler();


        //devolve um respose
        echo $app->HttpResponse();
    }
}