CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Installation
 * Configuration
 * FAQ
 * Maintainers
 * Changelog


INTRODUCTION
------------

This module handles custom functionality for bluecadet_accessibility.
Current Functionality:

 * Add a option in Views when using AJAX for enhanced accessibility.


INSTALLATION
------------

 * Install as you would normally install a contributed Drupal module. Visit
   https://www.drupal.org/node/1897420 for further information.


CONFIGURATION
-------------

Configuration can be found on a view under the Display formatter.

## Assumptions about our view templates:

- Maintain “views” class names, but can add pre-defined or custom class names.
- Assume basic top level template (views-view.html.twig) structure.
- Results should be in an unordered list (the list part is the important part) . Unordered lists help screen reader users navigate from the first item in a list to the end of the list or jump to the next list. It can also help them bypass groups of links if they choose to. ([W3C, H48: Using ol, ul and dl for lists or groups of links](https://www.w3.org/TR/WCAG20-TECHS/H48.html#:~:text=The%20list%20structure%20(%20ul%20%2F%20ol,links%20if%20they%20choose%20to.))
- There should be a title (can be screen reader only) `<h2 class="u-sr-only view-content__header" tabIndex="0">Results</h2>` default is before ul and a child of “view-content”
- Need a header, which is usually an h2, before filters and before results ideally `<h2 class="u-sr-only view-filters__header">Filter Results</h2>` and `<h2 class="u-sr-only view-content__header">Results</h2>` is visually hidden.
- Buttons and pagers can set a `data-announce-text` attr which will be announced rather than a generic string.

## How to add custom announce text to templates (exposed forms, pager templates).

### Form elements

```php
<button type="submit" data-announce-text="Searching the site" class="c-search-header__search-submit"{{ attributes }}>
	Search
</button>

OR

<button type="submit" data-announce-text="Filter the results" class="c-search-header__search-submit"{{ attributes }}>
	Filter
</button>

```

### Pager elements

```php
...

{% for key, item in items.pages %}
  <li class="c-pagination__item{{ current == key ? ' is-active' : '' }}">
    <a href="{{ item.href }}" data-announce-text="Navigating to Page {{ key }}" {{ item.attributes|without('href', 'title') }} {{current == key ? 'aria-current="page"' : null}}>
      <span class="u-sr-only">Page&nbsp;</span>
      {{- key -}}
    </a>
  </li>
{% endfor %}

...
```

## Optional CSS for smooth scrolling

```CSS
html {
  scroll-behavior: smooth;
}
```

MAINTAINERS
-----------

Current maintainers:

 * Pete Inge (pingevt) - https://www.drupal.org/user/411339
 * Amy Frear - https://www.frear-projects.com/

This project has been sponsored by:

 * Bluecadet - https://www.bluecadet.com/


CHANGELOG
---------

# Unreleased

 -

# 1.x

- Adds Drupal Views Display Extender for enhanced accessibility.

<br>
<br>
<br>

## Proudly developed @ Bluecadet

<p style="background-color: white; padding: 20px">
  <a href="https://www.bluecadet.com/"><img style="max-width: 50%; min-width: 300px; background: white; padding: 20px;" src="https://www.bluecadet.com/wp-content/themes/bluecadet-2018/images/logo/logo-bluecadet-black.svg" alt="Bluecadet"></a>
</p>
