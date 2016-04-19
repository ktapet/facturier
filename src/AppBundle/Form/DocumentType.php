<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;






class DocumentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('docNumber', TextType::class, array(
                'translation_domain'=>'AppBundle'
            ))
            //->add('datCre', 'datetime')
            //->add('datUpd', 'datetime')
            ->add('partner', EntityType::class, array(
                'class'=>'AppBundle:Partner',
                'translation_domain'=>'AppBundle',
                'placeholder'=>'Choose a partner',
            ))
            ->add('docType', EntityType::class, array(
                'class'=>'AppBundle:DocType',
                'translation_domain'=>'AppBundle',
                'placeholder'=>'Choose a document type',
            ))
            ->add('paymentType', EntityType::class, array(
                'class'=>'AppBundle:PaymentType',
                'translation_domain'=>'AppBundle',
                'placeholder'=>'Choose a payment type',
            ))
            ->add('warehouse', EntityType::class, array(
                'class'=>'AppBundle:Warehouse',
                'mapped' => false,
                'translation_domain'=>'AppBundle',
                
            ))
            //->add('user')
            ->add('docStatus', EntityType::class, array(
                'class'=>'AppBundle:DocStatus',
                'translation_domain'=>'AppBundle',
                'placeholder'=>'Choose a document status',
            ))
            ->add('documentLines', CollectionType::class, array(
                'entry_type'   => DocumentLineType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'label'        => false,
                'by_reference' => false,
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
            'data_class' => 'AppBundle\Entity\Document'
        ));
    }
}
