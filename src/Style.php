<?php

namespace TrzMaxim\TwigInlineStyles;

class Style implements \ArrayAccess
{
    /**
     * @var array
     */
    private $props = array();

    /**
     * @param array $props
     */
    public function __construct(array $props = array())
    {
        foreach ($props as $styleName => $value) {
            $this->offsetSet($styleName, $value);
        }
    }

    /**
     * Serializes a mapping of style properties for use as inline styles
     *
     * @return string
     */
    public function toString()
    {
        $serialized = '';
        foreach ($this->props as $styleName => $value) {
            if (!is_string($styleName) || $value === null) {
                continue;
            }

            $serialized .= HyphenateStyleName::hyphenate($styleName) . ':';
            $serialized .= NormalizeStyleValue::normalize($styleName, $value) . ';';
        }

        return $serialized;
    }

    /**
     * @param Style $style
     *
     * @return $this
     */
    public function merge(Style $style)
    {
        $this->props = array_merge($this->props, $style->getProps());

        return $this;
    }

    /**
     * @return array
     */
    public function getProps()
    {
        return $this->props;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function offsetExists($styleName)
    {
        return array_key_exists($styleName, $this->props);
    }

    public function offsetGet($styleName)
    {
        if (array_key_exists($styleName, $this->props)) {
            return $this->props[$styleName];
        }

        return null;
    }

    public function offsetSet($styleName, $value)
    {
        $this->props[$styleName] = $value;
    }

    public function offsetUnset($styleName)
    {
        unset($this->props[$styleName]);
    }
}
