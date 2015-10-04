<?php

namespace TrzMaxim\TwigInlineStyles;

class StyleTokenParser extends \Twig_TokenParser
{
    /**
     * @inheritdoc
     */
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        $expr   = $this->parser->getExpressionParser();

        // Get the name of style
        $nameToken = $stream->expect(\Twig_Token::NAME_TYPE, null, 'Style should be named');
        $nameNode  = new \Twig_Node_Expression_AssignName($nameToken->getValue(), $nameToken->getLine());

        // Get an array of properties
        $propsNode = $expr->parseHashExpression();

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new StyleNode($nameNode, $propsNode, $lineno, $this->getTag());
    }

    /**
     * @inheritdoc
     */
    public function getTag()
    {
        return 'style';
    }
}
