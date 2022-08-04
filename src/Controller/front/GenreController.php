<?php

namespace App\Controller\front;

use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Utils\TimeConverter;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
* @Route("/front/genre", name="front_genre_")
*/
class GenreController extends AbstractController
{

    //  /**
    //     * list all genre
    //     *
    //     * @Route("/", name="list", methods="GET")
    //     * @return Response
    //     */
    //     public function list(GenreRepository $genreRepository): Response
    //     {
    //         $genres = $genreRepository->findall();


           
    //         return $this->render('base.html.twig',[
    //             'genre_list' => $genres,
    
    //         ]);
    //     }

    /**
        * list all movies for given genre id
        *
        * @Route("/{id}/movies", name="movies_list", methods="GET")
        * @return Response
        */
    public function listMovies($id, GenreRepository $genreRepository): Response
    {
        $genres = $genreRepository->find($id);
       
        return $this->render('front/genre/movies_list.html.twig',[
            'genre_list' => $genres,

        ]);
    }
}