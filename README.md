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
5) add geocode routing
```yaml
io_geocoder_bundle:
    resource: "@IoGeocoderBundle/Resources/config/routing.yml"
```
HOW TO USE:
 ========================

1) create your GeocoderInterface on your entity
```php
namespace My\Bundle\Entity;
use Io\GeocoderBundle\Interfaces\GeocoderInterface;

class Geo implements GeocoderInterface {

protected $suggest;
protected $latitude;
protected $longitude;
protected $address;
protected $geocoder;

protected $myfield;


//getter and setters
}
```

2) Create form class
```php
namespace My\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GeoType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('myfield', 'text');        
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'My\Bundle\Entity\Geo'
        ));
    }
    
    public function getParent() {
        return 'geocoder';
    }    

    public function getName() {
        return 'my_geo';
    }
}
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
