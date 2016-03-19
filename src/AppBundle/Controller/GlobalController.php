<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GlobalController extends Controller {

    /**
     * @Route("/raspuns/name/{name}", name="default_name")
     * 
     */
    public function myNameAction($name) {


//        $res = new Response(
//            '<html><body>Hello: '.$name.'</body></html>'
//        );
//        
//        return $res;
        $res = $this->render(
                'global/exemplu.html.twig', array('name' => $name)
        );

        return $res;
    }

    public function arrayNumbersAction() {
        $data = array(
            array('1', '2', '3'),
            array('4', '5', '6')
        );

        $this->addFlash(
                'notice', 'Tabel:'
        );

        $res = $this->render(
                'global/array.html.twig', array('numbers' => $data)
        );

        return $res;
    }

    public function paramsAction($p1, $p2) {
        $params = $p1 . ',' . $p2;

        $this->addFlash(
                'notice', 'Parametri introdusi:'
        );

        $rez = $this->render(
                'global/array.html.twig', 
                array(
                    'params' => $params,
                    'p1' => $p1,
                    'p2' => $p2,
                )
        );

        return $rez;
    }

}
