<?php

namespace Io\GeocoderBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Io\GeocoderBundle\Interfaces\GeocoderInterface;


class GeocoderModel implements GeocoderInterface {
    
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
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getLatitude() {
       return $this->latitude;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function getLongitude() {
       return $this->longitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    public function getSuggest() {
       return $this->suggest;
    }

    public function setSuggest($suggest) {
        $this->suggest = $suggest;
    }    
}
