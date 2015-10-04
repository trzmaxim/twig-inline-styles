<?php

namespace TrzMaxim\TwigInlineStyles;

/**
 * Based on https://github.com/facebook/react/blob/
 * c512603a8c9ce70eef3499c0174a4c8b3b9ea216/
 * src/renderers/dom/shared/dangerousStyleValue.js
 */
class NormalizeStyleValue
{
    /**
     * @var array CSS properties which accept numbers but are not in units of "px".
     */
    private static $unitlessNumber = array(
        'animationIterationCount',
        'boxFlex',
        'boxFlexGroup',
        'boxOrdinalGroup',
        'columnCount',
        'flex',
        'flexGrow',
        'flexPositive',
        'flexShrink',
        'flexNegative',
        'flexOrder',
        'fontWeight',
        'lineClamp',
        'lineHeight',
        'opacity',
        'order',
        'orphans',
        'tabSize',
        'widows',
        'zIndex',
        'zoom',

        //SVG-related properties
        'fillOpacity',
        'stopOpacity',
        'strokeDashoffset',
        'strokeOpacity',
        'strokeWidth'
    );

    /**
     * @var bool
     */
    private static $isPrefixedUnitlessNumber = false;

    /**
     * @param string $styleName
     *
     * @return bool
     */
    public static function isUnitlessNumber($styleName)
    {
        if (!self::$isPrefixedUnitlessNumber) {
            self::prefixedUnitlessNumber();
        }

        return in_array($styleName, self::$unitlessNumber, true);
    }

    /**
     * Adds style name with vendor prefixes
     */
    public static function prefixedUnitlessNumber()
    {
        $prefixes = array('Webkit', 'Ms', 'Moz', 'O');

        foreach (self::$unitlessNumber as $name) {
            foreach ($prefixes as $prefix) {
                self::$unitlessNumber[] = $prefix . ucfirst($name);
            }
        }

        self::$isPrefixedUnitlessNumber = true;
    }

    public static function normalize($styleName, $value)
    {
        if (is_string($value)) {
            return trim($value);
        }

        if (is_int($value) || is_float($value)) {
            if (self::isUnitlessNumber($styleName)) {
                return $value;
            } else {
                return $value . 'px';
            }
        }

        return '';
    }
}
