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
<<<<<<< HEAD
        /* * sa generam un array de test * */ 
        for($i=0;$i<30;$i++){ 
            for($j=0;$j<10;$j++){ 
            $rez[$i][] ="text $i,$j"; 
            } 
        } 
        return $this->render('default/index.html.twig', array( 'entities' => $rez, ));
        
=======
        /*
         * sa generam un array de test
         * 
         */ 
        for($i=0;$i<30;$i++){
            for($j=0;$j<10;$j++){                
                $rez[$i][] ="text $i,$j";                
            }
        }

        return $this->render('default/index.html.twig', array(
            'entities' => $rez,
        ));
>>>>>>> 9717e311e57647e7024ad665475bb40f41b76fd2
    }
    
    /**
     * @Route("/raspuns/html", name="default_raspuns")
     * 
     */
    public function raspunsHtmlAction()
    {
        $number = rand(0, 100);
 
        $res = new Response(
            '<html><body>Acesta este numarul generat: '.$number.'</body></html>'
        );
        
        return $res;
    }    
    
    /**
     * @Route("/raspuns/json/{numar}")
     */
    public function raspunsJsonAction($numar)
    {
        $data = array();
        for ($i = 1; $i <= $numar; $i++) {
            $data['numar_generat'.$i] = rand(0, 100);
        }
 
        return new Response(
            json_encode($data),
            200,
            array('Content-Type' => 'application/json')
        );
    }  
    

    public function raspunsHtmlMvcAction(Request $request)
    {
        $number = rand(0, 100);
 
        $res = $this->render(
            'Default/raspunsHtml.html.twig',
            array('number' => $number)
        );
        
        return $res;
    }      
    
    /**
     * 
     * @Route("/flas/{numar}", name="flas" )
     */
    public function flashMsgExAction($numar)
    {
        $data = array();
        for ($i = 1; $i <= $numar; $i++) {
            $data['numar_generat'.$i] = rand(0, 100);
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
    
    
    
    
    
}
