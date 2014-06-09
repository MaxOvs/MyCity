<?php

namespace Stikair\Bundle\FormExtraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('StikairFormExtraBundle:Default:index.html.twig', array('name' => $name));
    }
}
