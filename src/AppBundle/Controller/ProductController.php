<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductController extends Controller
{
     /** 
      * 
      * @Route("/product", name="product") 
      */ 
    public function indexAction(Request $request) 
    { /* 
     * sa generam un array de test 
     * 
    */
        for($i=0;$i<30;$i++){ 
            for($j=0;$j<10;$j++){ 
                $rez[$i][] ="text $i,$j"; } }
        
        return $this->render('product/index.html.twig', array( 'entities' => $rez, ));
    }
}