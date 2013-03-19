<?php 

namespace Io\GeocoderBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class GeocoderType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('address', 'text')
                ->add('latitude', 'hidden')
                ->add('longitude', 'hidden')
                ->add('suggest', 'text') 
                 ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Io\GeocoderBundle\Model\GeocoderModel',
            'invalid_message' => 'X does not exists'            
        ));
    }

    public function getParent()
    {
        return 'form';
    }

    public function getName()
    {
        return 'geocoder';
    }
    

}
