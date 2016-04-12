<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\VatRate;
use AppBundle\Form\VatRateType;

/**
 * VatRate controller.
 *
 */
class VatRateController extends Controller
{
    /**
     * Lists all VatRate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vatRates = $em->getRepository('AppBundle:VatRate')->findAll();

        return $this->render('vatrate/index.html.twig', array(
            'vatRates' => $vatRates,
        ));
    }

    /**
     * Creates a new VatRate entity.
     *
     */
    public function newAction(Request $request)
    {
        $vatRate = new VatRate();
        $form = $this->createForm('AppBundle\Form\VatRateType', $vatRate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vatRate);
            $em->flush();

            return $this->redirectToRoute('vatrate_show', array('id' => $vatRate->getId()));
        }

        return $this->render('vatrate/new.html.twig', array(
            'vatRate' => $vatRate,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VatRate entity.
     *
     */
    public function showAction(VatRate $vatRate)
    {
        $deleteForm = $this->createDeleteForm($vatRate);

        return $this->render('vatrate/show.html.twig', array(
            'vatRate' => $vatRate,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VatRate entity.
     *
     */
    public function editAction(Request $request, VatRate $vatRate)
    {
        $deleteForm = $this->createDeleteForm($vatRate);
        $editForm = $this->createForm('AppBundle\Form\VatRateType', $vatRate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vatRate);
            $em->flush();

            return $this->redirectToRoute('vatrate_edit', array('id' => $vatRate->getId()));
        }

        return $this->render('vatrate/edit.html.twig', array(
            'vatRate' => $vatRate,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VatRate entity.
     *
     */
    public function deleteAction(Request $request, VatRate $vatRate)
    {
        $form = $this->createDeleteForm($vatRate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vatRate);
            $em->flush();
        }

        return $this->redirectToRoute('vatrate_index');
    }

    /**
     * Creates a form to delete a VatRate entity.
     *
     * @param VatRate $vatRate The VatRate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VatRate $vatRate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vatrate_delete', array('id' => $vatRate->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
