<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nume')
            ->add('manufacturer')
            ->add('ean')
            ->add('reference')
            ->add('salePrice')
            //->add('datCre', 'datetime')
            //->add('datUpd', 'datetime')
            ->add('unitMeasure')
            ->add('categories')
            //->add('images')
            ->add('features', CollectionType::class, array(
                    'entry_type' => FeatureType::class,
                    'allow_add'    => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                ))

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }
}
