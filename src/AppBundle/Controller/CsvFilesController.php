<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\CsvFiles;
use AppBundle\Form\CsvFilesType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

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
        $form->add('submit', SubmitType::class, array(
            'label'=>'Create',
            'attr'=>array(
                'class'=>'btn btn-primary'
            ),
            'translation_domain'=>'AppBundle',
        ));
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
     * @Template()
     */
    public function editAction(Request $request, CsvFiles $csvFile)
    {



        $deleteForm = $this->createDeleteForm($csvFile);
        $editForm = $this->createForm('AppBundle\Form\CsvFilesType', $csvFile);
        $editForm->add('submit', SubmitType::class, array(
            'label'=>'Edit',
            'attr'=>array(
                'class'=>'btn btn-success',
            ),
            'translation_domain'=>'AppBundle',
        ));

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $csvFile->upload();
            $em->persist($csvFile);
            $em->flush();

            return $this->redirectToRoute('csvfiles_show', array('id' => $csvFile->getId()));
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
            ->add('submit', SubmitType::class, array(
                'label'=>'Delete',
                'attr'=>array(
                    'class'=>'btn btn-danger',
                ),
                'translation_domain'=>'AppBundle',
            ))
            ->getForm()
        ;
    }
}
