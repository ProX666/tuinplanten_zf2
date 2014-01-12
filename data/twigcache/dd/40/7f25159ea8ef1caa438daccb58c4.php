<?php

/* garden/habitat/index */
class __TwigTemplate_dd407f25159ea8ef1caa438daccb58c4 extends Twig_Template
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
    <aside id=\"page-sidebar\" class=\"nav-collapse\">
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
            ";
        // line 15
        $this->env->loadTemplate("garden/template/display_nav.twig")->display($context);
        // line 16
        echo "            </nav>
            <!-- END Primary Navigation -->

        </aside>
        <!-- END Sidebar -->
        <!-- Page Content -->
        <div id=\"page-content\">
            <!-- Navigation info -->
            <ul id=\"nav-info\" class=\"clearfix\">
                <li><a href=\"/plants\"><i class=\"icon-home\"></i></a></li>
            </ul>
            <!-- END Navigation info -->

            <table id=\"tuinplanten-datatables\" class=\"table table-striped table-bordered table-hover\">
                <thead>
                    <tr>
                        <th style=\"text-align:left;\"><span class=\"gemicon-small-basil\"></span><a href=\"\">groeiplaats</a></th>
                        <th class=\"actions\"></th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 37
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["habitats"]) ? $context["habitats"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["habitat"]) {
            // line 38
            echo "                        <tr>
                            <td class=\"text_center\">";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["habitat"]) ? $context["habitat"] : null), "getHabitat", array(), "method"), "html", null, true);
            echo "&nbsp;</td>
                            <td class=\"actions\">
                                <a class=\"icon-edit\" href=\"";
            // line 41
            echo $this->env->getExtension("zfc-twig")->getRenderer()->plugin("url")->__invoke("garden", array("controller" => "habitat", "action" => "edit", "id" => $this->getAttribute((isset($context["habitat"]) ? $context["habitat"] : null), "getId", array(), "method")), array(), 1);
            echo "\"></a>
                                ";
            // line 42
            if (!twig_in_filter($this->getAttribute((isset($context["habitat"]) ? $context["habitat"] : null), "getId", array(), "method"), (isset($context["habitatsUsed"]) ? $context["habitatsUsed"] : null))) {
                // line 43
                echo "                                <a class=\"icon-trash\" href=\"";
                echo $this->env->getExtension("zfc-twig")->getRenderer()->plugin("url")->__invoke("garden", array("controller" => "habitat", "action" => "delete", "id" => $this->getAttribute((isset($context["habitat"]) ? $context["habitat"] : null), "getId", array(), "method")), array(), 1);
                echo "\"></a>
                                ";
            }
            // line 45
            echo "                            </td>
                        </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['habitat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "                    </tbody>
                </table>
            </div>
        </div>";
    }

    public function getTemplateName()
    {
        return "garden/habitat/index";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 48,  84 => 45,  78 => 43,  76 => 42,  72 => 41,  67 => 39,  64 => 38,  60 => 37,  37 => 16,  35 => 15,  19 => 1,);
    }
}
