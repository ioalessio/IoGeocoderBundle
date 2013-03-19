work in progress
==============


INSTALL:
1) add require in your composer.json file
```js
"require": {
        "ioalessio/geocoderbundle": "dev-master",
}
```
2) add bundle in app/AppKernel.php
```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
            $bundles = array(
                new Io\GeocoderBundle\IoGeocoderBundle(),
            );
    }
}
```
3) add widget template inside your form template 
```twig 
{% extends 'MopaBootstrapBundle:Form:fields.html.twig' %}
{% from 'MopaBootstrapBundle::flash.html.twig' import flash %}

{% block geocoder_widget %}
{% include "IoGeocoderBundle:Form:geocoder.html.twig" %}
{% endblock geocoder_widget %}
```

4) add javascript file in your template
```twig
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key={{ maps_api_key }}&sensor=true&language={{ app.request.locale }}"></script>

{% javascripts
'@IoGeocoderBundle/Resources/public/js/geocoder.js' 
output='js/script.js'
%}
<script type="text/javascript" src="{{ asset_url }}"></script>
{% endjavascripts %}
```


HOW TO USE:
 ========================

1) implement GeocoderInterface on your entity
```php

use Io\GeocoderBundle\Model\GeocoderModel;
use Io\GeocoderBundle\Interfaces\GeocoderInterface;

class MyClass implements GeocoderInterface {

protected $suggest;

protected $latitude;

protected $longitude;

protected $address;

protected $geocoder;

public function __construct() {
    $this->geocoder = new GeocoderModel($this);
}
//getter and setters
}
```
2) Create form inside your controller
```php
$entity = new MyClass();
$form = $this->createFormBuilder($task, $entity)
    ->add('geocoder', 'geocoder')
    ->getForm();
```



CUSTOMIZE:
if you want override native functions you can extend it creating a new bundle

```php
<?php

namespace My\GeocoderBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MyGeocoderBundle extends Bundle
{
    public function getParent()
    {
        return 'IoGeocoderBundle';
    }
}
```
