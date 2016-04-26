<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductWarehouse;
use AppBundle\Entity\Warehouse;

class KtapUpdStockCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ktap:updstock')
            ->setDescription('Udpate stocks.')
           
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $my_file = 'tmpdata/stoc.csv';//local
        
        $erori = '';
        
        $erori = $this->getContainer()->get('ktap.synch')->updateStocks($my_file); 
        
        if ($erori){
            $date=new \DateTime();
            echo $date->format('Y-m-d H:i:s').' '.$erori."\n";   
        }  

    }
}