<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\ProductImage;
use AppBundle\Form\ProductImageType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * ProductImage controller.
 *
 */
class ProductImageController extends Controller
{
    /**
     * Lists all ProductImage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $mapping = $this->getDoctrine()->getManager()->getClassMetadata('AppBundle:ProductImage');
        $columns = $mapping->getFieldNames();

        $productImages = $em->getRepository('AppBundle:ProductImage')->findAll();

        return $this->render('productimage/index.html.twig', array(
            'productImages' => $productImages,
            'columns'       => $columns,
        ));
    }

    /**
     * Creates a new ProductImage entity.
     *
     */
    public function newAction(Request $request)
    {
        $productImage = new ProductImage();
        $form = $this->createForm('AppBundle\Form\ProductImageType', $productImage);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Create',
            'attr'=>array(
                'class'=>'btn btn-primary'
            ),
            'translation_domain'=>'AppBundle',
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productImage);
            $em->flush();

            return $this->redirectToRoute('productimage_show', array('id' => $productImage->getId()));
        }

        return $this->render('productimage/new.html.twig', array(
            'productImage' => $productImage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductImage entity.
     *
     */
    public function showAction(ProductImage $productImage)
    {
        $deleteForm = $this->createDeleteForm($productImage);

        return $this->render('productimage/show.html.twig', array(
            'productImage' => $productImage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductImage entity.
     *
     */
    public function editAction(Request $request, ProductImage $productImage)
    {
        $deleteForm = $this->createDeleteForm($productImage);
        $editForm = $this->createForm('AppBundle\Form\ProductImageType', $productImage);
        $editForm->add('submit', SubmitType::class, array(
            'label'=>'Edit',
            'attr'=>array(
                'class'=>'btn btn-primary',
            ),
            'translation_domain'=>'AppBundle',
        ));

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productImage);
            $em->flush();

            return $this->redirectToRoute('productimage_show', array('id' => $productImage->getId()));
        }

        return $this->render('productimage/edit.html.twig', array(
            'productImage' => $productImage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProductImage entity.
     *
     */
    public function deleteAction(Request $request, ProductImage $productImage)
    {
        $form = $this->createDeleteForm($productImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productImage);
            $em->flush();
        }

        return $this->redirectToRoute('productimage_index');
    }

    /**
     * Creates a form to delete a ProductImage entity.
     *
     * @param ProductImage $productImage The ProductImage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductImage $productImage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productimage_delete', array('id' => $productImage->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [
                'label'=>'Delete',
                'attr'=>[
                    'class'=>'btn btn-danger'
                ],
                'translation_domain'=>'AppBundle',
            ])
            ->getForm()
        ;
    }
}
