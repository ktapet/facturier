<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;

use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use AppBundle\Entity\Feature;
use AppBundle\Entity\UnitMeasure;
use AppBundle\Entity\ProductWarehouse;
use AppBundle\Entity\ProductLang;
use AppBundle\Entity\Warehouse;



/**
 * Description of Syncronize
 *
 * @author catalin
 */
class Syncronize {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    /*
     * o folosim pentru citire linii din fisiere mari
     * vezi detalii aici:
     * http://stackoverflow.com/questions/15025875/what-is-the-best-way-in-php-to-read-last-lines-from-a-file
     * si aici
     * https://gist.github.com/lorenzos/1711e81a9162320fde20
     * 
     * returneaza un string \n pentru separare linii
     * 
     */
    function tailCustom($filepath, $lines = 1, $adaptive = true) {
            // Open file
            $f = @fopen($filepath, "rb");
            if ($f === false) return false;
            // Sets buffer size
            if (!$adaptive) $buffer = 4096;
            else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));
            // Jump to last character
            fseek($f, -1, SEEK_END);
            // Read it and adjust line number if necessary
            // (Otherwise the result would be wrong if file doesn't end with a blank line)
            if (fread($f, 1) != "\n") $lines -= 1;

            // Start reading
            $output = '';
            $chunk = '';
            // While we would like more
            while (ftell($f) > 0 && $lines >= 0) {
                    // Figure out how far back we should jump
                    $seek = min(ftell($f), $buffer);
                    // Do the jump (backwards, relative to where we are)
                    fseek($f, -$seek, SEEK_CUR);
                    // Read a chunk and prepend it to our output
                    $output = ($chunk = fread($f, $seek)) . $output;
                    // Jump back to where we started reading
                    fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);
                    // Decrease our line counter
                    $lines -= substr_count($chunk, "\n");
            }
            // While we have too many lines
            // (Because of buffer size we might have read too many)
            while ($lines++ < 0) {
                    // Find first newline and remove all text before that
                    $output = substr($output, strpos($output, "\n") + 1);
            }
            // Close file and return
            fclose($f);
            return trim($output);
    }    
     
    /*
     * update our stocks
     */
    function updateStocks($my_file){
        
        $em = $this->em;
        $ktap_unique =array();
        $kta_switch=true;
        $erori = '';  
        $nr_crt=1;
        $ktnow = new \DateTime('now');  
         
        // get warehouses
        $warehouses = $em->getRepository('AppBundle:Warehouse')->findAll();  
        
        if(!$warehouses){
            return 'Nu avem depozite create!';
        }          
        
        //extragem ultimele 20000 de linii din fisierul csv
        if($ktares=$this->tailCustom($my_file,20000)){
           $lines = explode("\n",$ktares); 
        }        
        
        if (isset($lines)) {      
            
            foreach($lines as $line){
                
                $line = explode(';', $line);
                
                $line = array_map('trim', $line);
                
                if(count($line) < 1) {
                    
                    $erori = 'Separator gresit!';
                    continue;
                    
                } else {
                    
                    // extract csv headers                    
                    if($kta_switch){

                        $head_table = $line;

                        //get reference column
                        $reference_col=array_search('reference', $head_table);
                        if (false===$reference_col){
                            return 'Fisierul csv nu contine reference in capul de tabel.';
                        }
                        $kta_switch=false;
                        $nr_crt++;
                        continue;
                    }
                    
                    /*
                     * in cazul in care in fisierul csv sunt mai multe linii
                     * cu aceeasi reference, noi o folosim numai pe prima
                     * pentru asta folosim $ktap_unique
                     * 
                     */    
                    if(!in_array($line[$reference_col], $ktap_unique)){

                        $ktap_unique[] = $line[$reference_col];

                    }  else { // daca se afla avem duplicat => sarim linia
                        $nr_crt++;
                        continue;
                    }   
                    
                    // get product by reference
                    $product = $em->getRepository('AppBundle:Product')->findOneByReference($line[$reference_col]);          
                    
                    if(!$product){
                        continue;// nu avem acest acest produs in db
                    }                    

                    foreach($warehouses as $w){      
                        $col=array_search($w->getName(),$head_table);
                        if( $col && (int)$line[$col]!=0){                            
                            //cautam daca exista deja in ProductWarehouse o comibatie productId-warehouseId
                            $productWarehouse = $em->getRepository('AppBundle:ProductWarehouse')->findOneBy(array('product'=>$product,'warehouse'=>$w));                            
                            if($productWarehouse){ 
                                $productWarehouse->setQuantity($line[$col]);
                                $productWarehouse->setDatUpd($ktnow);
                            } else {
                                $productWarehouse = new ProductWarehouse();                                
                                $productWarehouse->setProduct($product);
                                $productWarehouse->setwarehouse($w);
                                $productWarehouse->setQuantity($line[$col]);
                                $productWarehouse->setDatCre($ktnow);                                
                                $productWarehouse->setDatUpd($ktnow);                                
                                $em->persist($productWarehouse);                                
                            }                       
 
                        } // end if                
                    } // end foreach
                }
            } 
            $em->flush();
            $em->clear();  
            //unlink($my_file);
        } else {
            $erori = 'Fisierul csv nu poate fi deschis!';          
        }         

        if ($erori){            
            return $erori;   
        }
    }
}
