<?php

namespace Io\GeocoderBundle\Interfaces;

interface GeocoderInterface {
    
    
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
