<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('alias')
            ->add('street')
            ->add('no')
            ->add('city')
            ->add('country')
            ->add('email')
            ->add('phone')
           // ->add('datCre', 'datetime')
           // ->add('datUpd', 'datetime')
            ->add('partner', EntityType::class, array(
                'class' => 'AppBundle:Partner',
                'placeholder' => 'Choose a partner',
            ));
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Address'
        ));
    }
}
