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

/* front/users.html */
class __TwigTemplate_bbc1b1bc1c7210a51d0304924207da561b7857f03a68b27ed2a87c5285c8fa7d extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base/base.html", "front/users.html", 1);
        $this->blocks = [
            'content' => [$this, 'block_content'],
            'footer' => [$this, 'block_footer'],
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
        <h1 class=\"mt-5\">Users</h1>
    </div>
    <div class=\"col-lg-6 text-center\">
        <h1 class=\"mt-5\">
        <button class=\"btn btn-info btn-lg create-user\"
                data-toggle=\"collapse\"
                data-target=\"#multi-collapse-\"
                role=\"button\">Create User <i class=\"fas fa-plus-circle\"></i></button>
        </h1>
    </div>
</div>
<br/>
<div class=\"row\">
    <div class=\"col-lg-12\">
        <div class=\"collapse\" id=\"multi-collapse-\">
            <div class=\"card card-body bg-light\">
                ";
        // line 22
        echo twig_include($this->env, $context, "base/user_form.html");
        echo "
            </div>
        </div>
    </div>
</div>
<div class=\"row\">
    <div class=\"col-lg-12 text-center\">
        <table class=\"table\">
            <thead>
            <tr>
                <th scope=\"col\">ID</th>
                <th scope=\"col\">First Name</th>
                <th scope=\"col\">Actions</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 38
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 39
            echo "            <tr>
                <th scope=\"row\">";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "Id", []), "html", null, true);
            echo "</th>
                <td class=\"fname\">";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "FirstName", []), "html", null, true);
            echo "</td>
                <td>
                    <div class=\"btn-group\" role=\"group\" aria-label=\"Button group with nested dropdown\">
                        <button class=\"btn btn-info btn-lg edit-user\"
                                data-toggle=\"collapse\"
                                data-target=\"#multi-collapse-";
            // line 46
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "Id", []), "html", null, true);
            echo "\"
                                role=\"button\">
                            <i class=\"fas fa-edit\"></i>
                        </button>
                        <button class=\"btn btn-danger btn-lg delete-user\" data-id=\"";
            // line 50
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "Id", []), "html", null, true);
            echo "\">
                            <i class=\"fas fa-times-circle\"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan=\"3\">
                    <div class=\"collapse multi-collapse\" id=\"multi-collapse-";
            // line 58
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "Id", []), "html", null, true);
            echo "\">
                        <div class=\"card card-body bg-light\">
                            ";
            // line 60
            echo twig_include($this->env, $context, "base/user_form.html");
            echo "
                        </div>
                    </div>
                </td>
            </tr>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        echo "            </tbody>
        </table>
    </div>
</div>
";
    }

    // line 72
    public function block_footer($context, array $blocks = [])
    {
        // line 73
        echo "<script>
    \$(document).ready(function () {
        var saveUser = function() {
            var parent = \$(this).parent();
            var userId = parent.attr('data-user-id');
            var email = parent.find(\"input#inpEmail\").val();
            var firstName = parent.find(\"input#inpFirstName\").val();
            var lastName = parent.find(\"input#inpLastName\").val();
            var data = {email: email, first_name: firstName, last_name: lastName};

            if (userId.length <= 0) {
                \$.ajax({
                    method: \"post\",
                    url: \"/api/v1/users\",
                    data: data,
                    contentType: \"application/x-www-form-urlencoded\"
                }).done(function(data) {
                    var newUserId = data.Id;
                    \$.get(\"/widgets/users/\" + newUserId).done(function(data) {
                        \$(\"tbody\").append(data);
                        \$('.save-user').unbind();
                        \$('.delete-user').unbind();
                        \$('.save-user').on('click', saveUser);
                        \$('.delete-user').on('click', deleteUser);
                    });
                });
            } else {
                \$.ajax({
                    method: \"put\",
                    url: \"/api/v1/users/\" + userId,
                    data: data,
                    contentType: \"application/x-www-form-urlencoded\"
                }).done(function (data) {
                    if (firstName.length > 0) {
                        parent.parents(\"tr\").prev(\"tr\").find(\"td.fname\").text(firstName);
                    }
                });
            }
        };

        var deleteUser = function() {
            var root = \$(this);
            var userId = \$(this).attr('data-id');

            \$.ajax({
                method: \"delete\",
                url: \"/api/v1/users/\" + userId,
            }).done(function () {
                root.parents(\"tr\").next().remove();
                root.parents(\"tr\").remove();
            });
        };

        \$('.save-user').on('click', saveUser);
        \$('.delete-user').on('click', deleteUser);
    })
</script>
";
    }

    public function getTemplateName()
    {
        return "front/users.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  173 => 73,  170 => 72,  162 => 66,  142 => 60,  137 => 58,  126 => 50,  119 => 46,  111 => 41,  107 => 40,  104 => 39,  87 => 38,  68 => 22,  48 => 4,  45 => 3,  27 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base/base.html\" %}

{% block content %}
<div class=\"row\">
    <div class=\"col-lg-6 text-center\">
        <h1 class=\"mt-5\">Users</h1>
    </div>
    <div class=\"col-lg-6 text-center\">
        <h1 class=\"mt-5\">
        <button class=\"btn btn-info btn-lg create-user\"
                data-toggle=\"collapse\"
                data-target=\"#multi-collapse-\"
                role=\"button\">Create User <i class=\"fas fa-plus-circle\"></i></button>
        </h1>
    </div>
</div>
<br/>
<div class=\"row\">
    <div class=\"col-lg-12\">
        <div class=\"collapse\" id=\"multi-collapse-\">
            <div class=\"card card-body bg-light\">
                {{ include('base/user_form.html') }}
            </div>
        </div>
    </div>
</div>
<div class=\"row\">
    <div class=\"col-lg-12 text-center\">
        <table class=\"table\">
            <thead>
            <tr>
                <th scope=\"col\">ID</th>
                <th scope=\"col\">First Name</th>
                <th scope=\"col\">Actions</th>
            </tr>
            </thead>
            <tbody>
            {% for user in users %}
            <tr>
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
            </tr>
            {% endfor %}
            </tbody>
        </table>
    </div>
</div>
{% endblock %}

{% block footer %}
<script>
    \$(document).ready(function () {
        var saveUser = function() {
            var parent = \$(this).parent();
            var userId = parent.attr('data-user-id');
            var email = parent.find(\"input#inpEmail\").val();
            var firstName = parent.find(\"input#inpFirstName\").val();
            var lastName = parent.find(\"input#inpLastName\").val();
            var data = {email: email, first_name: firstName, last_name: lastName};

            if (userId.length <= 0) {
                \$.ajax({
                    method: \"post\",
                    url: \"/api/v1/users\",
                    data: data,
                    contentType: \"application/x-www-form-urlencoded\"
                }).done(function(data) {
                    var newUserId = data.Id;
                    \$.get(\"/widgets/users/\" + newUserId).done(function(data) {
                        \$(\"tbody\").append(data);
                        \$('.save-user').unbind();
                        \$('.delete-user').unbind();
                        \$('.save-user').on('click', saveUser);
                        \$('.delete-user').on('click', deleteUser);
                    });
                });
            } else {
                \$.ajax({
                    method: \"put\",
                    url: \"/api/v1/users/\" + userId,
                    data: data,
                    contentType: \"application/x-www-form-urlencoded\"
                }).done(function (data) {
                    if (firstName.length > 0) {
                        parent.parents(\"tr\").prev(\"tr\").find(\"td.fname\").text(firstName);
                    }
                });
            }
        };

        var deleteUser = function() {
            var root = \$(this);
            var userId = \$(this).attr('data-id');

            \$.ajax({
                method: \"delete\",
                url: \"/api/v1/users/\" + userId,
            }).done(function () {
                root.parents(\"tr\").next().remove();
                root.parents(\"tr\").remove();
            });
        };

        \$('.save-user').on('click', saveUser);
        \$('.delete-user').on('click', deleteUser);
    })
</script>
{% endblock %}", "front/users.html", "/home/apoq/PhpstormProjects/vplan/app/views/front/users.html");
    }
}
