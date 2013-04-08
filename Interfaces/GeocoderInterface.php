<?php

namespace Io\GeocoderBundle\Interfaces;
use  Io\GeocoderBundle\Model\GeocoderModel;

interface GeocoderInterface {
    
    public function getGeocoder(); 
    public function setGeocoder(GeocoderModel $geocoder = null); 
    
    public function getAddress();
    public function setAddress($address);

    public function getLatitude();
    public function setLatitude($latitude);

    public function getLongitude();
    public function setLongitude($longitude);

    public function getSuggest();
    public function setSuggest($suggest);
}

?>
