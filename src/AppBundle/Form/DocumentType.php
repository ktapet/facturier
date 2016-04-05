<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
//use AppBundle\Form\DocumentLineType;

class DocumentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('docNumber')
            //->add('datCre', 'datetime')
            //->add('datUpd', 'datetime')
            ->add('partner')
            ->add('docType')
            ->add('paymentType')
            //->add('user')
            ->add('docStatus')
            ->add('documentLines', CollectionType::class, array(
            'entry_type' => DocumentLineType::class,
            'allow_add'    => true,
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
