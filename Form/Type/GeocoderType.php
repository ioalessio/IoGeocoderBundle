<?php 

namespace Io\GeocoderBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\RouterInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class GeocoderType extends AbstractType
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */    
    private $router;
    

    /**
     * @param ObjectManager $om
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
        
    }    
    
    public function buildView(FormView $view, FormInterface $form, array $options) {
        parent::buildView($view, $form, $options);   
        
        if($options['local_route']) {
            $url = $this->router->generate($options['local_route']);         
        }
        else {
            $url = $options['url'];
        }
        $view->vars['url'] = $url;   
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('address', 'text')
                ->add('latitude', 'number', array('precision' => 13))
                ->add('longitude', 'number', array('precision' => 13))
                ->add('suggest', 'text', array('required' => false )) 
                 ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('local_route', 'url'));
        $resolver->setDefaults(array(
            'local_route'  => 'io_geocoder_action',
            'url' => "http://maps.googleapis.com/maps/api/geocode/json",
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
