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

/* front/plans.html */
class __TwigTemplate_ae33853456d790def7affa93ebddf7c0c8721f368ae4c78f8ad57026d7fe890c extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base/base.html", "front/plans.html", 1);
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
    <div class=\"col-lg-6 text-center\">
        <h1 class=\"mt-5\">Plans</h1>
    </div>
    <div class=\"col-lg-6 text-center\">
        <h1 class=\"mt-5\">
            <button class=\"btn btn-info btn-lg create-user\"
                    data-toggle=\"collapse\"
                    data-target=\"#multi-collapse-\"
                    role=\"button\">Create Plan <i class=\"fas fa-plus-circle\"></i></button>
        </h1>
    </div>
</div>
<br/>
<div class=\"row\">
    <div class=\"col-lg-12 text-center\">
        <table class=\"table\">
            <thead>
            <tr>
                <th scope=\"col\">ID</th>
                <th scope=\"col\">Title</th>
                <th scope=\"col\">Action</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["plans"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["plan"]) {
            // line 30
            echo "            <tr>
                <th scope=\"row\">";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plan"], "Id", []), "html", null, true);
            echo "</th>
                <td>";
            // line 32
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plan"], "Title", []), "html", null, true);
            echo "</td>
                <td>
                    <div class=\"btn-group\" role=\"group\" aria-label=\"Button group with nested dropdown\">
                        <button class=\"btn btn-info btn-lg edit-user\"
                                data-toggle=\"collapse\"
                                data-target=\"#multi-collapse-";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "Id", []), "html", null, true);
            echo "\"
                                role=\"button\">
                            <i class=\"fas fa-edit\"></i>
                        </button>
                        <button class=\"btn btn-danger btn-lg delete-user\" data-id=\"";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "Id", []), "html", null, true);
            echo "\">
                            <i class=\"fas fa-times-circle\"></i>
                        </button>
                    </div>
                </td>
            </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['plan'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "            </tbody>
        </table>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "front/plans.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 48,  100 => 41,  93 => 37,  85 => 32,  81 => 31,  78 => 30,  74 => 29,  47 => 4,  44 => 3,  27 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base/base.html\" %}

{% block content %}
<div class=\"row\">
    <div class=\"col-lg-6 text-center\">
        <h1 class=\"mt-5\">Plans</h1>
    </div>
    <div class=\"col-lg-6 text-center\">
        <h1 class=\"mt-5\">
            <button class=\"btn btn-info btn-lg create-user\"
                    data-toggle=\"collapse\"
                    data-target=\"#multi-collapse-\"
                    role=\"button\">Create Plan <i class=\"fas fa-plus-circle\"></i></button>
        </h1>
    </div>
</div>
<br/>
<div class=\"row\">
    <div class=\"col-lg-12 text-center\">
        <table class=\"table\">
            <thead>
            <tr>
                <th scope=\"col\">ID</th>
                <th scope=\"col\">Title</th>
                <th scope=\"col\">Action</th>
            </tr>
            </thead>
            <tbody>
            {% for plan in plans %}
            <tr>
                <th scope=\"row\">{{ plan.Id }}</th>
                <td>{{ plan.Title }}</td>
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
            {% endfor %}
            </tbody>
        </table>
    </div>
</div>
{% endblock %}", "front/plans.html", "/home/apoq/PhpstormProjects/vplan/app/views/front/plans.html");
    }
}
