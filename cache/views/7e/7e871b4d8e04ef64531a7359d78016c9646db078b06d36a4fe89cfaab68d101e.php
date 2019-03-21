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
class __TwigTemplate_a16814fd814018aa8884d2cbcccdbee7b38b8dc2d52b9fa8f02d1590baca1fa5 extends \Twig\Template
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
    </div>
</div>
<div class=\"row\">
    <div class=\"col-sm-6 text-center\">
        <a href=\"/users\" class=\"btn btn-primary btn-lg active\" role=\"button\" aria-pressed=\"true\">Users <i class=\"fas fa-user\"></i></a>
    </div>
    <div class=\"col-sm-6 text-center\">
        <a href=\"/plans\" class=\"btn btn-primary btn-lg active\" role=\"button\" aria-pressed=\"true\">Plans <i class=\"fas fa-file-alt\"></i></a>
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
        return new Source("{% extends \"base/base.html\" %}

{% block content %}
<div class=\"row\">
    <div class=\"col-lg-12 text-center\">
        <h1 class=\"mt-5\">Dashboard</h1>
    </div>
</div>
<div class=\"row\">
    <div class=\"col-sm-6 text-center\">
        <a href=\"/users\" class=\"btn btn-primary btn-lg active\" role=\"button\" aria-pressed=\"true\">Users <i class=\"fas fa-user\"></i></a>
    </div>
    <div class=\"col-sm-6 text-center\">
        <a href=\"/plans\" class=\"btn btn-primary btn-lg active\" role=\"button\" aria-pressed=\"true\">Plans <i class=\"fas fa-file-alt\"></i></a>
    </div>
</div>
{% endblock %}", "front/index.html", "/home/apoq/PhpstormProjects/vplan/app/views/front/index.html");
    }
}
