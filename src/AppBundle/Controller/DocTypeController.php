<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\DocType;
use AppBundle\Form\DocTypeType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * DocType controller.
 *
 */
class DocTypeController extends Controller
{
    /**
     * Lists all DocType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $mapping = $this->getDoctrine()->getManager()->getClassMetadata('AppBundle:DocType');
        $columns = $mapping->getFieldNames();

        $docTypes = $em->getRepository('AppBundle:DocType')->findAll();

        return $this->render('doctype/index.html.twig', array(
            'docTypes' => $docTypes,
            'columns'  => $columns,
        ));
    }

    /**
     * Creates a new DocType entity.
     *
     */
    public function newAction(Request $request)
    {
        $docType = new DocType();
        $form = $this->createForm('AppBundle\Form\DocTypeType', $docType);
        $form->add('submit', SubmitType::class, array(
            'label'=>'Create',
            'attr'=>array(
                'class'=>'btn btn-primary',
            ),
            'translation_domain'=>'AppBundle'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($docType);
            $em->flush();

            return $this->redirectToRoute('doctype_show', array('id' => $docType->getId()));
        }

        return $this->render('doctype/new.html.twig', array(
            'docType' => $docType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a DocType entity.
     *
     */
    public function showAction(DocType $docType)
    {
        $deleteForm = $this->createDeleteForm($docType);

        return $this->render('doctype/show.html.twig', array(
            'docType' => $docType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing DocType entity.
     *
     */
    public function editAction(Request $request, DocType $docType)
    {
        $deleteForm = $this->createDeleteForm($docType);
        $editForm = $this->createForm('AppBundle\Form\DocTypeType', $docType);
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
            $em->persist($docType);
            $em->flush();

            return $this->redirectToRoute('doctype_show', array('id' => $docType->getId()));
        }

        return $this->render('doctype/edit.html.twig', array(
            'docType' => $docType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DocType entity.
     *
     */
    public function deleteAction(Request $request, DocType $docType)
    {
        $form = $this->createDeleteForm($docType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($docType);
            $em->flush();
        }

        return $this->redirectToRoute('doctype_index');
    }

    /**
     * Creates a form to delete a DocType entity.
     *
     * @param DocType $docType The DocType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DocType $docType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('doctype_delete', array('id' => $docType->getId())))
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
