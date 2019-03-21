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

/* widgets/tr.user.html */
class __TwigTemplate_e6e9553192007249edd4e2f011edcf934fb09bccab5ce04d036cc4457d9da231 extends \Twig\Template
{
    private $source;

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
        // line 1
        echo "<tr>
    <th scope=\"row\">";
        // line 2
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "Id", []), "html", null, true);
        echo "</th>
    <td class=\"fname\">";
        // line 3
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "FirstName", []), "html", null, true);
        echo "</td>
    <td>
        <div class=\"btn-group\" role=\"group\" aria-label=\"Button group with nested dropdown\">
            <button class=\"btn btn-info btn-lg edit-user\"
                    data-toggle=\"collapse\"
                    data-target=\"#multi-collapse-";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "Id", []), "html", null, true);
        echo "\"
                    role=\"button\">
                <i class=\"fas fa-edit\"></i>
            </button>
            <button class=\"btn btn-danger btn-lg delete-user\" data-id=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "Id", []), "html", null, true);
        echo "\">
                <i class=\"fas fa-times-circle\"></i>
            </button>
        </div>
    </td>
</tr>
<tr>
    <td colspan=\"3\">
        <div class=\"collapse multi-collapse\" id=\"multi-collapse-";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "Id", []), "html", null, true);
        echo "\">
            <div class=\"card card-body bg-light\">
                ";
        // line 22
        echo twig_include($this->env, $context, "base/user_form.html");
        echo "
            </div>
        </div>
    </td>
</tr>";
    }

    public function getTemplateName()
    {
        return "widgets/tr.user.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 22,  68 => 20,  57 => 12,  50 => 8,  42 => 3,  38 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<tr>
    <th scope=\"row\">{{ user.Id }}</th>
    <td class=\"fname\">{{ user.FirstName }}</td>
    <td>
        <div class=\"btn-group\" role=\"group\" aria-label=\"Button group with nested dropdown\">
            <button class=\"btn btn-info btn-lg edit-user\"
                    data-toggle=\"collapse\"
                    data-target=\"#multi-collapse-{{ user.Id }}\"
                    role=\"button\">
                <i class=\"fas fa-edit\"></i>
            </button>
            <button class=\"btn btn-danger btn-lg delete-user\" data-id=\"{{ user.Id }}\">
                <i class=\"fas fa-times-circle\"></i>
            </button>
        </div>
    </td>
</tr>
<tr>
    <td colspan=\"3\">
        <div class=\"collapse multi-collapse\" id=\"multi-collapse-{{ user.Id }}\">
            <div class=\"card card-body bg-light\">
                {{ include('base/user_form.html') }}
            </div>
        </div>
    </td>
</tr>", "widgets/tr.user.html", "/home/apoq/PhpstormProjects/vplan/app/views/widgets/tr.user.html");
    }
}
