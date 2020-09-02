<?php
namespace FeatherWeight\Http;

use App\Routes\RouteList;
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
    private $requestedUri;
    private $responseType = "webPage";
    private $contentType;
   
    public function __construct()
    {
        $requestData = (object) $GLOBALS['_SERVER'];
        $this->method = $requestData->REQUEST_METHOD;
        $this->requestedUri = $requestData->REQUEST_URI;

        
        $configurations = json_decode(file_get_contents(__DIR__."/../../../config/config.json"));    


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
        $whoops->register();




        
        $route = new RouteRegister;
        $aplicattionRoutes = new RouteList;
        $aplicattionRoutes->createRoutes($route);

        if (in_array($this->requestedUri,$route->getExistingRoutes())) {
            $resourcePosition = array_search($this->requestedUri, $route->getExistingRoutes());
            $resource = [
                $namespace.ucfirst($route->getResourceController($resourcePosition))."Controller",
                $route->getResourceMethod($resourcePosition)
            ];
            $resourceParameters = [
                //  "viewObj" => new View()
            ];

            return call_user_func_array($resource, $resourceParameters);
            
        }

        $sourceRoutes = new Sources;
        $sourceRoutes->createRoutes($route);
        if (in_array($this->requestedUri,$route->getExistingRoutes())) {
            
            header("Content-type: $this->contentType");
            return "*{color: #f00;}";
        }
        // throw new \Exception("Resource não encontrado: verifique se a rota acessada foi cadastrada
        //  corretamente em Routes/RouteList.php", 1);
        
        return "not found"; 
    }
}