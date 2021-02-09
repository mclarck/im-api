<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     * @param Request $req
     * @return Response
     */
    public function index(Request $req): Response
    {
        return new Response("inmarketify");
    }

    /**
     * @Route("/market/{_locale}/{company}/{path}",requirements={"path"=".+","_locale": "en|es|fr|pt"})
     * @param Request $req
     * @return Response
     */
    public function market(Request $req): Response
    {
        return $this->render('market/market.html.twig',[]);
    }
}
