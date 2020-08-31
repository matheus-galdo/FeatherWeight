<?php
namespace Core;

use Core\Presentation\View;
use App\Routes\RouteList;
use Core\Presentation\Sources;
use Core\Route\RouteRequest;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Chama uma controller de acordo com o resultado do $route->requestController
 */
class Core{
    protected $method;
    protected $uri;

    public function __construct(){

        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();

        $requestData = (object) $GLOBALS['_SERVER'];
        $this->method = $requestData->REQUEST_METHOD;
        $this->uri = $requestData->REQUEST_URI;
        


        $route = new RouteRequest();
        if ($this->fileRequest()) {
            $routeList = new Sources($route);
        } else {
            $routeList = new RouteList($route);
        }
        
        
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