<?php

namespace TrzMaxim\TwigInlineStyles;

/**
 * Based on https://github.com/rexxars/hyphenate-style-name
 */
class HyphenateStyleName
{
    /**
     * @var array
     */
    private static $cache = array();

    /**
     * @var string
     */
    private static $uppercasePattern = '/([A-Z])/';

    /**
     * @param string $styleName
     *
     * @return string
     */
    public static function hyphenate($styleName)
    {
        if (array_key_exists($styleName, self::$cache)) {
            return self::$cache[$styleName];
        }

        self::$cache[$styleName] = strtolower(preg_replace(self::$uppercasePattern, '-$1', $styleName));

        return self::$cache[$styleName];
    }
}
