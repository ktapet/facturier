<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\FeatureName;
use AppBundle\Form\FeatureNameType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * FeatureName controller.
 *
 */
class FeatureNameController extends Controller
{
    /**
     * Lists all FeatureName entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $featureNames = $em->getRepository('AppBundle:FeatureName')->findAll();

        return $this->render('featurename/index.html.twig', array(
            'featureNames' => $featureNames,
        ));
    }

    /**
     * Creates a new FeatureName entity.
     *
     */
    public function newAction(Request $request)
    {
        $featureName = new FeatureName();
        $form = $this->createForm('AppBundle\Form\FeatureNameType', $featureName);
        /*
         * @ktapet
         * exemplu adaugare camp pe care sa nu-l ia in 
         * in considerare sitemul de mapping
         */
        $form->add('agree', CheckboxType::class, array(
            'required' => false,
            'mapped' => false,
        ));
        $form->add('submit', SubmitType::class, array(
            'label'=>'Create',
            'attr'=>array(
                'class'=>'btn btn-primary'
            )
        ));

        /*
         * @ktapet
         * adaugam aici butonul de sumit
         * vezi mai multe aici: http://symfony.com/doc/current/reference/forms/types/submit.html
         */

        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($featureName);
            $em->flush();

            return $this->redirectToRoute('featurename_show', array('id' => $featureName->getId()));
        }

        return $this->render('featurename/new.html.twig', array(
            'featureName' => $featureName,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FeatureName entity.
     *
     */
    public function showAction(FeatureName $featureName)
    {
        $deleteForm = $this->createDeleteForm($featureName);

        return $this->render('featurename/show.html.twig', array(
            'featureName' => $featureName,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FeatureName entity.
     *
     */
    public function editAction(Request $request, FeatureName $featureName)
    {
        $deleteForm = $this->createDeleteForm($featureName);
        $editForm = $this->createForm('AppBundle\Form\FeatureNameType', $featureName);
        /*
         * @ktapet
         * adaugam aici butonul de sumit
         * vezi mai multe aici: http://symfony.com/doc/current/reference/forms/types/submit.html
         */
        $editForm->add('submit', SubmitType::class, array(
            'label'=>'Save',
            'attr'=>array(
                'class'=>'btn btn-success',
            )
        ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($featureName);
            $em->flush();

            return $this->redirectToRoute('featurename_show', array('id' => $featureName->getId()));
        }

        return $this->render('featurename/edit.html.twig', array(
            'featureName' => $featureName,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a FeatureName entity.
     *
     */
    public function deleteAction(Request $request, FeatureName $featureName)
    {
        $form = $this->createDeleteForm($featureName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($featureName);
            $em->flush();
        }

        return $this->redirectToRoute('featurename_index');
    }

    /**
     * Creates a form to delete a FeatureName entity.
     *
     * @param FeatureName $featureName The FeatureName entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FeatureName $featureName)
    {
        /*
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('featurename_delete', array('id' => $featureName->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
        */
        /*
         * @ktapet
         * codul autogenerat este comentat mai sus
         * vezi mai multe aici: http://symfony.com/doc/current/reference/forms/types/submit.html
         */
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('featurename_delete', array('id' => $featureName->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array(
                'label'=>'Delete',
                'attr'=>array(
                    'class'=>'btn btn-danger'
                )
            ))
            ->getForm()
        ;        
    }
}
