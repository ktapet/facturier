<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\DocStatus;
use AppBundle\Form\DocStatusType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * DocStatus controller.
 *
 */
class DocStatusController extends Controller
{
    /**
     * Lists all DocStatus entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $mapping = $this->getDoctrine()->getManager()->getClassMetadata('AppBundle:DocStatus');
        $columns = $mapping->getFieldNames();

        $docStatuses = $em->getRepository('AppBundle:DocStatus')->findAll();

        return $this->render('docstatus/index.html.twig', array(
            'docStatuses' => $docStatuses,
            'columns'     => $columns,
        ));
    }

    /**
     * Creates a new DocStatus entity.
     *
     */
    public function newAction(Request $request)
    {
        $docStatus = new DocStatus();
        $form = $this->createForm('AppBundle\Form\DocStatusType', $docStatus);
        $form->add('submit', SubmitType::class, array(
            'label'=>'Create',
            'attr'=>array(
                'class'=>'btn btn-primary'
            ),
            'translation_domain'=>'AppBundle'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($docStatus);
            $em->flush();

            return $this->redirectToRoute('docstatus_show', array('id' => $docStatus->getId()));
        }

        return $this->render('docstatus/new.html.twig', array(
            'docStatus' => $docStatus,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a DocStatus entity.
     *
     */
    public function showAction(DocStatus $docStatus)
    {
        $deleteForm = $this->createDeleteForm($docStatus);

        return $this->render('docstatus/show.html.twig', array(
            'docStatus' => $docStatus,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing DocStatus entity.
     *
     */
    public function editAction(Request $request, DocStatus $docStatus)
    {
        $deleteForm = $this->createDeleteForm($docStatus);
        $editForm = $this->createForm('AppBundle\Form\DocStatusType', $docStatus);
        $editForm->add('submit', SubmitType::class, [
            'label'=>'Save',
            'attr'=>[
                'class'=>'btn btn-success'
                ],
            'translation_domain'=>'AppBundle'
        ]);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($docStatus);
            $em->flush();

            return $this->redirectToRoute('docstatus_show', array('id' => $docStatus->getId()));
        }

        return $this->render('docstatus/edit.html.twig', array(
            'docStatus' => $docStatus,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DocStatus entity.
     *
     */
    public function deleteAction(Request $request, DocStatus $docStatus)
    {
        $form = $this->createDeleteForm($docStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($docStatus);
            $em->flush();
        }

        return $this->redirectToRoute('docstatus_index');
    }

    /**
     * Creates a form to delete a DocStatus entity.
     *
     * @param DocStatus $docStatus The DocStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DocStatus $docStatus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('docstatus_delete', array('id' => $docStatus->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [
                'label'=>'Delete',
                'attr'=>[
                    'class'=>'btn btn-danger'
                ],
                'translation_domain'=>'AppBundle'
            ])
            ->getForm()
        ;
    }
}
