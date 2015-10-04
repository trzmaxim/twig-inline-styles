# twig-inline-styles
Twig extension for create and output inline styles

Installation
------------

Through [Composer](http://getcomposer.org)

```{.sh}
composer require "trzmaxim/twig-inline-styles": "dev-master"
```

```php
use TrzMaxim\TwigInlineStyles\InlineStylesExtension;

$twig = new Twig_Environment(...);

$twig->addExtension(new InlineStylesExtension());
```

Usage
-----

Styles are presented in the form of a hash. Style keys are camelCase, vendor prefix must begin with a capital letter (`WebkitTransition`). The value is a string or a number to the number of automatically adds the line "points", but there are exceptions ([see](https://facebook.github.io/react/tips/style-props-value-px.html))

```twig
{% style foo {
  fontSize: 12,
  color: 'red'
} %}

<p style="{{ foo }}"></p>
```

Styles can be merged by `.merge`

```twig
{% style foo {
  fontSize: 12,
  color: 'red'
} %}

{% style bar {
  color: 'green',
  padding: '10px 0',
} %}

{{ foo.merge(bar) }} {# font-size:12px;color:green;padding:10px 0; #}
```
