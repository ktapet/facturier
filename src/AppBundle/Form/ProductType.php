<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

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
            ->add('unitMeasure', EntityType::class, array(
                'class'=> 'AppBundle\Entity\UnitMeasure',
                'query_builder'=> function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'multiple'=>false,
                'expanded'=>false,
                'placeholder'=>'Select Unit measure'


            ))
            ->add('categories', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'multiple' => true,
                'expanded' => false,
            ))
            ->add('features', CollectionType::class, array(
                    'entry_type' => FeatureType::class,
                    'label' => false,
                    'allow_add'    => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                ))
            ->add('images', CollectionType::class, array(
                    'entry_type' => ProductImageType::class,
                    'allow_add'    => true,
                    'label' => false,
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
