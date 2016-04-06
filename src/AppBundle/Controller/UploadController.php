<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Form\CSVFileType;
use AppBundle\Entity\CsvFiles;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UploadController extends Controller
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("upload", name="upload")
     */
    public function indexAction(Request $request)
    {
        $document = new CsvFiles();
        $form = $this->createForm('AppBundle\Form\CSVFileType', $document);
        $form->add('name', FileType::class);
        $form->add('submit', SubmitType::class, array(
            'attr'=> array(
                'class'=>'btn btn-success'
            )
        ));
        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid())
        {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $document->getName();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $brochuresDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/images';
            $file->move($brochuresDir, $fileName);

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $document->setName($fileName);

            return $this->redirectToRoute('index');

        }

        return $this->render('upload/new.html.twig', array(
            'form' => $form->createView(),

        ));
    }
}
