<?php

namespace App\Controller\front;

use App\Entity\Movie;
use App\Utils\TimeConverter;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/front/favoris", name="front_favoris_")
 */
class FavoriteController extends AbstractController
{

    /**
     * Show Favorite movies
     *
    * @Route("{id}",name="add", requirements={"id"="\d+"}, methods="GET")
     * @return Response
     */
    public function favorites_add(int $id, Request $request) :Response
    {
        //par soucis de facilité on stock session dans une variable
        $session = $request->getSession();

        //on doit remplir un tableau avec les infos du film stocké par la session automatiquement
            // la clé est nommé comme on le souhaite 
            // sera classé dans un tableau (pour l'instant vide)
        $showIdFavorites = $session->get('show_id_favorites', []);
        // soit il y a qqch et affiche info
            //soit tableau vide et il n'affichera rien
        // on récupère donc ce qui existe

        // on lui dit de remettre en session chaque nouve
        $showIdFavorites[$id] = $id;

        //on le conserve en session
        $session->set('show_id_favorites', $showIdFavorites);


        // ! ces données seront utiliser dans méthode "favorite" pour les transmettres à la vue
        // ! cette méthode ne sert qu'a créer le tableau de session et stocker les variables favorites
        // on ajoute une alerte pour dire que c'est bien ajouté en favoris
            // success est une clé (dans la boucle nous servira à faire l'affichage que des flash ou warning ou danger (error), etc)
            // cette "clé" sera utilisé comme "classe" avec l'utilisation du label (voir le template)
            // cette classe peut etre autre que bootstrap
        $this->addFlash('success', "Film ajouté aux favoris");

        // on redirige l'utilisateur sur la page des favoris
        return $this->redirectToRoute('movie_favorites');

    }


    /**
     * Show Favorite movies
     *
     * @Route("/", name="list", methods="GET")
     * @return Response
     */
    public function list(MovieRepository $movieRepository, Request $request) :Response
    {

        // on démarre une session 
        // session_start();
        // dump($_SESSION);
        
        // ! c'est ici qu'on récupère les movies favorites via la request 
        // récupération des id de favorite movies depuis la session
            //récup session
        $session = $request->getSession();
            //récup du tableau favoris de la sessions
        $showIdFavorites = $session->get('show_id_favorites', []);
        // on place nos données
        // require __DIR__ . '/../../sources/data.php';

        $favoriteShows = $movieRepository->findBy([
            "id" => $showIdFavorites, 
        ]);

        // tableau pour le stockage des films validés: 
        // $favoriteShows = [];

        // on parcours le tableau des films favoris de la session
            // foreach ($showIdFavorites as $currentShowId)
            // {
            //     // si le film existe on le met dans le tableau de nos favoris
            //     if (isset($shows[$currentShowId]))
            //     {
            //         $favoriteShows[$currentShowId] = $shows[$currentShowId];
            //     }
            // }
        // on fournit le tableau à la vue pour dynamiser le template
        return $this->render('front/movie/favorite.html.twig',[
            'title' =>'Mes Favoris',
            'show_list' => $favoriteShows,

        ]);

    }

     /**
     * delete a Favorite movies
     *
     * @Route("/delete/One", name="delete", methods="GET")
     * @return Response
     */
    public function deleteOneFavorite(MovieRepository $movieRepository, Request $request) :Response
    {

        // on démarre une session 
        // session_start();
        // dump($_SESSION);
        
        // ! c'est ici qu'on récupère les movies favorites via la request 
        // récupération des id de favorite movies depuis la session
            //récup session
        $session = $request->getSession();
        // TODO récupération de l'id du film séléectionné: ne veut pas de l'id en requirement : 

        // [Semantical Error] Couldn't find constant requirements, method App\Controller\front\FavoriteController::deleteOneFavorite() in /var/www/html/symfony/symfo-oflix-MarieLouPLevasseur/config/routes/../../src/Controller/ (which is being imported from "/var/www/html/symfony/symfo-oflix-MarieLouPLevasseur/config/routes/annotations.yaml"). Make sure to use PHP 8+ or that annotations are installed and enabled.
        // à revoir

        dd($session);
        // TODO suppression du film sélectionné

        // TODO ajout des messages addflash de confirmation de suppression
        $this->addFlash('success', "Film supprimé des favoris avec succès ");

        // TODO redirection vers la page des favoris

        // on redirige l'utilisateur sur la page des favoris
        return $this->redirectToRoute('front_favoris_list');

        // $showIdFavorites = $session->get('show_id_favorites', []);
       
        // $favoriteShows = $movieRepository->findBy([
        //     "id" => $showIdFavorites, 
        // ]);

        // tableau pour le stockage des films validés: 
        // $favoriteShows = [];

        // on parcours le tableau des films favoris de la session
            // foreach ($showIdFavorites as $currentShowId)
            // {
            //     // si le film existe on le met dans le tableau de nos favoris
            //     if (isset($shows[$currentShowId]))
            //     {
            //         $favoriteShows[$currentShowId] = $shows[$currentShowId];
            //     }
            // }
        // on fournit le tableau à la vue pour dynamiser le template
        // return $this->render('front/movie/favorite.html.twig',[
        //     'title' =>'Mes Favoris',
        //     'show_list' => $favoriteShows,

        // ]);

    }
   

    
}
