<?php
namespace FeatherWeight\Http;

use App\Routes\RouteList;
use FeatherWeight\View\View;
use FeatherWeight\Route\Sources;
use FeatherWeight\Route\RouteInterface;
use FeatherWeight\Route\RouteRegister;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

use function PHPUnit\Framework\isNull;

/**
 * Recebe uma requisição http e define qual resource executar 
 */
class HttpHandler{
    private $method;
    private $requestedUri;
    private $responseType = "webPage";
    private $contentType;
    private $projectMainDirectory = __DIR__.'/../../../';
   
    public function __construct()
    {
        $requestData = (object) $GLOBALS['_SERVER'];
        $this->method = $requestData->REQUEST_METHOD;
        $this->requestedUri = $requestData->REQUEST_URI;

        
        $configurations = json_decode(file_get_contents(__DIR__."/../../../config/config.json"));    
        define("APLICATION_NAME", $configurations->mainDirectory);

        $filesExtensions = [
            //image files
            ".png" => "image/png",
            ".jpg" => "image/jpeg",
            ".jpeg" => "image/jpeg",
            ".gif" => "image/gif",

            //video files
            ".avi" => "video",
            ".mp4" => "video",
            ".wmv" => "video",

            //web files
            ".css" => "text/css",
            ".js" => "application/javascript"
        ];

        foreach ($filesExtensions as $extension => $contentType) {
            if(strpos($this->requestedUri, $extension) !== false){
                $this->responseType = "file";
                $this->contentType = $contentType;
                break;
            }
        }

        $this->requestedUri = substr(
            $this->requestedUri, 
            strpos($this->requestedUri,$configurations->mainDirectory) + strlen($configurations->mainDirectory)
        );
    }


    /**
     * Executa um método de uma controller em callback de acordo com a rota especificada  
     *
     * @param  mixed $requestedUri
     * @return callback
     */
    public function HttpResponse(string $namespace = "App\\Controller\\")
    {    
        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register(); //em caso de algum erro de execução, chama o prettyPageHandler para debugar a pagina


        
        //registra as rotas definidas pelo desenvolvedor da aplicação
        $route = new RouteRegister;
        $aplicattionRoutes = new RouteList;
        $aplicattionRoutes->createRoutes($route);
      
        //retorna a chamada de uma controller
        if (in_array($this->requestedUri,$route->getExistingRoutes())) {
            return $this->getControllerResource($route, $namespace);
        }

        //registra rotas relativas aos arquivos e diretorios existentes na pasta public
        $resourceRoutes = new RouteRegister;
        $resourceRoutes->registerFileRoutes($resourceRoutes, $this->projectMainDirectory.'public');
        
        //retorna um arquivo como resposta da solicitação http
        if (in_array($this->requestedUri,$resourceRoutes->getExistingRoutes())) {
            return $this->getFileResource($this->requestedUri, $resourceRoutes);
        }

        header("HTTP/1.0 404 Not Found");
        
        return call_user_func_array([$namespace."StartController", "erro"], ["viewObj" => new View()]);
    }

    
    /**
     * Retorna a chamada de uma controller para gerar a resposta de um request HTTP
     *
     * @param  mixed $route
     * @param  mixed $namespace
     * @return void
     */
    public function getControllerResource(RouteRegister $route, string $namespace)
    {
        $resourcePosition = array_search($this->requestedUri, $route->getExistingRoutes());
        $resouceHttpType = $route->getTypeOfExistingRoutes()[$resourcePosition];

        if($resouceHttpType !== $this->method){

            throw new \Exception("Esta pagina aceita apenas requisições do tipo ".$resouceHttpType, 1);

            return "erro";
        }
        $resource = [
            $namespace.ucfirst($route->getResourceController($resourcePosition))."Controller",
            $route->getResourceMethod($resourcePosition)
        ];
        $resourceParameters = [
            "viewObj" => new View()
        ];
        return call_user_func_array($resource, $resourceParameters);    
    }
    
    /**
     * Retorna uma requisição HTTP do tipo get com um arquivo solicitado
     *
     * @param  string $requestedUri
     * @param  RouteRegister $resourceRoutes
     * @return void
     */
    public function getFileResource(string $requestedUri, RouteRegister $resourceRoutes)
    {
        $resourcePosition = array_search($this->requestedUri, $resourceRoutes->getExistingRoutes());
        $resouceHttpType = $resourceRoutes->getTypeOfExistingRoutes()[$resourcePosition];
        if($resouceHttpType !== $this->method){
            throw new \Exception("Esta pagina aceita apenas requisições do tipo ".$resouceHttpType, 1);
            return "erro";
        }

        header("Content-type: $this->contentType");
        
        $path = $this->projectMainDirectory."public".$this->requestedUri;
        
        return file_get_contents($path);
    }
}