<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\UnitMeasure;
use AppBundle\Form\UnitMeasureType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * UnitMeasure controller.
 *
 */
class UnitMeasureController extends Controller
{
    /**
     * Lists all UnitMeasure entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $unitMeasures = $em->getRepository('AppBundle:UnitMeasure')->findAll();

        return $this->render('unitmeasure/index.html.twig', array(
            'unitMeasures' => $unitMeasures,
        ));
    }

    /**
     * Creates a new UnitMeasure entity.
     *
     */
    public function newAction(Request $request)
    {
        $unitMeasure = new UnitMeasure();
        $form = $this->createForm('AppBundle\Form\UnitMeasureType', $unitMeasure);
        /* @facturier
         * adaug butonul de submit
         */
        $form->add('submit', SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unitMeasure);
            $em->flush();

            return $this->redirectToRoute('unitmeasure_show', array('id' => $unitMeasure->getId()));
        }

        return $this->render('unitmeasure/new.html.twig', array(
            'unitMeasure' => $unitMeasure,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UnitMeasure entity.
     *
     */
    public function showAction(UnitMeasure $unitMeasure)
    {
        $deleteForm = $this->createDeleteForm($unitMeasure);

        return $this->render('unitmeasure/show.html.twig', array(
            'unitMeasure' => $unitMeasure,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UnitMeasure entity.
     *
     */
    public function editAction(Request $request, UnitMeasure $unitMeasure)
    {
        $deleteForm = $this->createDeleteForm($unitMeasure);
        $editForm = $this->createForm('AppBundle\Form\UnitMeasureType', $unitMeasure);
        $editForm->add('submit', SubmitType::class);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unitMeasure);
            $em->flush();

            return $this->redirectToRoute('unitmeasure_show', array('id' => $unitMeasure->getId()));
        }

        return $this->render('unitmeasure/edit.html.twig', array(
            'unitMeasure' => $unitMeasure,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a UnitMeasure entity.
     *
     */
    public function deleteAction(Request $request, UnitMeasure $unitMeasure)
    {
        $form = $this->createDeleteForm($unitMeasure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unitMeasure);
            $em->flush();
        }

        return $this->redirectToRoute('unitmeasure_index');
    }

    /**
     * Creates a form to delete a UnitMeasure entity.
     *
     * @param UnitMeasure $unitMeasure The UnitMeasure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnitMeasure $unitMeasure)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitmeasure_delete', array('id' => $unitMeasure->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class)
            ->getForm()
        ;
    }
}
