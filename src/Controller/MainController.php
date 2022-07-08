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
     * Show movie list 
     *
     * @Route("/list")
     * @return Response
     */
    public function list() :Response
    {
        // récupérer la liste des films
        //inclure la page source ou le fichier directement
        require __DIR__ . '/../../sources/data.php';

        // dump($shows);


        return $this->render('main/list.html.twig',[
            'title' =>'Liste des films et séries',
            'show_list' => $shows,

        ]);

    }

    // @Route("/film/{id}", requirements={"id"="d*"})

     /**
     * Show One Movie
     * @Route("/film/{id}", requirements={"id"="\d+"})
     *
     * @param int $id
     * @return Response
     */
    public function movie($id) :Response
    {

        dump($id);
        // $data = $this->getData('contact');
        // dump($data);

        return $this->render('main/movie.html.twig',[
            'title' =>'Film du jour',
        ]);

    }


    /**
     * Show Favorite
     *
     * @Route("/favoris")
     * @return Response
     */
    public function favorite() :Response
    {

        return $this->render('main/favorite.html.twig',[
            'title' =>'Films Favoris',
        ]);

    }

}