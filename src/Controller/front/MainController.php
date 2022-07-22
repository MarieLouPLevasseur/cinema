<?php

namespace App\Controller\front;

use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{



    /**
     *  Show homepage
     *
     * @Route("/", name="homepage", methods="GET")
     * @return Response
     */
    public function homepage(MovieRepository $movieRepository) :Response
    {

        // préparer les données
        // ? récupérer les fichiers movies
        // pour se faire on peut inclure le fichier directement
        // require __DIR__ . '/../../sources/data.php';

        $shows = $movieRepository->findAll();
        $homepageShows = [];

        // on récupère que 2 éléments au hasard du tableau shows
        // spoiler normalement ce code on le rangerait dans une classe
        // array_rand 

        //tableau des films
        // $homepageShows = [];
        // ? méthode 1 : par sélection aléatoire de deux clés du tableau
        $randomIndexes = array_rand($shows, 2);

        // permet de récupérer l'index d'un des films aléatoire et d'y stocker les valeurs dans le tableau
        // random a été défini à 2 index donc le tableau contiendra 2 films
        foreach ($randomIndexes as $currentRandomIndex)
        {
            $homepageShows[$currentRandomIndex] = $shows[$currentRandomIndex];
        }

        // ? méhode 2: découpe précise du tableau


        dump($homepageShows);


        // return new Response('<h1>Homepage</h1>');
        return $this->render('front/main/homepage.html.twig',[
            'title' =>'Homepage',
            'show_list' => $homepageShows

        ]);

    }


}