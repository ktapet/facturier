<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\PaymentType;
use AppBundle\Form\PaymentTypeType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * PaymentType controller.
 *
 * @Route("/paymenttype")
 */
class PaymentTypeController extends Controller
{
    /**
     * Lists all PaymentType entities.
     *
     * @Route("/", name="paymenttype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paymentTypes = $em->getRepository('AppBundle:PaymentType')->findAll();

        return $this->render('paymenttype/index.html.twig', array(
            'paymenttypes' => $paymentTypes,
        ));
    }

    /**
     * Creates a new PaymentType entity.
     *
     * @Route("/new", name="paymenttype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $paymentType = new PaymentType();
        $form = $this->createForm('AppBundle\Form\PaymentTypeType', $paymentType);
        $form->add('submit', SubmitType::class, array(
            'label'=>'Create',
            'attr'=>array(
                'class'=>'btn btn-primary'
            )
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paymentType);
            $em->flush();

            return $this->redirectToRoute('paymenttype_show', array('id' => $paymentType->getId()));
        }

        return $this->render('paymenttype/new.html.twig', array(
            'paymenttype' => $paymentType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PaymentType entity.
     *
     * @Route("/{id}", name="paymenttype_show")
     * @Method("GET")
     */
    public function showAction(PaymentType $paymentType)
    {
        $deleteForm = $this->createDeleteForm($paymentType);

        return $this->render('paymenttype/show.html.twig', array(
            'paymenttype' => $paymentType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PaymentType entity.
     *
     * @Route("/{id}/edit", name="paymenttype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PaymentType $paymentType)
    {
        $deleteForm = $this->createDeleteForm($paymentType);
        $editForm = $this->createForm('AppBundle\Form\PaymentTypeType', $paymentType);
        $editForm->add('submit', SubmitType::class, array(
            'label'=>'Edit',
            'attr'=>array(
                'class'=>'btn btn-success'
            )
        ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paymentType);
            $em->flush();

            return $this->redirectToRoute('paymenttype_show', array('id' => $paymentType->getId()));
        }

        return $this->render('paymenttype/edit.html.twig', array(
            'paymenttype' => $paymentType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PaymentType entity.
     *
     * @Route("/{id}", name="paymenttype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PaymentType $paymentType)
    {
        $form = $this->createDeleteForm($paymentType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paymentType);
            $em->flush();
        }

        return $this->redirectToRoute('paymenttype_index');
    }

    /**
     * Creates a form to delete a PaymentType entity.
     *
     * @param PaymentType $paymentType The PaymentType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PaymentType $paymentType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paymenttype_delete', array('id' => $paymentType->getId())))
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
