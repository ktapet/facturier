<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GlobalController extends Controller
{
    /**
     * @Route("/numelemeu", name="homepage1")
     */
    public function test1(Request $request)
    {
        $number = 1000;
        $r[0] = '00';
        $r[1] = '11';
        $r['sd'] = '99';




        for ($i = 1; $i <= 2; $i++) {
            for ($j = 1; $j <= 10; $j++) {

                $data1[$i][$j] = $i + $j;

            }
        }

        $this->addFlash(
            'notice',
            'test2'
        );

        $res = $this->render(
            'global/testalin.html.twig',
            array('r'=>$r,'rez'=>$data1,'number' => $number, 'var1'=>'111')
        );

        return $res;
    }
    /**
     * @Route("/numelemeu1", name="homepage2")
     */
    public function test2(Request $request)
    {
        $res = new Response(
            '<html><body>Acesta nu este numarul generat: '.'</body></html>'
        );

        return $res;
    }


   // public function paramsExAction($p1,$p2)
    public function paramsExAction(Request $request)

    {

        $p1=$request->get('p1');
        $p2=$request->get('p2');


        $res = $this->render(
            'global/testalin1.html.twig',
            array('p1'=>$p1,'p2'=>$p2)
        );

        return $res;

    }



}
