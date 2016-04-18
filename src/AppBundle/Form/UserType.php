<?php

namespace AppBundle\Form;


use FOS\UserBundle\DependencyInjection\FOSUserExtension;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('username')
                ->add('roles', ChoiceType::class, array(
                    'choices'=>array(
                        'ROLE_ADMIN'=>'ROLE_ADMIN',
                        'ROLE_USER'=>'ROLE_USER',
                        'ROLE_SUPER_ADMIN'=>'ROLE_SUPER_ADMIN'
                    ),
                    'multiple'=>true,
                    'translation_domain' => 'FOSUserBundle'
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'app_bundle_user_type';
    }
}
