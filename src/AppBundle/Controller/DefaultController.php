<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {

        /* * sa generam un array de test * */ 
        for($i=0;$i<30;$i++){ 
            for($j=0;$j<10;$j++){ 
            $rez[$i][] ="text $i,$j"; 
            } 
        }



        return $this->render('default/index.html.twig', array( 'entities' => $rez ));
        



    }


    
    
    
}
