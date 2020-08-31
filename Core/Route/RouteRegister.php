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
     * Lista todas as rotas existentes na aplicação (debugging)
     *
     * @return void
     */
    public function listarRotas()
    {
        var_dump($this->routeList);
    }
}