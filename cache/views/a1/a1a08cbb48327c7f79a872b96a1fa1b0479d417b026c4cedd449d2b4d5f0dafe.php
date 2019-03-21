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

/* base/user_form.html */
class __TwigTemplate_837dd60e19c19cc0d9199ea65145e11725065f401ea0a9a0f870c7b5726ac702 extends \Twig\Template
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
        echo "<form data-user-id=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "Id", []), "html", null, true);
        echo "\">
    <div class=\"form-group\">
        <label for=\"inpEmail\">Email address</label>
        <input type=\"email\" class=\"form-control\" id=\"inpEmail\" placeholder=\"Enter email\" value=\"";
        // line 4
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "Email", []), "html", null, true);
        echo "\">
    </div>
    <div class=\"form-group\">
        <label for=\"inpFirstName\">First name</label>
        <input type=\"text\" class=\"form-control\" id=\"inpFirstName\" placeholder=\"Enter first name\" value=\"";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "FirstName", []), "html", null, true);
        echo "\">
    </div>
    <div class=\"form-group\">
        <label for=\"inpLastName\">Last name</label>
        <input type=\"text\" class=\"form-control\" id=\"inpLastName\" placeholder=\"Enter last name\" value=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "LastName", []), "html", null, true);
        echo "\">
    </div>
    <button type=\"button\" class=\"btn btn-primary save-user\" data-toggle=\"collapse\" data-target=\"#multi-collapse-";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "Id", []), "html", null, true);
        echo "\">Save</button>
</form>";
    }

    public function getTemplateName()
    {
        return "base/user_form.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 14,  56 => 12,  49 => 8,  42 => 4,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<form data-user-id=\"{{ user.Id }}\">
    <div class=\"form-group\">
        <label for=\"inpEmail\">Email address</label>
        <input type=\"email\" class=\"form-control\" id=\"inpEmail\" placeholder=\"Enter email\" value=\"{{ user.Email }}\">
    </div>
    <div class=\"form-group\">
        <label for=\"inpFirstName\">First name</label>
        <input type=\"text\" class=\"form-control\" id=\"inpFirstName\" placeholder=\"Enter first name\" value=\"{{ user.FirstName }}\">
    </div>
    <div class=\"form-group\">
        <label for=\"inpLastName\">Last name</label>
        <input type=\"text\" class=\"form-control\" id=\"inpLastName\" placeholder=\"Enter last name\" value=\"{{ user.LastName }}\">
    </div>
    <button type=\"button\" class=\"btn btn-primary save-user\" data-toggle=\"collapse\" data-target=\"#multi-collapse-{{ user.Id }}\">Save</button>
</form>", "base/user_form.html", "/home/apoq/PhpstormProjects/vplan/app/views/base/user_form.html");
    }
}
