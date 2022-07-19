<?php

namespace App\Controller;

use App\Entity\Movie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
   /**
     * list all movies
     *
     * @Route("/api/movies", name="api_list", methods="GET")
     * @return Response
     */
    public function apiList(ManagerRegistry $doctrine) :Response
    {
        // récupérer tous les movies
        // require __DIR__ . '/../../sources/data.php';

        $movieRepository = $doctrine->getRepository(Movie::class);
        $shows = $movieRepository->findAll();

        return $this->json($shows);
    }
}
