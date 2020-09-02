<?php
namespace FeatherWeight\Presentation;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class View{
    private $twigEnviroment;
    
    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__.'/../../views');
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
        return $this->twigEnviroment->render($fileName, $context);
    }

    public function renderTemplate(string $pageName, string $content = null, array $cssFiles = [], $lvl = 1)
    {
        $pathLevel = "";
        for ($i=0; $i < $lvl ; $i++) { 
            $pathLevel .= '../';
        }


        


        $cssString = "";
        foreach ($cssFiles as $value) {
            $cssString .= "<link rel='stylesheet' href='{$pathLevel}css/{$value}'>";
        }
        
        return $this->render('template.html', [
            'title' => $pageName,
            'content' => $content,
            'style' => $cssString,
            'home' =>  $pathLevel,
            'maincss' => $pathLevel."css/main.css",
        ]);

    }
}