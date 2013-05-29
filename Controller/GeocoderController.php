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
        
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false&language='.$locale;
        return $this->redirect($url);

    }
    
}
