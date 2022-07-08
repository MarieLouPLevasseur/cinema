<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
   /**
     * list all movies
     *
     * @Route("/api/movies", name="api_list", methods="GET")
     * @return Response
     */
    public function apiList() :Response
    {
        // récupérer tous les movies
        require __DIR__ . '/../../sources/data.php';

        return $this->json($shows);
    }
}
