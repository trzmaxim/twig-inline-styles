<?php

namespace TrzMaxim\TwigInlineStyles\Tests;

use TrzMaxim\TwigInlineStyles\StyleNode;

class StyleNodeTest extends \Twig_Test_NodeTestCase
{
    public function testConstructor()
    {
        $name  = new \Twig_Node_Expression_AssignName('foo', 1);
        $props = new \Twig_Node_Expression_Array(array(
            new \Twig_Node_Expression_Constant('fontSize', 1),
            new \Twig_Node_Expression_Constant(12, 1),

            new \Twig_Node_Expression_Constant('color', 1),
            new \Twig_Node_Expression_Constant('red', 1)
        ), 1);
        $node  = new StyleNode($name, $props, 1);

        $this->assertEquals($name, $node->getNode('name'));
        $this->assertEquals($props, $node->getNode('props'));
    }

    public function getTests()
    {
        $name  = new \Twig_Node_Expression_AssignName('foo', 1);
        $props = new \Twig_Node_Expression_Array(array(
            new \Twig_Node_Expression_Constant('fontSize', 1),
            new \Twig_Node_Expression_Constant(12, 1),

            new \Twig_Node_Expression_Constant('color', 1),
            new \Twig_Node_Expression_Constant('red', 1)
        ), 1);
        $node  = new StyleNode($name, $props, 1);

        return array(
            array(
                $node,
                "// line 1\n" .
                '$context["foo"] = new \\TrzMaxim\\TwigInlineStyles\\Style(array("fontSize" => 12, "color" => "red"));'
            )
        );
    }
}
