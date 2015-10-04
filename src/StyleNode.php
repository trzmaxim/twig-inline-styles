<?php

namespace TrzMaxim\TwigInlineStyles;

use \Twig_Node_Expression_AssignName as AssignNameNode;
use \Twig_Node_Expression_Array as ArrayNode;

class StyleNode extends \Twig_Node
{
    /**
     * @param AssignNameNode $name
     * @param ArrayNode      $props
     * @param int            $lineno
     * @param null           $tag
     */
    public function __construct(AssignNameNode $name, ArrayNode $props, $lineno = 0, $tag = null)
    {
        parent::__construct(array('name' => $name, 'props' => $props), array(), $lineno, $tag);
    }

    /**
     * @inheritdoc
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->addIndentation()
            ->subcompile($this->getNode('name'))
            ->raw(' = new \\TrzMaxim\\TwigInlineStyles\\Style(')
            ->subcompile($this->getNode('props'))
            ->raw(");\n");
    }
}
