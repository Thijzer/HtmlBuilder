# MininalMenuBundle
===================

This is a Minimal Html Element Collection Bundle.

This will eventually build the most common required generated items like 

- nav menu
- sub menu
- admin menu panels
- footer links
- tables
- datagrids
- pagination
- lists (like assets)
- breadcrumbs
- thumbnails

It's in anyone's best interest the these elements are reconized as components
and should not be managed in the controller or the template.

It can also process forms but prefurable without any business logic attached.

An example of forms is assets and other datagrid filters. 
These formTypes are not handled by your controller and don't need any

# Example

```php
$table = new \Html\Table();
$table->setData($dataArray);
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
Here is a careful example of how to setup a data table
In this example you simple instanciate the table and add every row corresponding to the column name inside the table.
The second parameter is optional and exposes the modifier you wish the value pass in.

Rendering the table is only done when the template engine requests to output the table

```php
$table->render()
```

