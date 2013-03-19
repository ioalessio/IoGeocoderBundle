<?php

namespace Io\GeocoderBundle\Model;

use Symfony\Component\Validator\Constraint as Assert;
use Io\GeocoderBundle\Interfaces\GeocoderInterface;

/**
 * Form Type read this Model
 * This model must be initialized with Entity 
 * Entity MUST implements GeocoderInterface
 */
class GeocoderModel {
    
    /**
     * @Assert\Type("type"=string")
     */
    protected $address;
    
    /**
     * @Assert\Type("type"=float")
     */
    protected $latitude;
    
    /**
     * @Assert\Type("type"=float")
     */
    protected $longitude;
    
    /**
     * @Assert\Type("type"=string")
     */
    protected $suggest;
    
    protected $entity;
    
    public function __construct(GeocoderInterface $entity) {
        $this->entity = $entity;
    }
    
    public function getAddress() {
        return $this->getEntity()->getAddress();
    }

    public function setAddress($address) {
        $this->address = $address;
        $this->getEntity()->setAddress($address);
    }

    public function getLatitude() {
       return $this->getEntity()->getLatitude();
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
        $this->getEntity()->setLatitude($latitude);
    }

    public function getLongitude() {
       return $this->getEntity()->getLongitude();
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
        $this->getEntity()->setLongitude($longitude);
    }

    public function getSuggest() {
       return $this->getEntity()->getSuggest();
    }

    public function setSuggest($suggest) {
        $this->suggest = $suggest;
        $this->getEntity()->setSuggest($suggest);
    }
    
    public function getEntity() {
        return $this->entity;
    }

    public function setEntity($entity) {
        $this->entity = $entity;
    }




    
    
}