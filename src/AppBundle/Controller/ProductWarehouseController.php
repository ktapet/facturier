<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\ProductWarehouse;
use AppBundle\Form\ProductWarehouseType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * ProductWarehouse controller.
 *
 */
class ProductWarehouseController extends Controller
{
    /**
     * Lists all ProductWarehouse entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productWarehouses = $em->getRepository('AppBundle:ProductWarehouse')->findAll();

        return $this->render('productwarehouse/index.html.twig', array(
            'productWarehouses' => $productWarehouses,
        ));
    }

    /**
     * Creates a new ProductWarehouse entity.
     *
     */
    public function newAction(Request $request)
    {
        $productWarehouse = new ProductWarehouse();
        $form = $this->createForm('AppBundle\Form\ProductWarehouseType', $productWarehouse);
        $form->add('submit', SubmitType::class, array(
            'label'=>'Create',
            'attr'=>array(
                'class'=>'btn btn-primary',
            ),
            'translation_domain'=>'AppBundle',
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $data = $form->getData();
            $dataProductId = $data->getProduct();
            $dataWarehouseId = $data->getWarehouse();
            
            if($pd = $em->getRepository('AppBundle:ProductWarehouse')->findOneBy(
                array('product' => $dataProductId, 'warehouse' => $dataWarehouseId)
            )){
                $pd->setQuantity($pd->getQuantity() + $data->getQuantity());
                $id = $pd->getId();
                $em->flush();
            }else{
                $em->persist($productWarehouse);
                $em->flush();
                $id = $productWarehouse->getId();
            }
                      
            

            return $this->redirectToRoute('productwarehouse_show', array('id' => $id));
        }

        return $this->render('productwarehouse/new.html.twig', array(
            'productWarehouse' => $productWarehouse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductWarehouse entity.
     *
     */
    public function showAction(ProductWarehouse $productWarehouse)
    {
        $deleteForm = $this->createDeleteForm($productWarehouse);

        return $this->render('productwarehouse/show.html.twig', array(
            'productWarehouse' => $productWarehouse,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductWarehouse entity.
     *
     */
    public function editAction(Request $request, ProductWarehouse $productWarehouse)
    {
        $deleteForm = $this->createDeleteForm($productWarehouse);
        $editForm = $this->createForm('AppBundle\Form\ProductWarehouseType', $productWarehouse);
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
            $em->persist($productWarehouse);
            $em->flush();

            return $this->redirectToRoute('productwarehouse_show', array('id' => $productWarehouse->getId()));
        }

        return $this->render('productwarehouse/edit.html.twig', array(
            'productWarehouse' => $productWarehouse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProductWarehouse entity.
     *
     */
    public function deleteAction(Request $request, ProductWarehouse $productWarehouse)
    {
        $form = $this->createDeleteForm($productWarehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productWarehouse);
            $em->flush();
        }

        return $this->redirectToRoute('productwarehouse_index');
    }

    /**
     * Creates a form to delete a ProductWarehouse entity.
     *
     * @param ProductWarehouse $productWarehouse The ProductWarehouse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductWarehouse $productWarehouse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productwarehouse_delete', array('id' => $productWarehouse->getId())))
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
