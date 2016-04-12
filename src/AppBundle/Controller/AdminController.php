<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction(Request $request)
    {
       $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('admin/index.html.twig', array(
            'entities' => $entities,
        )); 
    }
    
    public function editAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
    }
    
   
}
