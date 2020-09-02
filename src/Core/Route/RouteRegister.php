<?php
namespace FeatherWeight\Route;

use App\Controller\StartController;
use App\Controller\TestController;
use Core\Presentation\View;

/**
 * Registra todas as Rotas definidas pela da aplicação
 */
class RouteRegister{
    protected $routeList;
    protected $routeListType;
    protected $resourceController;
    protected $resourceMethod;
    
        
    /**
     * Registra uma rota GET e define qual recurso requisitar quando a rota for acessada
     * 
     * @param  string $uri
     * [required] URI da rota a ser registrada.
     * 
     * @param  string|closure $resource
     * [required] Nome da classe, nome da classe@metodo ou função closure que a rota deverá
     * requisitar.
     * 
     * @param  array $data
     * [optional] Parametros para a execução de um determinado método da classe
     * 
     * @return void
     */
    public function get(string $uri, $resource, array $data = [])
    {
        $this->registerRoute("get", $uri, $resource, $data);
    }

        
    /**
     * Registra uma rota POST e define qual recurso requisitar quando a rota for acessada
     * 
     * @param  string $uri
     * [required] URI da rota a ser registrada.
     * 
     * @param  string|closure $resource
     * [required] Nome da classe, nome da classe@metodo ou função closure que a rota deverá
     * requisitar.
     * 
     * @param  array $data
     * [optional] Parametros para a execução de um determinado método da classe
     * 
     * @return void
     */
    public function post(string $uri, $resource, array $data = [])
    {
        $this->registerRoute("post", $uri, $resource, $data);
    }

    public function view($uri, $data = [])
    {
        $this->routeList[] = "/".$uri;
        $this->routeListType[] = "view";
    }

    
    /**
     * Registra uma rota, seu verbo HTTP, o resource a ser requisitado quando a rota for acessada e os
     * parâmetros necessários para a execução do resource 
     *
     * @param  string $httpVerb
     * @param  string $uri
     * @param  mixed $resource
     * @param  array $data
     * @return void
     */
    public function registerRoute(string $httpVerb, string $uri, $resource, array $data = [])
    {
        $uri = ($uri == "/")? "": $uri;
        $this->routeList[] = "/".$uri;
        $this->routeListType[] = $httpVerb;
        
        //$resource(); para quando for passado um callback, ver dps

        
        if(is_string($resource)){
            $hasMethod = strpos($resource, "@");
            if ($hasMethod) {
                $this->resourceController[] = substr($resource, 0, $hasMethod);
                $this->resourceMethod[] = substr($resource, $hasMethod+1);
            }else{
                $this->resourceController[] = $resource;
                $this->resourceMethod[] = "index";
            } 
        }
    }

    public function getExistingRoutes()
    {
        return $this->routeList;
    }

    public function getResourceMethod(int $position)
    {
        return $this->resourceMethod[$position];
    }

    public function getResourceController(int $position)
    {
        return $this->resourceController[$position];
    }
}