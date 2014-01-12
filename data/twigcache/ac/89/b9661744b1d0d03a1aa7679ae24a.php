<?php

/* garden/feature/edit */
class __TwigTemplate_ac89b9661744b1d0d03a1aa7679ae24a extends Twig_Template
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
        echo "        </nav>
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

          \t";
        // line 29
        $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "setAttribute", array(0 => "action", 1 => $this->env->getExtension("zfc-twig")->getRenderer()->plugin("url")->__invoke(null, array(), true)), "method");
        // line 30
        echo "            ";
        $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "prepare", array(), "method");
        // line 31
        echo "\t\t\t";
        echo $this->getAttribute($this->env->getExtension("zfc-twig")->getRenderer()->plugin("form")->__invoke(), "openTag", array(0 => (isset($context["form"]) ? $context["form"] : null)), "method");
        echo "
\t\t\t";
        // line 32
        echo $this->env->getExtension("zfc-twig")->getRenderer()->plugin("formCollection")->__invoke((isset($context["form"]) ? $context["form"] : null));
        echo "
\t\t\t";
        // line 33
        echo $this->getAttribute($this->env->getExtension("zfc-twig")->getRenderer()->plugin("form")->__invoke(), "closeTag", array(), "method");
        echo "

        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "garden/feature/edit";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 33,  62 => 32,  57 => 31,  54 => 30,  52 => 29,  37 => 16,  35 => 15,  19 => 1,);
    }
}
