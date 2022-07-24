<?php

namespace App\Controller\back;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
* @Route("/back", name="back_")
*/
class MainController extends AbstractController
{
   /**
     * homepage backoffice
     *
     * @Route("/", name="homepage", methods="GET")
     * @return Response
     */
    public function homepage(ManagerRegistry $doctrine) :Response
    {
        // récupérer tous les movies
        // require __DIR__ . '/../../sources/data.php';

       

        return $this->render('back/homepage.html.twig',[
            'title' =>'Homepage_backoffice',

        ]);    }
}