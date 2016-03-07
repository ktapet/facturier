<?php


namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class GlobalController extends Controller{

    /**
     * @Route("/globals", name="global")
     */
    public function globalAction(){
        
         return $this->render('global/global.html.twig');
         
         
    }
    
    
    public function flashMsgExAction($numar)
    {
        $data = array();
        for ($i = 1; $i <= $numar; $i++) {
            
         for($i = 1; $i <=$numar; $i++){
            $data['numar_generat'.$i] = rand(0, 100);
            }
            
        }
 
        $this->addFlash(
            'notice',
            'Sunt afisat numai in raspunul acesta!'
        );
        
        return $this->render(
            'Default/flashEx.html.twig',
            array('res' => $data)
        );
    }      
    
    
    public function paramExAction($p1, $p2){
        
        
        return $this->render('global/global.html.twig', [ 'p1'=>$p1, 'p2'=>$p2 ]);
        
        
    }
    
    
    
    
    
    
}