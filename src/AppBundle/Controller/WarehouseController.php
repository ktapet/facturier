<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Warehouse;
use AppBundle\Form\WarehouseType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Warehouse controller.
 * 
 */
class WarehouseController extends Controller
{
    /**
     * Lists all Warehouses entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $warehouses = $em->getRepository('AppBundle:Warehouse')->findAll();

        return $this->render('warehouse/index.html.twig', array(
            'warehouses' => $warehouses
        ));
    }

    /**
     * Creates a new Warehouse entity.
     *
     */
    public function newAction(Request $request)
    {
        $warehouse = new Warehouse();
        $form = $this->createForm('AppBundle\Form\WarehouseType', $warehouse);
        $form->add('submit', SubmitType::class);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($warehouse);
            $em->flush();

            return $this->redirectToRoute('warehouse_show', array('id' => $warehouse->getId()));
        }

        return $this->render('warehouse/new.html.twig', array(
            'warehouse' => $warehouse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a warehouse entity.
     *
     */
    public function showAction(Warehouse $warehouse)
    {
        $deleteForm = $this->createDeleteForm($warehouse);

        return $this->render('warehouse/show.html.twig', array(
            'warehouse' => $warehouse,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Warehouse entity.
     *
     */
    public function editAction(Request $request, Warehouse $warehouse)
    {
        $deleteForm = $this->createDeleteForm($warehouse);
        $editForm = $this->createForm('AppBundle\Form\WarehouseType', $warehouse);
        $editForm->add('submit', SubmitType::class);        
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($warehouse);
            $em->flush();

            return $this->redirectToRoute('warehouse_show', array('id' => $warehouse->getId()));
        }

        return $this->render('warehouse/edit.html.twig', array(
            'warehouse' => $warehouse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Warehouse entity.
     *
     */
    public function deleteAction(Request $request, Warehouse $warehouse)
    {
        $form = $this->createDeleteForm($warehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($warehouse);
            $em->flush();
        }

        return $this->redirectToRoute('warehouse_index');
    }

    /**
     * Creates a form to delete a Warehouse entity.
     *
     * @param Warehouse $warehouse The Warehouse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Warehouse $warehouse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('warehouse_delete', array('id' => $warehouse->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class)
            ->getForm()
        ;        
    }
}
