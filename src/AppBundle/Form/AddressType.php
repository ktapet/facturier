<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
=======
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
>>>>>>> bf4ca8984c468291ebb783d7b8f8da54eb41aead

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
<<<<<<< HEAD
           //->add('datCre', 'date')
           // ->add('datUpd', 'datetime')
            ->add('partner')
        ;

=======
           // ->add('datCre', 'datetime')
           // ->add('datUpd', 'datetime')
            ->add('partner')
        ;
>>>>>>> bf4ca8984c468291ebb783d7b8f8da54eb41aead
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
<<<<<<< HEAD
            'data_class' => 'AppBundle\Entity\Address',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'task_item',
=======
            'data_class' => 'AppBundle\Entity\Address'
>>>>>>> bf4ca8984c468291ebb783d7b8f8da54eb41aead
        ));
    }
}
