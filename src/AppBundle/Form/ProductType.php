<?php


namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('nume', TextType::class, array(
                'translation_domain'=>'AppBundle',
            ))
            ->add('manufacturer', TextType::class, array(
                'translation_domain'=>'AppBundle',
            ))
            ->add('ean', TextType::class, array(
                'translation_domain'=>'AppBundle',
            ))
            ->add('reference', TextType::class, array(
                'translation_domain'=>'AppBundle',
            ))
            ->add('salePrice', TextType::class, array(
                'translation_domain'=>'AppBundle',
            ))
            ->add('unitMeasure', EntityType::class, array(
                'class'        => 'AppBundle\Entity\UnitMeasure',
                'query_builder'=> function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'multiple'     =>false,
                'expanded'     =>false,
                'placeholder'  =>'Choose Unit measure',
                'translation_domain'=>'AppBundle',
                'choice_translation_domain'=>'AppBundle',
            ))
            ->add('categories', EntityType::class, array(
                'class'         => 'AppBundle:Category',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'multiple'       => true,
                'expanded'       => false,
                'translation_domain'=>'AppBundle',
            ))
            ->add('features', CollectionType::class, array(
                    'entry_type'   => FeatureType::class,
                    'label'        => false,
                    'allow_add'    => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'translation_domain'=>'AppBundle',
                ))
            ->add('images', CollectionType::class, array(
                    'entry_type'   => ProductImageType::class,
                    'allow_add'    => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'label'        => false,
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
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }
}
