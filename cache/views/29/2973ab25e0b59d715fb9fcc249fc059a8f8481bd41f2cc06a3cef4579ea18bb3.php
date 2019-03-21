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

/* front/index.html */
class __TwigTemplate_1f92270b072b2bd37b1afbc3e3c46aec79d82aab4e6536536611cadbb2f27c5e extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base/base.html", "front/index.html", 1);
        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "base/base.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        // line 4
        echo "<div class=\"row\">
    <div class=\"col-lg-12 text-center\">
        <h1 class=\"mt-5\">Dashboard</h1>
        <ul class=\"list-unstyled\">
            <li><a href=\"/users\">Users</a></li>
            <li><a href=\"/plans\">Plans</a></li>
        </ul>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "front/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 4,  44 => 3,  27 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "front/index.html", "/home/apoq/PhpstormProjects/vplan/app/views/front/index.html");
    }
}
