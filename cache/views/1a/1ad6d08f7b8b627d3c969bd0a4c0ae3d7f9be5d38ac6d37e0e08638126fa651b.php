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
class __TwigTemplate_a666e1a03a4f51f7db99c6b3ea1756de585223798d1a8052a367bfbc4266ef43 extends \Twig\Template
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
        <a class=\"navbar-brand\" href=\"/\"><i class=\"fas fa-football-ball\"></i> VPlan</a>
        <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
            <span class=\"navbar-toggler-icon\"></span>
        </button>
        <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
            <ul class=\"navbar-nav ml-auto\">
                <li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"/\">
                        <i class=\"fas fa-home\"></i> Home
                        <span class=\"sr-only\">(current)</span>
                    </a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"/users\"><i class=\"fas fa-user\"></i> Users</a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"/plans\"><i class=\"fas fa-file-alt\"></i> Plans</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class=\"container\">
    ";
        // line 50
        $this->displayBlock('content', $context, $blocks);
        // line 51
        echo "</div>
<!-- Bootstrap core JavaScript -->
<script src=\"assets/vendor/jquery/jquery.min.js\"></script>
<script src=\"assets/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>

";
        // line 56
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
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <title>Vplan</title>

    <!-- Bootstrap core CSS -->
    <link href=\"assets/vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.8.0/css/all.css\" integrity=\"sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y\" crossorigin=\"anonymous\">
</head>
";
    }

    // line 50
    public function block_content($context, array $blocks = [])
    {
    }

    // line 56
    public function block_footer($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "base/base.html";
    }

    public function getDebugInfo()
    {
        return array (  122 => 56,  117 => 50,  100 => 5,  97 => 4,  89 => 57,  87 => 56,  80 => 51,  78 => 50,  45 => 19,  43 => 4,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">

{% block head %}
<head>

    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <title>Vplan</title>

    <!-- Bootstrap core CSS -->
    <link href=\"assets/vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.8.0/css/all.css\" integrity=\"sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y\" crossorigin=\"anonymous\">
</head>
{% endblock %}

<body>

<!-- Navigation -->
<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark static-top\">
    <div class=\"container\">
        <a class=\"navbar-brand\" href=\"/\"><i class=\"fas fa-football-ball\"></i> VPlan</a>
        <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
            <span class=\"navbar-toggler-icon\"></span>
        </button>
        <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
            <ul class=\"navbar-nav ml-auto\">
                <li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"/\">
                        <i class=\"fas fa-home\"></i> Home
                        <span class=\"sr-only\">(current)</span>
                    </a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"/users\"><i class=\"fas fa-user\"></i> Users</a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"/plans\"><i class=\"fas fa-file-alt\"></i> Plans</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class=\"container\">
    {% block content %}{% endblock %}
</div>
<!-- Bootstrap core JavaScript -->
<script src=\"assets/vendor/jquery/jquery.min.js\"></script>
<script src=\"assets/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>

{% block footer %}{%endblock %}

</body>

</html>
", "base/base.html", "/home/apoq/PhpstormProjects/vplan/app/views/base/base.html");
    }
}
