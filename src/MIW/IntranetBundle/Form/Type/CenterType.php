<?php

namespace MIW\IntranetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CenterType extends AbstractType
{
    public function __construct()
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
            ->add('name', 'text', array(
                'label' => 'Instalación',
                'attr' => array('class' => 'name')))
          ->add('address', new AddressType(),array('data_class'=>'MIW\DataAccessBundle\Document\Address'));
                 
            
           
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'MIW\DataAccessBundle\Document\Center',
        );
    }

    public function getName()
    {
        return 'center_type';
    }
    
}