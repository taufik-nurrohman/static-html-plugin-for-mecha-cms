Static HTML Plugin for Mecha CMS
================================

> Embed HTML document in content.

This plugin allows you to embed full HTML document in the post content. This plugin will check whether you have a `<html>` tag in the post content or not. If so, then the whole HTML document of your current post page will be replaced by the post content.

Make sure to uncheck/disable the HTML parser engine field in the post editor.

Some special _shortcodes_ are available to be used in the document:

 - `{{config.key}}` → is equal to `$config->key`
 - `{{speak.key}}` → is equal to `$speak->key`
 - `{{this.key}}` → is equal to `$config->{$config->page_type}->key`

Example:

~~~ .html
<!DOCTYPE html>
<html dir="{{config.language_direction}}">
  <head>
    <meta charset="{{config.charset}}">
    <link href="{{config.url}}/favicon.ico" rel="icon">
    <title>{{config.page_title}}</title>
  </head>
  <body>
    <h1>{{this.title}}</h1>
    <div>{{this.description}}</div>
  </body>
</html>
~~~