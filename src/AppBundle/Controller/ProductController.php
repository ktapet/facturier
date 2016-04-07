<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{
    /**
     * Lists all Product entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('AppBundle:Product')->findAll();

        return $this->render('product/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Creates a new Product entity.
     *
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('AppBundle\Form\ProductType', $product);
        $form->add('submit', SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($product);

            $em->flush();

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Product entity.
     *
     */
    public function showAction(Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('product/show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     */
    public function editAction(Request $request, Product $product)
    {
        $origImages = new ArrayCollection();
        
        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($product->getImages() as $image) {
           $origImages->add($image);
        }     
    
        //$deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('AppBundle\Form\ProductType', $product);
        $editForm->add('submit', SubmitType::class);
        $editForm->handleRequest($request);
        

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // remove the relationship between the tag and the Task
            foreach ($origImages as $image) {
                if (false === $product->getImages()->contains($image)) {

                    $em->remove($image);
                }
            }
            
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
        }

        return $this->render('product/edit.html.twig', array(
            'product' => $product,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a Product entity.
     *
     */
    public function deleteAction(Request $request, Product $product)
    {
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Create an ArrayCollection of the current Tag objects in the database
            if($product->getImages()){
                foreach ($product->getImages() as $image) {
                    $em->remove($image);
                }   
            }

            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a Product entity.
     *
     * @param Product $product The Product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
