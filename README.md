Bolt Browser Info
======================

This parses the borwser version and type and makes it available in twig.

## Usage

### In a twig template

```
{% set browser = getbrowser() %}

<p>{{ browser.ua.family|default("Unknown") }} - {{ browser.ua.major|default(0) }}.{{ browser.ua.minor|default(0) }}</p>
<p>{{ browser.os.family|default("Unknown") }}</p>
{{ dump(browser)}}

```

### As a template

Use `{{ browserinfo() }}` in your template to render the `info.twig` template. You can probably override that template.

### As a page

Go to http://yoursite.example/browser and see it in action


