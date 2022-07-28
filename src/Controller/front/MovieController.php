<?php

namespace App\Controller\front;

use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Utils\TimeConverter;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;



/**
* @Route("/films", name="movie_")
*/
class MovieController extends AbstractController
{

   

  /**
     * list all movies action
     *
     * @Route("", name="list", methods={"GET"})
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


        return $this->render('front/movie/list.html.twig',[
            'title' =>'Liste des films et séries',
            'show_list' => $shows,

        ]);

    }

    // @Route("/{id}", requirements={"id"="\d+"})

     /**
     * Show One Movie
     * @Route("/{slug}",name="show", methods="GET")
     * @param int $id
     * @return Response
     */
    public function show(Movie $show, MovieRepository $movieRepository, TimeConverter $timeConverter) :Response
    {

        // if($show->getSlug() !== $slug) {
        //     return $this->redirectToRoute('category_show', [
        //         'id' => $id,
        //         'slug' => $show->getSlug()
        //     ]);
        // }


        //  préparer les données

        // Avec le ParamConverter, l'id offset est géré automatiquement
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

        return $this->render('front/movie/movie.html.twig',[
            'title' =>'Film du jour',
            'show' => $show,
            'duration_in_minutes' => $timeConverter->convert($show->getDuration())

        ]);

    }

   


   /**
     * add a review
     *
     * @Route("/{id<\d+>}/critiques/ajout", name="review_add", methods={"GET", "POST"})
     * @return Response
     */
    public function reviewAdd(
        EntityManagerInterface $em, 
        Movie $movie, 
        Request $request
    ) :Response   
    {

        $review = new Review();

        // comme on connait déjà le film on le fixe:
        $review->setMovie($movie);
        
        $form = $this->createForm(ReviewType::class, $review);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

         // ? Traiter le formulaire
            // entitymanager ( cf paramètre merci ParamConverter)
            // persist
            $em->persist($review);

            //flush
            $em->flush();

            // ? Ajouter un flash message
            $this->addFlash('success', 'critique ajoutée');

            // ? Rediriger l'utilisateur
            return $this->redirectToRoute('movie_show', ['id' => $movie->getId()]);



            //lors des tests
            // dd($form->getData());



        }

        return $this->render('front/movie/review_add.html.twig', [
            'form' => $form->createView(),
            'movie' => $movie,

        ]);
    }


}
