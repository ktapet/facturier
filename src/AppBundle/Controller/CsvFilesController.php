<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\CsvFiles;
use AppBundle\Form\CsvFilesType;

/**
 * CsvFiles controller.
 *
 */
class CsvFilesController extends Controller
{
    /**
     * Lists all CsvFiles entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $csvFiles = $em->getRepository('AppBundle:CsvFiles')->findAll();

        return $this->render('csvfiles/index.html.twig', array(
            'csvFiles' => $csvFiles,
        ));
    }

    /**
     * Creates a new CsvFiles entity.
     *
     */
    public function newAction(Request $request)
    {
        $csvFile = new CsvFiles();
        $form = $this->createForm('AppBundle\Form\CsvFilesType', $csvFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($csvFile);
            $em->flush();

            return $this->redirectToRoute('csvfiles_show', array('id' => $csvFile->getId()));
        }

        return $this->render('csvfiles/new.html.twig', array(
            'csvFile' => $csvFile,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CsvFiles entity.
     *
     */
    public function showAction(CsvFiles $csvFile)
    {
        $deleteForm = $this->createDeleteForm($csvFile);

        return $this->render('csvfiles/show.html.twig', array(
            'csvFile' => $csvFile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CsvFiles entity.
     *
     */
    public function editAction(Request $request, CsvFiles $csvFile)
    {
        $deleteForm = $this->createDeleteForm($csvFile);
        $editForm = $this->createForm('AppBundle\Form\CsvFilesType', $csvFile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($csvFile);
            $em->flush();

            return $this->redirectToRoute('csvfiles_edit', array('id' => $csvFile->getId()));
        }

        return $this->render('csvfiles/edit.html.twig', array(
            'csvFile' => $csvFile,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CsvFiles entity.
     *
     */
    public function deleteAction(Request $request, CsvFiles $csvFile)
    {
        $form = $this->createDeleteForm($csvFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($csvFile);
            $em->flush();
        }

        return $this->redirectToRoute('csvfiles_index');
    }

    /**
     * Creates a form to delete a CsvFiles entity.
     *
     * @param CsvFiles $csvFile The CsvFiles entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CsvFiles $csvFile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('csvfiles_delete', array('id' => $csvFile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
