<?php

namespace Io\GeocoderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\Response;


class GeocoderController extends Controller
{
    /**
     * @todo Adding cache information
     * @param type $address
     */
    public function indexAction()
    {        
        $request = $this->getRequest();
        $locale = $request->getLocale();        
        $address = $request->query->get('address');
        
        $remote_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&sensor=false&hl=".$locale;
        
        
        $response = $this->curl($remote_url);
        $response->setPublic();
        $response->setExpires(new \DateTime('tomorrow'));
        return $response;

    }
    
    /**
     * @param string $url
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function curl($url) {

        $clean_url = str_replace (" ", "+", $url);
        $http = curl_init();
        curl_setopt($http, CURLOPT_URL, $clean_url);
        curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($http);
        $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
        $contentType = curl_getinfo($http, CURLINFO_CONTENT_TYPE);
        curl_close($http);        
        
        $response = new Response($data, $http_status, array('Content-Type' => $contentType) );
        return $response;
    }
     
}
