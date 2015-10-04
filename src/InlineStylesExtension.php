<?php

namespace TrzMaxim\TwigInlineStyles;

class InlineStylesExtension extends \Twig_Extension
{
    /**
     * @inheritdoc
     */
    public function getTokenParsers()
    {
        return array(new StyleTokenParser());
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'inline-styles';
    }
}
