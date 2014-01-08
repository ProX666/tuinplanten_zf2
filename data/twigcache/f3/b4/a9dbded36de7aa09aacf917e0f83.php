<?php

/* garden/index/getdata */
class __TwigTemplate_f3b4a9dbded36de7aa09aacf917e0f83 extends Twig_Template
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
        echo "<div id=\"plant_overlay\" style=\"display:none\">
    <div id=\"btnDone\">close</div>
    <div id=\"plant_data\">

        <div class=\"related\">
            <h5>Kenmerken</h5>
                <table cellpadding = \"0\" cellspacing = \"0\">
                    ";
        // line 8
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["features"]) ? $context["features"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["feature"]) {
            // line 9
            echo "                        <tr>
                            <td>";
            // line 10
            echo twig_escape_filter($this->env, (isset($context["feature"]) ? $context["feature"] : null), "html", null, true);
            echo "</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['feature'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "                </table>
        </div>
        <div class=\"related\">
            <h5>Standplaats</h5>
                <table cellpadding = \"0\" cellspacing = \"0\">
                   ";
        // line 18
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["habitats"]) ? $context["habitats"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["habitat"]) {
            // line 19
            echo "                        <tr>
                             <td>";
            // line 20
            echo twig_escape_filter($this->env, (isset($context["habitat"]) ? $context["habitat"] : null), "html", null, true);
            echo "</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['habitat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "                </table>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "garden/index/getdata";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 23,  58 => 20,  55 => 19,  51 => 18,  44 => 13,  35 => 10,  32 => 9,  28 => 8,  19 => 1,);
    }
}
