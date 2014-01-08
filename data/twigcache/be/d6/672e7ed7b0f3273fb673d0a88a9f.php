<?php

/* layout/layout */
class __TwigTemplate_bed6672e7ed7b0f3273fb673d0a88a9f extends Twig_Template
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
        echo "
<html lang=\"en\">
    <head>
        <meta charset=\"utf-8\">

    </head>
    <body>
        <nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
            <div class=\"container\">
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                    </button>
                    <a class=\"navbar-brand\" href=\"<?php echo \$this->url('home') ?>\"><img src=\"<?php echo \$this->basePath('img/zf2-logo.png') ?>\" alt=\"Zend Framework 2\"/>&nbsp;<?php echo \$this->translate('Skeleton Application') ?></a>
                </div>
                <div class=\"collapse navbar-collapse\">
                    <ul class=\"nav navbar-nav\">
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class=\"container\">
            <hr>
            <footer>
            </footer>
        </div> <!-- /container -->
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "layout/layout";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
