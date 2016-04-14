<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CsvFilesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'translation_domain'=>'AppBundle',
            ))
            ->add('tip', TextType::class, array(
                'translation_domain'=>'AppBundle',
            ))
            ->add('file', FileType::class, array(
                'translation_domain'=>'AppBundle',
            ))
            ->add('isUsed', CheckboxType::class, array(
                'translation_domain'=>'AppBundle',
            ))
           // ->add('datCre', 'datetime')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CsvFiles'
        ));
    }
}
