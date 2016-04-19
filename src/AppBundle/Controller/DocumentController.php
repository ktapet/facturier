<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Document;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Document controller.
 *
 */
class DocumentController extends Controller
{
    /**
     * Lists all Document entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documents = $em->getRepository('AppBundle:Document')->findAll();

        return $this->render('document/index.html.twig', array(
            'documents' => $documents,
        ));
    }
    
    public function makeListProd($arr, $tva=20){
	
		$total_valoare='';
		$total_tva='';		
		$table = '<table border="0" cellpadding="2" align="center">';
			foreach($arr as $k=>$v){
				$valoare = $v['cant'] * $v['pret'];
				$valoare_tva = round($valoare*($tva/100), 2);
				$total_valoare+=$valoare;
				$total_tva+=$valoare_tva;
				$table.='
					<tr>
						<td width="22">'.($k+1).'</td>
						<td width="258" align="left">'.$v['nume_prod'].'</td>
						<td width="32">'.$v['um'].'</td>
						<td width="65">'.$v['cant'].'</td>
						<td width="95" align="right">'.number_format($v['pret'],2,',','.').'</td>
						<td width="117" align="right">'.number_format($valoare,2,',','.').'</td>
						<td width="80" align="right">'.number_format($valoare_tva,2,',','.').'</td>
					</tr>
				';
				
			} // end foreach
			
		$total_plata=$total_valoare+$total_tva;
		$list_prod = array('table'=>$table, 'total_valoare'=>number_format($total_valoare,2,',','.'), 'total_tva'=>number_format($total_tva,2,',','.'), 'total_plata'=>number_format($total_plata,2,',','.'));
		return $list_prod;
    } // end makeListProd()         

    /**
     * Creates a new Document entity.
     *
     */
    public function newAction(Request $request)
    {
        $document = new Document();
        $form = $this->createForm('AppBundle\Form\DocumentType', $document);

        $form->add('submit', SubmitType::class, array(
            'label'=>'Create',
            'attr'=>array(
                'class'=>'btn btn-primary',
            ),
            'translation_domain'=>'AppBundle'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $data = $form->getData();
            $produse = array();
            foreach ($data->getDocumentLines() as $dl){
                
                //add stocks
                if($pd = $em->getRepository('AppBundle:ProductWarehouse')->findOneBy(
                array('product' => $dl->getProduct(), 'warehouse' => $form->get('warehouse')->getData())
                ))
                {
                    $pd->setQuantity($pd->getQuantity() + $dl->getQuantity() * $data->getDocType()->getDirection());
                }
                
                //create invoice fields
                array_push($produse,
                    array(
                        'nume_prod' => $dl->getProduct()->getNume(),
                        'um' => $dl->getProduct()->getUnitMeasure()->getName(),
                        'cant' => $dl->getQuantity(),
                        'pret' => $dl->getProduct()->getSalePrice())
                    
                );             
            }
                $addr = [];
                foreach ($form->get('partner')->getData()->getAddresses() as $key => $address){
                    $addr[$key] = $address;
                                }
                // date client				
                $client = array(
				'nume_client'	=> $form->get('partner')->getData()->getName(),
				'reg_com'	 	=>'J40/343434/2003',
				'cui'	 		=>'RO17083320',
                                'adresa'		=> $addr[0],
				'cont'	 		=> $form->get('partner')->getData()->getIban(),
				'banca'			=> $form->get('partner')->getData()->getBank(),
				);
                // date factura
                $date_factura = array(
				'seria'		=> '',
				'numarul'	=> $data->getDocNumber(),
				'data'		=> date('Y-m-d'),
				'aviz'		=> $data->getDocType()->getName(),
				'scadenta'	=> date('Y-m-d', strtotime('+10 days')),
                                                );
            $today = new \DateTime("now");   
            $document->setDatCre($today);  
            $document->setDatUpd($today);    
            
            $user = $this->get('security.token_storage')->getToken()->getUser();  
            
            $document->setCreatedBy($user); 
            /**********************************date ce vor fi completate pe factura*******************************/                       
//       $produse = array(
//				array('nume_prod' =>'pc - pentium', 'um'=>'buc', 'cant'=>'1','pret'=>'557.22'),
//				array('nume_prod' =>'placa de baza', 'um'=>'buc', 'cant'=>'4','pret'=>'600'),
//				array('nume_prod' =>'placa video', 'um'=>'buc', 'cant'=>'23','pret'=>'330'),
//				array('nume_prod' =>'placa audio', 'um'=>'buc', 'cant'=>'13','pret'=>'120'),
//				array('nume_prod' =>'monitor', 'um'=>'buc', 'cant'=>'33','pret'=>'630'),
//				);	
        // date client				
//        $client = array(
//				'nume_client'	=>'S.C. VIFOR S.R.L.',
//				'reg_com'	 	=>'J40/343434/2003',
//				'cui'	 		=>'RO17083320',
//				'adresa'		=>'Str. Florilor nr.1 Sector 1, Bucuresti',
//				'cont'	 		=>'RO45 BMRE 2323 2323 2323 2323',
//				'banca'			=>'OTPEW',
//				);
        // date furnizor				
        $furnizor = array(
				'nume_furnizor'	=>'S.C. PC Pentru Toti S.R.L.',
				'reg_com'	 	=>'J40/343434/2003',
				'cui'	 		=>'RO17083320',
				'adresa'		=>'Str. Florilor nr.1 Sector 1, Bucuresti',
				'cont'	 		=>'RO45 BMRE 2323 2323 2323 2323',
				'banca'			=>'OTPEW',
				);
        //date factura
//        $date_factura = array(
//				'seria'		=>'B',
//				'numarul'	=>'1234',
//				'data'		=>'10/04/2012',
//				'aviz'		=>'1234',
//				'scadenta'	=>'10/05/2012',
//                                                );

        // notice					
        $notice = 'neplata facturii pana la data scadenta atrage penalitati';
        // date delegat
        $delegat = array(
				'nume_delegat'  =>'Ion Popescu',
				'bi-ci'	 		=>'CI',
				'seria'	 		=>'RD',
				'numarul'	 	=>'123123',
				'auto'	 		=>'B79FOP',
				);	
        // date chitanta
        $chitanta = array(
				'nume_client'  	=>'S.C. VIFOR S.R.L.',
				'seria'	 		=>'B',
				'numarul'	 	=>'123123',
				'data'	 		=>'10/04/2012',
				'suma'	 		=>'40.792,55',
				'reg_com'	 	=>'J40/343434/2003',
				'cui'	 		=>'RO17083320',
				'adresa'		=>'Str. Florilor nr.1 Sector 1, Bucuresti',
				);	
/**********************************end date ce vor fi completate pe factura*******************************/   
            
            $this->generatePdfDoc($produse,$client,$furnizor,$date_factura, $notice,$delegat,$chitanta);
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('document_show', array('id' => $document->getId()));
        }

        return $this->render('document/new.html.twig', array(
            'document' => $document,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Document entity.
     *
     */
    public function showAction(Document $document)
    {
        $deleteForm = $this->createDeleteForm($document);

        return $this->render('document/show.html.twig', array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Document entity.
     *
     */
    public function editAction(Request $request, Document $document)
    {
        $origDocumentLines = new ArrayCollection();


        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($document->getDocumentLines() as $documentLine) {
            $origDocumentLines->add($documentLine);
        }


        $deleteForm = $this->createDeleteForm($document);
        $editForm = $this->createForm('AppBundle\Form\DocumentType', $document);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $today = new \DateTime("now");   
            $document->setDatCre($today);  
            $document->setDatUpd($today);    
            
            $user = $this->get('security.token_storage')->getToken()->getUser();  
            
            $document->setModifiedBy($user); 
            foreach ($origDocumentLines as $documentLine) {
                if (false === $document->getDocumentLines()->contains($documentLine)) {

                    $em->remove($documentLine);
                }
            }
            $em->persist($document);
            $em->flush();
            return $this->redirectToRoute('document_edit', array('id' => $document->getId()));
        }
        return $this->render('document/edit.html.twig', array(
            'document' => $document,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a Document entity.
     *
     */
    public function deleteAction(Request $request, Document $document)
    {
        $form = $this->createDeleteForm($document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Create an ArrayCollection of the current Tag objects in the database
            if($document->getDocumentLines()){
                foreach ($document->getDocumentLines() as $documentLine) {
                    $em->remove($documentLine);
                }
            }
            $em->remove($document);
            $em->flush();
        }

        return $this->redirectToRoute('document_index');
    }

    /**
     * Creates a form to delete a Document entity.
     *
     * @param Document $document The Document entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Document $document)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('document_delete', array('id' => $document->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array(
                'label'=>'Delete',
                'attr'=>array(
                    'class'=>'btn btn-danger'
                ),
                'translation_domain'=>'AppBundle'
            ))
            ->getForm()
        ;
    }
    
    public function generatePdfDoc($produse,$client,$furnizor,$date_factura,$notice,$delegat,$chitanta){
        
        $pdf = $this->get("white_october.tcpdf")->create();   
        // informatii despre document
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Catalin Arsene');
        $pdf->SetTitle('Factura');
        $pdf->SetSubject('Exemplu factura');
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, '10');
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language dependent data:
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'ltr';
        $lg['a_meta_language'] = 'bg';
        $lg['w_page'] = 'page';
        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);
        //$pdf->setLanguageArray($l);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 8, '', true);
        // stergem headerul si footerul
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        // factura
        // headerul facturii
        // header stanga
        $html_furnizor = '
                                        Furnizor:
                                        <h4>'.$furnizor['nume_furnizor'].'</h4>
                                        Registrul Comertului:<br />
                                        '.$this->style_data($furnizor['reg_com']).'<br />
                                        CUI: '.$this->style_data($furnizor['cui']).'<br />
                                        Adresa:'.$this->style_data($furnizor['adresa']).'<br />
                                        Banca: '.$this->style_data($furnizor['banca']).'<br />
                                        Cont: '.$this->style_data($furnizor['cont']).'
                                        ';
        $pdf->writeHTMLCell (65, 0, 10, 6, $html_furnizor);
        // header centru
        $image_file = K_PATH_IMAGES.'logo_facturier.png';
        $pdf->Image($image_file,80,7,40,0);
        $pdf->writeHTMLCell (0, 0, 83, 23, '<h1>FACTURA</h1>');
        $html_date_factura ='
                                        seria '.$this->style_data($date_factura['seria']).' numarul '.$this->style_data($date_factura['numarul']).'.<br />
                                        Data: '.$this->style_data($date_factura['data']).'<br />
                                        Aviz numarul: '.$this->style_data($date_factura['aviz']).'<br />
                                        Data scadenta: '.$this->style_data($date_factura['scadenta']).'
                                        ';
        $pdf->writeHTMLCell (60, 0, 80, 30, $html_date_factura);
        //header dreapta
        $html_client = '
                                        Client:
                                        <h4>'.$client['nume_client'].'</h4>
                                        Registrul Comertului:<br />
                                        '.$this->style_data($client['reg_com']).'<br />
                                        CUI: '.$this->style_data($client['cui']).'<br />
                                        Adresa:'.$this->style_data($client['adresa']).'<br />
                                        Banca: '.$this->style_data($client['banca']).'<br />
                                        Cont: '.$this->style_data($client['cont']).'
                                        ';
        $pdf->writeHTMLCell (70, 0, 125, 6, $html_client);
        $pdf->writeHTMLCell (0, 0, 10, 50, 'Cota TVA: 20%');
        // sfarsit header factura
        // corp central factura
        // desenam chenarul in care vor fi trecute produsele
        // semnatura metodei rect
        // Rect ($x, $y, $w, $h, $style='', $border_style=array(), $fill_color=array())
        $pdf->Rect(10, 55, 190, 185, '', '', array());
        // semnatura metodei Line
        // Line ($x1, $y1, $x2, $y2, $style=array())
        $pdf->Line(10, 65, 200, 65, '');
        $pdf->Line(17, 55, 17, 215, '');
        $pdf->Line(90, 55, 90, 215, '');
        $pdf->Line(99, 55, 99, 215, '');
        $pdf->Line(117, 55, 117, 240, '');
        $pdf->Line(144, 55, 144, 240, '');
        $pdf->Line(177, 55, 177, 223, '');
        $pdf->Line(144, 223, 200, 223, '');
        $pdf->Line(46, 215, 46, 240, '');
        $pdf->Line(10, 70, 200, 70, '');
        $pdf->Line(10, 215, 200, 215, '');
//capul de tabel
$head_table =<<<str
<table border="0" cellpadding="2" align="center">
	<tr>
		<td width="22">nr. crt</td>
		<td width="258">Denumirea produselor<br /> sau a serviciilor</td>
		<td width="32">U.M.</td>
		<td width="65">cantitatea</td>
		<td width="95">pret unitar(lei) (fara TVA)</td>
		<td width="117">valoarea (lei)</td>
		<td width="80">valoarea TVA (lei)</td>
	</tr>
</table>
str;
        $pdf->writeHTMLCell (190, 0, 10, 56, $head_table);
        // terminat capul de tabel
// subcapul de tabel
$sub_head_table =<<<str
<table border="0" cellpadding="2" align="center">
	<tr>
		<td width="22">0</td>
		<td width="258">1</td>
		<td width="32">2</td>
		<td width="65">3</td>
		<td width="95">4</td>
		<td width="117">5(3x4)</td>
		<td width="80">6</td>
	</tr>
</table>
str;
        $pdf->writeHTMLCell (190, 0, 10, 65.5, $sub_head_table);
        // terminat subcapul de tabel
        // sriem lista produselor si/sau serviciilor
        $rez=$this->makeListProd($produse);
        $pdf->writeHTMLCell (0, 0, 10, 75, $this->style_data($rez['table']));
        $pdf->writeHTMLCell (0, 0, 152, 216, $this->style_data($rez['total_valoare']));
        $pdf->writeHTMLCell (0, 0, 177, 216, $this->style_data($rez['total_tva']));
        $pdf->SetFont('dejavusans', 'B', 9, '', true);
        $pdf->writeHTMLCell (0, 0, 154, 225, 'Total de Plata<br /><br />'.$this->style_data($rez['total_plata']));
        $pdf->SetFont('dejavusans', '', 8, '', true);
        // daca exista afisam notice-ul
        if($notice) $pdf->writeHTMLCell (0, 0, 25, 190, $this->style_data($notice));
        // date delegat
        $html_delegat ='
                                        Numele delegatului: '.$this->style_data($delegat['nume_delegat']).'<br />
                                        BI/CI: '.$this->style_data($delegat['bi-ci']).' Seria: '.$this->style_data($delegat['seria']).' Nr.'.$this->style_data($delegat['numarul']).'<br />
                                        Mijloc transport: '.$this->style_data($delegat['auto']).'<br />
                                        Expedierea s-a efectuat in prezenta noastra la<br />
                                        Data de: ............ ora: ...........<br />
                                        Semnatura delegat:<br />
                                        ..........................'
                                        ;
        $pdf->writeHTMLCell (68, 0, 46, 215, $html_delegat);
        $pdf->writeHTMLCell (30, 0, 11, 215, 'semnatura si stampila furnizorului');
        $pdf->writeHTMLCell (22, 0, 117, 215, 'semnatura de primire');
        // codul de bare
        // semnatura write1DBarcode ($code, $type, $x='', $y='', $w='', $h='', $xres='', $style='', $align='')
        $code = (string)$rez['total_plata'];
        $pdf->write1DBarcode($code, 'C128', '', 49, '', 6, 0.4, '', 'T');
        // terminat corp central factura
        // terminat factura
        // chitanta
        $pdf->Rect(10, 242, 190, 50, '', '', array());
        $pdf->Line(70, 242, 70, 292, '');
        // date furnizor chitanta
        $pdf->writeHTMLCell (60, 0, 10, 244, $html_furnizor);
        $pdf->writeHTMLCell (0, 0, 75, 244, '<span style="font-size:56px; font-weight:bold">CHITANTA</span>');
        if($chitanta){
                $html_chitanta='
                                                Seria:'.$this->style_data($chitanta['seria']).' nr. '.$this->style_data($chitanta['numarul']).'<br />
                                                Data:'.$this->style_data($chitanta['data']).' <br />
                                                Am primit de la '.$this->style_data($chitanta['nume_client']).'<br />
                                                Nr. Ord. Reg. Com. '.$this->style_data($chitanta['reg_com']).' CUI '.$this->style_data($chitanta['cui']).'<br />
                                                Adresa '.$this->style_data($chitanta['adresa']).'<br />
                                                Suma de '.$this->style_data($chitanta['suma']).' lei<br />
                                                Reprezentand contravaloare factura nr. '.$this->style_data($date_factura['numarul']).' din '.$this->style_data($date_factura['data']).'<br />
                                                Casier ...........................
                                                ';
        } else{
                $html_chitanta='
                                                Seria:.............nr. ............................<br />
                                                Data:.................................................... <br />
                                                Am primit de la..........................................<br />
                                                Nr. Ord. Reg. Com. ................. CUI ................<br />
                                                Adresa ..................................................<br />
                                                Suma de .................................................<br />
                                                Reprezentand contravaloare factura .......din ...........<br />
                                                Casier ..................................................
                                                ';	
        }
    $pdf->writeHTMLCell (120, 0, 75, 258, $html_chitanta);
    // terminat chitanta
    $pdf->Output(__DIR__.'/../../../invoices/'.'invoice_seria_'.$date_factura['seria'].'_nr_'.$date_factura['numarul'].'.pdf', 'F');
    } // end generatePdfDoc    
    
    public function style_data($str){
        // o metoda pentru stilizarea datelor ce apar pe factura
        return '<span style="font-family: courier; font-height: bold;font-style:italic">'.$str.'</span>';
    } // end style_data()        
}

