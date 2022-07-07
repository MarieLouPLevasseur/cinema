<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     *  Show list
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


     /**
     * Show list
     *
     * @Route("/list")
     * @return Response
     */
    public function list() :Response
    {
        // dump('controller');

        return $this->render('main/list.html.twig',[
            'title' =>'Liste des films',
        ]);

    }

     /**
     * Show One Movie
     *
     * @Route("/show")
     * @return Response
     */
    public function show() :Response
    {

        return $this->render('main/show.html.twig',[
            'title' =>'Film du jour',
        ]);

    }


    /**
     * Show Favorite
     *
     * @Route("/favorite")
     * @return Response
     */
    public function favorite() :Response
    {

        return $this->render('main/favorite.html.twig',[
            'title' =>'Films Favoris',
        ]);

    }

}