<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\DocumentLine;
use AppBundle\Form\DocumentLineType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * DocumentLine controller.
 *
 */
class DocumentLineController extends Controller
{
    /**
     * Lists all DocumentLine entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documentLines = $em->getRepository('AppBundle:DocumentLine')->findAll();

        return $this->render('documentline/index.html.twig', array(
            'documentLines' => $documentLines,
        ));
    }

    /**
     * Creates a new DocumentLine entity.
     *
     */
    public function newAction(Request $request)
    {
        $documentLine = new DocumentLine();
        $form = $this->createForm('AppBundle\Form\DocumentLineType', $documentLine);
        $form->add('submit', SubmitType::class, [
            'label'=>'Create',
            'attr'=>[
                'class'=>'btn btn-primary'
            ]
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($documentLine);
            $em->flush();

            return $this->redirectToRoute('documentline_show', array('id' => $documentLine->getId()));
        }

        return $this->render('documentline/new.html.twig', array(
            'documentLine' => $documentLine,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a DocumentLine entity.
     *
     */
    public function showAction(DocumentLine $documentLine)
    {
        $deleteForm = $this->createDeleteForm($documentLine);

        return $this->render('documentline/show.html.twig', array(
            'documentLine' => $documentLine,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing DocumentLine entity.
     *
     */
    public function editAction(Request $request, DocumentLine $documentLine)
    {
        $deleteForm = $this->createDeleteForm($documentLine);
        $editForm = $this->createForm('AppBundle\Form\DocumentLineType', $documentLine);
        $editForm->add('submit', SubmitType::class, [
            'label'=>'Save',
            'attr'=>[
                'class'=>'btn btn-success'
            ]
        ]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($documentLine);
            $em->flush();

            return $this->redirectToRoute('documentline_edit', array('id' => $documentLine->getId()));
        }

        return $this->render('documentline/edit.html.twig', array(
            'documentLine' => $documentLine,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DocumentLine entity.
     *
     */
    public function deleteAction(Request $request, DocumentLine $documentLine)
    {
        $form = $this->createDeleteForm($documentLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($documentLine);
            $em->flush();
        }

        return $this->redirectToRoute('documentline_index');
    }

    /**
     * Creates a form to delete a DocumentLine entity.
     *
     * @param DocumentLine $documentLine The DocumentLine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DocumentLine $documentLine)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('documentline_delete', array('id' => $documentLine->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [
                'label'=>'Delete',
                'attr'=>[
                    'class'=>'btn btn-danger'
                ]
            ])
            ->getForm()
        ;
    }
}
