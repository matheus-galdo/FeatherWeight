<?php
namespace Core;

use Core\Presentation\View;
use App\Routes\RouteList;
use Core\Presentation\Sources;

/**
 * Chama uma controller de acordo com o resultado do $route->requestController
 */
class Core{
    protected $method;
    protected $uri;

    public function __construct(){
        $requestData = (object) $GLOBALS['_SERVER'];
        $this->method = $requestData->REQUEST_METHOD;
        $this->uri = $requestData->REQUEST_URI;
        


        $route = new Route();
        if ($this->fileRequest()) {
            $routeList = new Sources($route);
        } else {
            $routeList = new RouteList($route);
        }
        
        // var_dump(file_get_contents(__DIR__."/../public/images/delcidio.jpg"));
        // var_dump(__DIR__."/../public/images/delcidio.jpg");
        

        

        // var_dump($requestData);
        $twig = new View();
        echo $route->requestController($this->uri);
    }

    public function fileRequest()
    {
        $fileRequest = false;
        
        if(strpos($this->uri, "css")!== false){
            $fileRequest = true;
        }

        if(strpos($this->uri, "js")!== false){
            $fileRequest = true;
        }

        if(strpos($this->uri, "images")!== false){
            $fileRequest = true;
        }

        return $fileRequest;
    }
}