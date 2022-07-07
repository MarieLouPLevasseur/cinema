<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * homepage action
     *
     * @Route("/")
     * @return Response
     */
    public function homepage() :Response
    {
        // return new Response('<h1>Homepage</h1>');
        return $this->render('main/homepage.html.twig',[
            'title' =>'Homepage',
        ]);

    }

}