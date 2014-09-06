PhileCMS Table of Contents
===========================

A [PhileCMS](https://github.com/PhileCMS/Phile) plugin that automatically 
generates a table of contents based on a pages headers.

This is intended for *internal* use.

## 1. Installation

**Install via git**

Clone this repository from the ```phile``` directory into 
```plugins/gibbs/phileTableOfContents```. E.g:

```bash
git clone git@github.com:Gibbs/phileTableOfContents.git plugins/gibbs/phileTableOfContents
```

**Manual Install**

Download and extract the contents into: ```plugins/gibbs/phileTableOfContents```

## 2. Plugin Activation

Activate the plugin in your ```config.php``` file:

```php
$config['plugins']['gibbs\\philephileTableOfContents'] = array('active' => true);
```

## 3. Example Usage

~~~html
<ol id="tableofcontents">
	{% for entry in tableofcontents %}
		<li><a href="{{ current_page.url }}{{ entry.hash }}">{{ entry.title }}</a></li>
	{% endfor %}
</ol>
~~~