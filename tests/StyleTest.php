<?php

namespace TrzMaxim\TwigInlineStyles\Tests;

use TrzMaxim\TwigInlineStyles\Style;

class StyleTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $props = array('fontSize' => 12, 'color' => 'red');
        $foo   = new Style($props);

        $this->assertEquals($props, $foo->getProps());
    }

    public function testToString()
    {
        $foo = new Style(array('fontSize' => 12, 'color' => 'red', 'WebkitBorderRadius' => 10));

        $this->assertEquals('font-size:12px;color:red;-webkit-border-radius:10px;', $foo->toString());
    }

    public function testMerge()
    {
        $fooProps = array('fontSize' => 12, 'WebkitBorderRadius' => 10);
        $foo      = new Style($fooProps);
        $barProps = array('fontSize' => 14, 'color' => 'green');
        $bar      = new Style($barProps);

        $merge = array_merge($fooProps, $barProps);
        $foo->merge($bar);

        $this->assertEquals($merge, $foo->getProps());
    }

    public function testGetProp()
    {
        $props = array('fontSize' => 12, 'color' => 'red');
        $foo = new Style($props);

        $this->assertEquals($props['fontSize'], $foo['fontSize']);
        $this->assertNull($foo['bar']);
    }

    public function testGetProps()
    {
        $props = array('fontSize' => 12, 'color' => 'red');
        $foo = new Style($props);

        $this->assertEquals($props, $foo->getProps());
    }

    public function testSetProp()
    {
        $props = array('fontSize' => 12, 'color' => 'red', 'WebkitBorderRadius' => 10);
        $foo = new Style($props);

        $props['WebkitBorderRadius'] = 12;
        $foo['WebkitBorderRadius'] = 12;
        $this->assertEquals($props, $foo->getProps());

        $props['bar'] = 'foo';
        $foo['bar'] = 'foo';
        $this->assertEquals($props, $foo->getProps());
    }
}
