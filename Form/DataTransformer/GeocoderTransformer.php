<?php

namespace Io\GeocoderBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @deprecated non serve,
 *  uso il modello
 */
class GeocoderTransformer implements DataTransformerInterface
{
    
    protected $addressMethod;
    protected $latitudeMethod;
    protected $longitudeMethod;    
    protected $suggestMethod;
    
    protected $data;
    
    /**
     * 
     * @param string $addressMethod
     * @param string $latitudeMethod
     * @param string $longitudeMethod
     * @param string $suggestMethod
     */
    public function __construct($addressMethod, $latitudeMethod, $longitudeMethod, $suggestMethod)
    {
        $this->data = array('address' => '', 'latitude' => '', 'longitude' => '', 'suggest' => '');
        
        $this->addressMethod = $this->getMethod($addressMethod);
        $this->latitudeMethod = $this->getMethod($latitudeMethod);
        $this->longitudeMethod = $this->getMethod($longitudeMethod);
        $this->suggestMethod = $this->getMethod($suggestMethod);
        
    }

    /**
     * Transforms an object ($entity) to a string (id).
     *
     * @param  $entityName|null $entity
     * @return string
     */
    public function transform($entity)
    {
        if (null === $entity)
            return $this->data;

        $address = $this->addressMethod;
        $latitude = $this->latitudeMethod;
        $longitude = $this->longitudeMethod;
        $suggest = $this->suggestMethod;
        
        return array(
            'address'   => $entity->$address(),
            'latitude'  => $entity->$latitude(),
            'longitude' => $entity->$longitude(),
            'suggest'   => $entity->$suggest(),
        );
        
    }

    
    /**
     * Transforms a string (string) to an object ($entity).
     *
     * @param  string $number
     * @throws TransformationFailedException if object ($entity) is not found.
     */
    public function reverseTransform($string)
    {
        $value = $string['value'];
        if (!$value) {
            return null;
        }

        //i should manage this call by a parameter
        // example:
        // $this->getEm()->getRepository($entityName)->$method($value);        
        $entity = $this->getOm()->createQuery("SELECT e FROM ".$this->getEntityName()." e WHERE e.id = :id")
                ->setParameter('id', $value)
                ->getSingleResult();

        if (null === $entity) {
            throw new TransformationFailedException(sprintf(
                'Entity does not exists "%s"!',
                $string
            ));
        }

        return $entity;
    }
    
   
    /**
     * @param type $method
     * @return type
     */
    protected function getMethod($method) {
        return "get".ucfirst($method);
    }


}

?>