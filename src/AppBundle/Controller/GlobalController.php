<?php


namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class GlobalController extends Controller{

    /**
     * @Route("/globals", name="global")
     */
    public function globalAction(){
        
         return $this->render('global/global.html.twig');
         
         
    }
    
    
    
    
    /**
     * @Route("/for", name="for")
     * 
     */
    public function forAction(){
        
        
        
       return  $this->render( 'base.html.twig' );
       
       
      
     }
    
   
            
    
}