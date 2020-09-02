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

/* home.html */
class __TwigTemplate_ee3c53a9556c599b169b3a134afa38b9479998970b01bd707187c2431553ee03 extends Template
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
        echo "<img src=\"";
        echo twig_escape_filter($this->env, ($context["publicPath"] ?? null), "html", null, true);
        echo "images/logoFull.png\" alt=\"\">
<ul class=\"home-links\">
    <a href=\"\"target=\"_blank\"><li>Documentation</li></a>
    <a href=\"\" target=\"_blank\"><li>Packegist</li></a>
    <a href=\"https://github.com/galdo0139/FeatherWeight.git\" target=\"_blank\"><li>GitHub</li></a>
</ul>";
    }

    public function getTemplateName()
    {
        return "home.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "home.html", "C:\\wamp64\\www\\miniFramework\\views\\home.html");
    }
}
