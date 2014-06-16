<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 15/06/14
 * Time: 22:12
 */

namespace JyAccede\Bundle\APIBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use JyAccede\Bundle\APIBundle\Tools\RESTClient;
use JyAccede\Bundle\APIBundle\Entity\StopPoint;


class FetchCommand extends ContainerAwareCommand {

    protected function configure(){
        $this->setName('canaltp:fetch')
        ->setDescription("Fetch objects from CanalTP API")
        ->addArgument("object",InputArgument::OPTIONAL,"What object to fetch?")
        ;
    }

    protected function execute(InputInterface $input,OutputInterface $output){
        $object=$input->getArgument("object");
        $doctrine=$this->getContainer()->get("doctrine");
        /* @var \Doctrine\Bundle\DoctrineBundle\Registry $doctrine */
        $em=$doctrine->getManager();
        $client=new RESTClient();
        $json=$client->get("coverage/paris/".$object);
        if($json==null)
        {
            $output->write("Api Did not return anything");
            return;
        }

        switch($object)
        {
            case "stop_points":
                $datas=json_decode($json);
                $objects=$datas->stop_points;
                foreach($objects as $stopP)
                {
                    $stop=new StopPoint();
                    $stop->setIdCanalTp($stopP->id);
                    $stop->setName($stopP->name);
                    $em->persist($stop);
                }
                $em->flush();
                break;
        }

    }
} 