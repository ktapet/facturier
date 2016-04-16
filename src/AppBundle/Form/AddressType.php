<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('alias', TextType::class, array(
                'translation_domain'=>'AppBundle'
            ))
            ->add('street', TextType::class, array(
                'translation_domain'=>'AppBundle'
            ))
            ->add('no', TextType::class, array(
                'translation_domain'=>'AppBundle'
            ))
            ->add('city', TextType::class, array(
                'translation_domain'=>'AppBundle'
            ))
            ->add('country', CountryType::class, array(
                 'translation_domain'=>'AppBundle'
                ))
            ->add('email', TextType::class, array(
                'translation_domain'=>'AppBundle'
            ))
            ->add('phone', TextType::class, array(
                'translation_domain'=>'AppBundle'
            ))
           // ->add('datCre', 'datetime')
           // ->add('datUpd', 'datetime')
            ->add('partner', EntityType::class, array(
                'class' => 'AppBundle:Partner',
                'placeholder' => 'Choose a partner',
                'translation_domain'=>'AppBundle',
                'choice_translation_domain'=>'AppBundle',
            ));
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Address',
        ));
    }
}
