<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentLineType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', TextType::class, array(
                'translation_domain'=>'AppBundle',
            ))
            ->add('salePrice', TextType::class, array(
                'translation_domain'=>'AppBundle',
            ))
            //->add('datCre', 'datetime')
            //->add('datUpd', 'datetime')
            ->add('product', EntityType::class, array(
                'class'=>'AppBundle:Product',
                'translation_domain'=>'AppBundle',
                'placeholder'=>'Choose a product',
            ))
            //->add('document')
            ->add('vatRate', EntityType::class, array(
                'class'=>'AppBundle:VatRate',
                'translation_domain'=>'AppBundle',
                'placeholder'=>'Choose a VAT'
            ))
            ->add('total')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\DocumentLine'
        ));
    }
     
}
