<?php

namespace Io\GeocoderBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Io\GeocoderBundle\Interfaces\GeocoderInterface;


/**
 * Form Type read this Model
 * This model must be initialized with Entity 
 * Entity MUST implements GeocoderInterface
 */
class GeocoderModel {
    
    /**
     * @Assert\Type(type="string")
     * @Assert\NotBlank(message="geocoder.address.required")
     */
    protected $address;
    
    /**
     * @Assert\Type(type="float")
     * @Assert\NotBlank(message="geocoder.latitude.required")
     */
    protected $latitude;
    
    /**
     * @Assert\Type(type="float")
     * @Assert\NotBlank(message="geocoder.longitude.required")
     */
    protected $longitude;
    
    /**
     * @Assert\Type(type="string")
     */
    protected $suggest;
    
   
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
    
    
}