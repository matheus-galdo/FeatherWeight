<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* template.html */
class __TwigTemplate_5c8f377dbb047ecc1829b7c2ac69c3fe10b3557d436081c24b4d58e51065dc2a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["mainCss"] ?? null), "html", null, true);
        echo "\">
    <link rel=\"shortcut icon\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["publicPath"] ?? null), "html", null, true);
        echo "images/logoFeather.png\" type=\"image/x-icon\">
    <title>";
        // line 8
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</title>

    ";
        // line 10
        echo ($context["style"] ?? null);
        echo "
</head>
<body>
    <div id=\"main-container\">
        ";
        // line 14
        echo ($context["content"] ?? null);
        echo "
    </div>
    
</body>
</html>

";
    }

    public function getTemplateName()
    {
        return "template.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 14,  57 => 10,  52 => 8,  48 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "template.html", "C:\\wamp64\\www\\miniFramework\\views\\template.html");
    }
}
