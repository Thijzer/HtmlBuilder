# HtmlBuilder

### Goals
This Repo is meant to making dynamic html elements easier.
Most of the known component should be available as a set.

Making it possible to build menu, datagrid, table component as objects in PHP. 
And pass them as to you template engine.

# Example

```php
$table = new \Html\Table();
$table->setData($dataSet);
$table
    ->add('#', 'rowcount')
    ->add('title')
    ->add('status_code')
    ->add('h1_count')
    ->add('frequency')
    ->add('links_text', 'arrayCount')
    ->add('visited', 'boolean')
    ->add('absolute_url', 'link')
;
```


```php
$table->render()
```


