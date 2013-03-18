<?php

namespace Io\GeocoderBundle\Model;

use Io\GeocoderBundle\Interfaces\GeocoderInterface;

/**
 * Form Type read this Model
 * This model must be initialized with Entity 
 * Entity MUST implements GeocoderInterface
 */
class GeocoderModel {
    
    //protected $address;
    //protected $latitude;
    //protected $longitude;
    //protected $suggest;
    protected $entity;
    
    public function __construct(GeocoderInterface $entity) {
        $this->entity = $entity;
    }
    
    public function getAddress() {
        return $this->getEntity()->getAddress();
    }

    public function setAddress($address) {
        $this->getEntity()->setAddress($address);
    }

    public function getLatitude() {
       return $this->getEntity()->getLatitude();
    }

    public function setLatitude($latitude) {
        $this->getEntity()->setLatitude($latitude);
    }

    public function getLongitude() {
       return $this->getEntity()->getLongitude();
    }

    public function setLongitude($longitude) {
        $this->getEntity()->setLongitude($longitude);
    }

    public function getSuggest() {
       return $this->getEntity()->getSuggest();
    }

    public function setSuggest($suggest) {
        $this->getEntity()->setSuggest($suggest);
    }
    
    public function getEntity() {
        return $this->entity;
    }

    public function setEntity($entity) {
        $this->entity = $entity;
    }




    
    
}