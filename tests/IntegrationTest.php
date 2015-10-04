<?php

namespace TrzMaxim\TwigInlineStyles\Tests;

use TrzMaxim\TwigInlineStyles\InlineStylesExtension;

class IntegrationTest extends \Twig_Test_IntegrationTestCase
{
    public function getExtensions()
    {
        return array(
            new InlineStylesExtension()
        );
    }

    public function getFixturesDir()
    {
        return __DIR__ . '/Fixtures/';
    }
}
