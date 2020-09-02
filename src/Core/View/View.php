<?php
namespace FeatherWeight\View;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class View{
    private $twigEnviroment;
    
    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__.'/../../../views');
        $twig = new Environment($loader, [
            'cache' => __DIR__.'/../../cache',
            'auto_reload' => true,
        ]);

        $this->twigEnviroment = $twig; 
    }
    

    public function render(string $fileName, array $context = [])
    {
        $fileName = str_replace(".html", "", $fileName);
        $fileName .= ".html";

        $context['publicPath'] = "/".APLICATION_NAME."/public/";
        return $this->twigEnviroment->render($fileName, $context);
    }

    public function renderTemplate(string $pageName, string $content = null, array $cssFiles = [], $lvl = 1)
    {
        

        $cssString = "";
        foreach ($cssFiles as $value) {
            $cssString .= "<link rel='stylesheet' href='/".APLICATION_NAME."/public/css/{$value}'>";
        }
        return $this->render('template.html', [
            'publicPath' => "/".APLICATION_NAME."/public/",
            'title' => $pageName,
            'content' => $content,
            'style' => $cssString,
            'home' =>  "/".APLICATION_NAME,
            'maincss' => "/".APLICATION_NAME."css/main.css",
        ]);

    }
}