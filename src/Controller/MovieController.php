<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Utils\TimeConverter;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieController extends AbstractController
{

    /**
     * Show Favorite movies
     *
    * @Route("/favoris/add/{id}",name="movie_favorites_add", requirements={"id"="\d+"}, methods="GET")
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
     * @Route("/favoris", name="movie_favorites", methods="GET")
     * @return Response
     */
    public function favorites(MovieRepository $movieRepository, Request $request) :Response
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
        return $this->render('movie/favorite.html.twig',[
            'title' =>'Mes Favoris',
            'show_list' => $favoriteShows,

        ]);

    }

   /**
     * Show movie list 
     *
     * @Route("/", name="homepage", methods="GET")
     * @return Response
     */
    public function list(MovieRepository $movieRepository) :Response
    {
        // récupérer la liste des films
        //inclure la page source ou le fichier directement
        // on ne veut plus les données en dur:
        // require __DIR__ . '/../../sources/data.php';

        // ? différentes méthodes de récupe de donné pour faire des tris
        // ? les méthodes sont personnelles, pas de supériorités, tout dépendant de ce qu'on souhaite faire
        // récupère tous les films tels qu'ils sont entrée en BDD
         // $shows = $movieRepository->findAll();

        //  une méthode peut consister a le faire directement dans la vue twig

        // permet de trier les film par ordre décroissant selon le titre (prévu par symfo)
        //   $shows = $movieRepository->findBy([], ['title' => 'DESC']);

        // utiliser une custom query (mis dans repository SQL)
        //   $shows = $movieRepository->findByOrderedByTitleAsc();

        // utiliser le QueryBuilder (DQL) avec des sélects:
          $shows = $movieRepository->findByOrderedByTitleAscQB();


        // dump($shows);


        return $this->render('movie/list.html.twig',[
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
    public function show(Movie $show, MovieRepository $movieRepository, TimeConverter $timeConverter) :Response
    {
        //  préparer les données
        // TODO ce serait mieux d'avoir une classe qui récupère un film par ID
         // pour se faire on peut inclure le fichier directement
        //  require __DIR__ . '/../../sources/data.php';

        //  dump($id);

         //si l'id n'existe pas on arrete le script
        //  if (! isset($shows[$id]))
        //  {
        //      // on donne le code d'erreur 
        //      // le throw permet de respecter le flow de symfony et faire un try catch
        //     //  try>throw>catch
        //      // permet de pouvoir exécuter du code malgré l'erreur 
        //      // et de garder une 404: page non trouvé en environnement de prod
        //      throw $this->createNotFoundException('The product does not exist');

        //  }


         //sinon on continue le script

        // $show = $shows[$id];
    // dump($show);

    // on créer un objet TimeConvert et on appel sa méthode
    // $timeConverter = new TimeConverter();
    // dump($timeConverter->convert($show['duration']));
    // avoir la durée au format xxhyym

    // nouvelle requete pour optimiser performance de la récup des datas (issus des jointures)
    $movie = $movieRepository->findForShow($show->getId());

 
        // fournir les infos à la vue

        return $this->render('movie/movie.html.twig',[
            'title' =>'Film du jour',
            'show' => $show,
            'duration_in_minutes' => $timeConverter->convert($show->getDuration())

        ]);

    }

    
}
