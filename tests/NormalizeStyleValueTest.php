<?php

namespace TrzMaxim\TwigInlineStyles\Tests;

use TrzMaxim\TwigInlineStyles\NormalizeStyleValue;

class NormalizeStyleValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @beforeClass
     */
    public function before()
    {
        NormalizeStyleValue::prefixedUnitlessNumber();
    }

    /**
     * @dataProvider prefixedStyleNameProvider
     */
    public function testPrefixedUnitlessNumber($prefixedStyleName)
    {
        $this->assertTrue(NormalizeStyleValue::isUnitlessNumber($prefixedStyleName));
    }

    public function prefixedStyleNameProvider()
    {
        return array(
            array('WebkitAnimationIterationCount'),
            array('MozFlex'),
            array('MsLineHeight'),
            array('OStopOpacity')
        );
    }

    /**
     * @dataProvider normalizedStyleNameProvider
     */
    public function testNormalize($styleName, $value, $expected)
    {
        $this->assertEquals($expected, NormalizeStyleValue::normalize($styleName, $value));
    }

    public function normalizedStyleNameProvider()
    {
        return array(
            array('fontStyle', 12, '12px'),
            array('color', 'red', 'red'),
            array('lineHeight', 1.4, 1.4),
            array('MsFlex', 1, 1),
            array('WebkitBorderRadius', 10, '10px'),
        );
    }
}
