<?php
namespace Core\Route;

use App\Controller\StartController;
use App\Controller\TestController;
use Core\Presentation\View;

/**
 * Cria e gerencia as Rotas da aplicação
 */
class RouteRequest{
    protected $routeList;
    protected $routeListType;
    protected $resourceController;
    protected $resourceMethod;
    
        
    /**
     * Recebe uma requisição GET e carrega os arquivos referentes a rota solicitada
     * 
     * @param  string $uri
     * [required] URI da rota solicitada.
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
        $this->prepereRequestedMethod("get", $uri, $resource, $data);
        $a = new StartController();
    }

        
    /**
     * Recebe uma requisição POST e carrega os arquivos referentes a rota solicitada
     * 
     * @param  string $uri
     * [required] URI da rota solicitada.
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
        $this->prepereRequestedMethod("post", $uri, $resource, $data);
    }

    public function view($uri, $data = [])
    {
        $this->routeList[] = "/".$uri;
        $this->routeListType[] = "view";
    }

    
    /**
     * Prepara a requisição de um método da controller de acordo com o verbo http definido
     *
     * @param  string $httpVerb
     * @param  string $uri
     * @param  mixed $resource
     * @param  array $data
     * @return void
     */
    public function prepereRequestedMethod(string $httpVerb, string $uri, $resource, array $data = [])
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

    
    
    
    /**
     * Executa um método de uma controller em callback de acordo com a rota especificada  
     *
     * @param  mixed $requestedUri
     * @return callback
     */
    public function requestController(string $requestedUri, string $namespace = "App\\Controller\\")
    {   
        $appName = "miniFramework"; //definir nas configs !important
        $requestedUri = substr($requestedUri, strpos($requestedUri,$appName) + strlen($appName));

        if (in_array($requestedUri,$this->routeList)) {
            $resourcePosition = array_search($requestedUri, $this->routeList);

            $resource = [
                $namespace.ucfirst($this->resourceController[$resourcePosition])."Controller",
                $this->resourceMethod[$resourcePosition]
            ];

            $resourceParameters = [
                "viewObj" => new View()
            ];


            
            return call_user_func_array($resource, $resourceParameters);
            
        }
        return "view de erro 401"; 
    }
    
    /**
     * Lista todas as rotas existentes na aplicação (debugging)
     *
     * @return void
     */
    public function listarRotas()
    {
        var_dump($this->routeList);
    }
}