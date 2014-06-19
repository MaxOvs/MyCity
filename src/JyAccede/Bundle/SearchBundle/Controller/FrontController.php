<?php

namespace JyAccede\Bundle\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    public function searchAction(Request $request)
    {
        $city=false;
        if($request->isMethod("POST"))
        {
            $city=$request->request->get("city");
        }

        return $this->render('JyAccedeSearchBundle:Front:search.html.twig',array("ville"=>$city));
    }
}
