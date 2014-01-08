<?php

/* garden/index/index */
class __TwigTemplate_c827ddc3698aa1936ed3ac5b7e262000 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"inner-container\">
    <!-- Sidebar -->
    <aside id=\"page-sidebar\" class=\"nav-collapse collapse\">
        <!-- Sidebar search -->
        <form id=\"sidebar-search\" method=\"post\" onsubmit=\"return false;\">
            <div class=\"input-append\">
                <input type=\"text\" placeholder=\"Search..\" class=\"remove-box-shadow remove-transition remove-radius\">
                <button><i class=\"icon-search\"></i></button>
            </div>
        </form>
        <!-- END Sidebar search -->

        <!-- Primary Navigation -->
        <nav id=\"primary-nav\">
           <!-- partials/display_nav.phtml -->
        </nav>
        <!-- END Primary Navigation -->

    </aside>
    <!-- END Sidebar -->
    <!-- Page Content -->
    <div id=\"page-content\">
        <!-- Navigation info -->
        <ul id=\"nav-info\" class=\"clearfix\">
            <li><a href=\"/\"><i class=\"icon-home\"></i></a></li>
        </ul>
        <!-- END Navigation info -->

        <table id=\"tuinplanten-datatables\" class=\"table table-striped table-bordered table-hover\">
            <thead>
                <tr>
                    <th style=\"text-align:left;\"><span class=\"gemicon-small-basil\"></span><a href=\"\">naam</a></th>
                    <th><span class=\"gemicon-small-home\" /></th>
                    <th><a href=\"\">hoogte</a></th>
                    <th><span class=\"gemicon-small-flag\" /></th>
                    <th><a href=\"\">plant datum</a></th>
                    <th><span class=\"gemicon-small-upload\" /></th>
                    <th><span class=\"gemicon-small-download\" /></th>
                    <th><span class=\"gemicon-small-clipboard\" /></th>
                    <th><span class=\"gemicon-small-eye-view\" /></th>
                    <th><span class=\"gemicon-small-photo\" /></th>
                    <th class=\"actions\"></th>
                </tr>
            </thead>
            <tbody>
                ";
        // line 46
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["plants"]) ? $context["plants"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["plant"]) {
            // line 47
            echo "                    <tr>
                        <td class=\"plant\" id=\"";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getId", array(), "method"), "html", null, true);
            echo "\">
                            <a href=\"#\">
                            </a>
                            <p class=\"latin_name\">";
            // line 51
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getDutchName", array(), "method"), "html", null, true);
            echo "</p>
                        </td>
                        <td>";
            // line 53
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getIndigenous", array(), "method"), "html", null, true);
            echo "</td>
                        <td class=\"text_center\">";
            // line 54
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getHeight", array(), "method"), "html", null, true);
            echo "&nbsp;</td>
                        <td>";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getOrigin", array(), "method"), "html", null, true);
            echo "&nbsp;</td>
                        <td class=\"text_center\">";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getPlantingDate", array(), "method"), "html", null, true);
            echo "&nbsp;</td>
                        <td>";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["months"]) ? $context["months"] : null), $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getBloomingStart", array(), "method"), array(), "array"), "html", null, true);
            echo "</td>
                        <td>";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["months"]) ? $context["months"] : null), $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getBloomingEnd", array(), "method"), array(), "array"), "html", null, true);
            echo "</td>
                        <td>";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getDetails", array(), "method"), "html", null, true);
            echo "&nbsp;</td>
                        <td>";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getPresent", array(), "method"), "html", null, true);
            echo "</td>
                        <td class=\"photo\" id=\"";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plant"]) ? $context["plant"] : null), "getId", array(), "method"), "html", null, true);
            echo "\">

                        </td>
                        <td class=\"actions\">
                            <!--<a class=\"icon-eye-open\" href=\"\">
                            </a>-->
                            <a class=\"icon-edit\" href=\"#\">
                            </a>
                            <a class=\"icon-trash\" href=\"#\">
                            </a>
                        </td>
                    </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['plant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 74
        echo "            </tbody>
        </table>
        <div id=\"popupdata\">

        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "garden/index/index";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 74,  116 => 61,  112 => 60,  108 => 59,  104 => 58,  100 => 57,  96 => 56,  92 => 55,  88 => 54,  84 => 53,  79 => 51,  73 => 48,  70 => 47,  66 => 46,  19 => 1,);
    }
}
