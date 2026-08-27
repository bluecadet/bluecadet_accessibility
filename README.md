# Bluecadet Accessibility

Adds Drupal utilities to aid in site accessibility, including a Views Display Extender that enhances AJAX-updated Views for screen reader users.

## Requirements

- Drupal 9.5+ or Drupal 10.0+
- PHP 8.0 or higher

## Versions

### 1.x Branch

- **1.x**: Drupal 9 and 10 support (PHP 8.0+)

## Includes

- A Views Display Extender option, for use when a View is using AJAX, that improves accessibility for screen reader users (announces updates, focus handling, etc.)

## Usage

### Assumptions about view templates

- Maintain "views" class names, but can add pre-defined or custom class names.
- Assume basic top level template (`views-view.html.twig`) structure.
- Results should be in an unordered list (the list part is the important part). Unordered lists help screen reader users navigate from the first item in a list to the end of the list or jump to the next list. It can also help them bypass groups of links if they choose to. ([W3C, H48: Using ol, ul and dl for lists or groups of links](https://www.w3.org/TR/WCAG20-TECHS/H48.html#:~:text=The%20list%20structure%20(%20ul%20%2F%20ol,links%20if%20they%20choose%20to.))
- There should be a title (can be screen reader only) `<h2 class="u-sr-only view-content__header" tabIndex="0">Results</h2>`, default is before the `ul` and a child of `view-content`.
- Need a header, which is usually an `h2`, before filters and before results, ideally `<h2 class="u-sr-only view-filters__header">Filter Results</h2>` and `<h2 class="u-sr-only view-content__header">Results</h2>`, visually hidden.
- Buttons and pagers can set a `data-announce-text` attribute which will be announced rather than a generic string.

### Adding custom announce text to templates

#### Form elements

```php
<button type="submit" data-announce-text="Searching the site" class="c-search-header__search-submit"{{ attributes }}>
	Search
</button>

OR

<button type="submit" data-announce-text="Filter the results" class="c-search-header__search-submit"{{ attributes }}>
	Filter
</button>
```

#### Pager elements

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

### Optional CSS for smooth scrolling

```css
html {
  scroll-behavior: smooth;
}
```

## Not using Composer

If you are not using composer, you can delete all unneeded files.

- composer.json

## Using Composer

If you are using composer to manage Drupal modules, make sure you add custom
location for this module to be downloaded to. You must add the installer types
line as well as the location for the module.

```json
  ...
  "installer-types": ["custom-drupal-module"],
  "installer-paths": {
    "web/core": ["type:drupal-core"],
    "web/modules/contrib/{$name}": ["type:drupal-module"],
    "web/modules/custom/{$name}": ["type:custom-drupal-module"],
    "web/profiles/contrib/{$name}": ["type:drupal-profile"],
    "web/themes/contrib/{$name}": ["type:drupal-theme"],
    "drush/contrib/{$name}": ["type:drupal-drush"]
  },
  ...
```

## Testing

This module includes automated tests that run via GitHub Actions against Drupal 9.5.x-10.2.x (see `.github/workflows/drupal-tests-and-standards.yml` for the exact PHP/MariaDB matrix).

### Test Plan

#### Automated Tests (GitHub Actions)

The CI pipeline runs the following for each Drupal version:

1. **PHPCS** - Drupal coding standards validation
2. **Drupal-Check** - static analysis for deprecated code and API usage
3. **PHPUnit** - automated tests

#### Current coverage

A single functional test (`tests/src/Functional/BluecadeAccessibilityTest.php`) covers the module.

## Changelog

### 1.x

- Adds Drupal Views Display Extender for enhanced accessibility.

<br>
<br>
<br>

## Proudly developed @ Bluecadet

<p style="background-color: white; padding: 20px">
  <a href="https://www.bluecadet.com/"><img style="max-width: 50%; min-width: 300px; background: white; padding: 20px;" src="https://www.bluecadet.com/wp-content/themes/bluecadet-2018/images/logo/logo-bluecadet-black.svg" alt="Bluecadet"></a>
</p>
