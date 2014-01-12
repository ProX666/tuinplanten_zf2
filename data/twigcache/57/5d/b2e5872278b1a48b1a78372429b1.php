<?php

/* garden/template/display_nav.twig */
class __TwigTemplate_575db2e5872278b1a48b1a78372429b1 extends Twig_Template
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
        echo "<ul>
    <li><a href=\"";
        // line 2
        echo $this->env->getExtension("zfc-twig")->getRenderer()->plugin("url")->__invoke("garden", array("controller" => "plant", "action" => "create"), array(), 1);
        echo "\">Nieuwe Tuinplant</a></li>
    <li><a href=\"#\">Nieuwe Plant in Flora</a></li>
    <li><a href=\"";
        // line 4
        echo $this->env->getExtension("zfc-twig")->getRenderer()->plugin("url")->__invoke("garden", array("controller" => "feature", "action" => "index"), array(), 1);
        echo "\">Kenmerken</a></li>
    <li><a href=\"";
        // line 5
        echo $this->env->getExtension("zfc-twig")->getRenderer()->plugin("url")->__invoke("garden", array("controller" => "feature", "action" => "create"), array(), 1);
        echo "\">Nieuwe Kenmerk</a></li>
    <li><a href=\"";
        // line 6
        echo $this->env->getExtension("zfc-twig")->getRenderer()->plugin("url")->__invoke("garden", array("controller" => "habitat", "action" => "index"), array(), 1);
        echo "\">Groeiplaats</a></li>
    <li><a href=\"";
        // line 7
        echo $this->env->getExtension("zfc-twig")->getRenderer()->plugin("url")->__invoke("garden", array("controller" => "habitat", "action" => "create"), array(), 1);
        echo "\">Nieuwe Groeiplaats</a></li>
</ul>";
    }

    public function getTemplateName()
    {
        return "garden/template/display_nav.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  35 => 6,  31 => 5,  27 => 4,  22 => 2,  19 => 1,);
    }
}
