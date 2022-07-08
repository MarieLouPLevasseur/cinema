<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     *  Show homepage
     *
     * @Route("/", name="homepage", methods="GET")
     * @return Response
     */
    public function homepage() :Response
    {

        // préparer les données
        // ? récupérer les fichiers movies
        // pour se faire on peut inclure le fichier directement
        require __DIR__ . '/../../sources/data.php';
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
        return $this->render('main/homepage.html.twig',[
            'title' =>'Homepage',
            'show_list' => $homepageShows

        ]);

    }


     /**
     * Show movie list 
     *
     * @Route("/list", name="movie_list", methods="GET")
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

    // @Route("/film/{id}", requirements={"id"="\d+"})

     /**
     * Show One Movie
     * @Route("/film/{id}",name="movie_show", requirements={"id"="\d+"}, methods="GET")
     *
     * @param int $id
     * @return Response
     */
    public function movie(int $id) :Response
    {
        //  préparer les données
        // TODO ce serait mieux d'avoir une classe qui récupère un film par ID
         // pour se faire on peut inclure le fichier directement
         require __DIR__ . '/../../sources/data.php';

         dump($id);

         //si l'id n'existe pas on arrete le script
         if (! isset($shows[$id]))
         {
             // on donne le code d'erreur 
             // le throw permet de respecter le flow de symfony et faire un try catch
            //  try>throw>catch
             // permet de pouvoir exécuter du code malgré l'erreur 
             // et de garder une 404: page non trouvé en environnement de prod
             throw $this->createNotFoundException('The product does not exist');

         }


         //sinon on continue le script

        $show = $shows[$id];
    // dump($show);

        // fournir les infos à la vue

        return $this->render('main/movie.html.twig',[
            'title' =>'Film du jour',
            'show' => $show,

        ]);

    }


    /**
     * Show Favorite
     *
     * @Route("/favoris", name="movie_favorites", methods="GET")
     * @return Response
     */
    public function favorite() :Response
    {

        return $this->render('main/favorite.html.twig',[
            'title' =>'Films Favoris',
        ]);

    }

}