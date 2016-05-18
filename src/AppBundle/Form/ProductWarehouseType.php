<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductWarehouseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', NumberType::class, array(
                'translation_domain'=>'AppBundle',
                'scale'=>0,
                'attr'=>array(
                    'min'=>1
                )
                ))
            //->add('datCre', 'datetime')
            //->add('datUpd', 'datetime')
            ->add('product', EntityType::class,array(
                'class'=>'AppBundle\Entity\Product',
                'placeholder'=>'Choose a product',
                'translation_domain'=>'AppBundle'
                ))
            ->add('warehouse', EntityType::class, array(
                'class'=>'AppBundle\Entity\Warehouse',
                'placeholder'=>'Choose a warehouse',
                'translation_domain'=>'AppBundle',
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ProductWarehouse'
        ));
    }
}
