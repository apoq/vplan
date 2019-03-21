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

/* base/base.html */
class __TwigTemplate_dc78b075c3dbfc04ef4bcb80f7dd4de5bcfbb0ee42e57d240e41d8bf98e97894 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'head' => [$this, 'block_head'],
            'content' => [$this, 'block_content'],
            'footer' => [$this, 'block_footer'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">

";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 19
        echo "
<body>

<!-- Navigation -->
<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark static-top\">
    <div class=\"container\">
        <a class=\"navbar-brand\" href=\"/\">VPlan</a>
        <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
            <span class=\"navbar-toggler-icon\"></span>
        </button>
        <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
            <ul class=\"navbar-nav ml-auto\">
                <li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"/\">Home
                        <span class=\"sr-only\">(current)</span>
                    </a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"/users\">Users</a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"/plans\">Plans</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class=\"container\">
    ";
        // line 49
        $this->displayBlock('content', $context, $blocks);
        // line 50
        echo "</div>

";
        // line 52
        $this->displayBlock('footer', $context, $blocks);
        // line 57
        echo "
</body>

</html>
";
    }

    // line 4
    public function block_head($context, array $blocks = [])
    {
        // line 5
        echo "<head>

    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <title>Vplan</title>

    <!-- Bootstrap core CSS -->
    <link href=\"assets/vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">

</head>
";
    }

    // line 49
    public function block_content($context, array $blocks = [])
    {
    }

    // line 52
    public function block_footer($context, array $blocks = [])
    {
        // line 53
        echo "<!-- Bootstrap core JavaScript -->
<script src=\"assets/vendor/jquery/jquery.min.js\"></script>
<script src=\"assets/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "base/base.html";
    }

    public function getDebugInfo()
    {
        return array (  121 => 53,  118 => 52,  113 => 49,  96 => 5,  93 => 4,  85 => 57,  83 => 52,  79 => 50,  77 => 49,  45 => 19,  43 => 4,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "base/base.html", "/home/apoq/PhpstormProjects/vplan/app/views/base/base.html");
    }
}
