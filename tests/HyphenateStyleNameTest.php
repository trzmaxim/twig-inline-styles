<?php

namespace TrzMaxim\TwigInlineStyles\Tests;

use TrzMaxim\TwigInlineStyles\HyphenateStyleName;

class HyphenateStyleNameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider hyphenateProvider
     */
    public function testHyphenate($styleName, $hyphenate)
    {
        $this->assertEquals($hyphenate, HyphenateStyleName::hyphenate($styleName));
    }

    /**
     * @dataProvider hyphenateProvider
     */
    public function testCache($styleName, $hyphenate)
    {
        $cache = \PHPUnit_Framework_Assert::readAttribute(
            '\\TrzMaxim\\TwigInlineStyles\\HyphenateStyleName',
            'cache'
        );

        $this->assertArrayHasKey($styleName, $cache);
        $this->assertEquals($hyphenate, $cache[$styleName]);
    }

    public function hyphenateProvider()
    {
        return array(
            array('fontSize', 'font-size'),
            array('WebkitBorderRadius', '-webkit-border-radius'),
            array('color', 'color'),
            array('lineHeight', 'line-height'),
            array('backgroundColor', 'background-color')
        );
    }
}
