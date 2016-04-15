<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('admin/index.html.twig', array(
            'users' => $users,

        ));
    }



    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('admin/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, User $user)
    {

        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->add('submit', SubmitType::class, array(
            'label'=>'Edit',
            'attr'=>array(
                'class'=>'btn btn-primary',
            ),
            'translation_domain'=>'AppBundle',
        ));

        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_show', array('id'=>$user->getId()));
        }

        return $this->render('admin/edit.html.twig', array(
            'edit_form'=>$editForm->createView(),
        ));
    }



    public function deleteAction(Request $request, User $user){

        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('admin');
    }

    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('address_delete', array('id' => $user->getId())))
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
