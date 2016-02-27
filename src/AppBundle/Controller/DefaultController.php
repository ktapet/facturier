<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
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
    

    public function raspunsHtmlMvcAction()
    {
        $number = rand(0, 100);
 
        $res = $this->render(
            'Default/raspunsHtml.html.twig',
            array('number' => $number)
        );
        
        return $res;
    }      
    

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
