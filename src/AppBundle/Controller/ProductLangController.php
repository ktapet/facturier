<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\ProductLang;
use AppBundle\Form\ProductLangType;

/**
 * ProductLang controller.
 *
 */
class ProductLangController extends Controller
{
    /**
     * Lists all ProductLang entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productLangs = $em->getRepository('AppBundle:ProductLang')->findAll();

        return $this->render('productlang/index.html.twig', array(
            'productLangs' => $productLangs,
        ));
    }

    /**
     * Creates a new ProductLang entity.
     *
     */
    public function newAction(Request $request)
    {
        $productLang = new ProductLang();
        $form = $this->createForm('AppBundle\Form\ProductLangType', $productLang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productLang);
            $em->flush();

            return $this->redirectToRoute('productlang_show', array('id' => $productLang->getId()));
        }

        return $this->render('productlang/new.html.twig', array(
            'productLang' => $productLang,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductLang entity.
     *
     */
    public function showAction(ProductLang $productLang)
    {
        $deleteForm = $this->createDeleteForm($productLang);

        return $this->render('productlang/show.html.twig', array(
            'productLang' => $productLang,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductLang entity.
     *
     */
    public function editAction(Request $request, ProductLang $productLang)
    {
        $deleteForm = $this->createDeleteForm($productLang);
        $editForm = $this->createForm('AppBundle\Form\ProductLangType', $productLang);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productLang);
            $em->flush();

            return $this->redirectToRoute('productlang_edit', array('id' => $productLang->getId()));
        }

        return $this->render('productlang/edit.html.twig', array(
            'productLang' => $productLang,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProductLang entity.
     *
     */
    public function deleteAction(Request $request, ProductLang $productLang)
    {
        $form = $this->createDeleteForm($productLang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productLang);
            $em->flush();
        }

        return $this->redirectToRoute('productlang_index');
    }

    /**
     * Creates a form to delete a ProductLang entity.
     *
     * @param ProductLang $productLang The ProductLang entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductLang $productLang)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productlang_delete', array('id' => $productLang->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
