<?php

namespace App\Controller\Api;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Undocumented class
 *  @Route("/api/v1_0/movies", name="api_v1_movies_")
 */
class MovieController extends AbstractController
{
    /**
     * list all movies
     *
     * @Route("/", name="list", methods="GET")
     * @return Response
     */
    public function list(MovieRepository $movieRepository) :Response
    {
        // récupérer tous les movies
        $allMovies = $movieRepository->findAll();

                // dd($allMovies);


                return $this->json($allMovies, 200, [], ['groups' => 'api_v1_movie_list']);
    }

    /**
     * show a movie
     *
     * @Route("/{id}", name="show", methods="GET", requirements={"id"="\d+"})
     * @return Response
     */
    public function show(int $id, MovieRepository $movieRepository) :Response
    {
        // comme le ParamConverter renvoit une Erreur 404 par défaut et qui n'est pas du json,
        // on se passe de ses services
        // et on fait le travail à la main !
        $movie = $movieRepository->find($id);
        if ($movie === null )
        {
        // TODO mofidier avec la fonction les messages d'erreurs

        // si le movie n'existe pas on le signale à l'utilisateur
            $error = [
                'error' => true,
                'message' => 'No movie found for Id [' . $id . ']'
            ];

            return $this->json($error, Response::HTTP_NOT_FOUND); // page 404
        }
        return $this->json($movie, Response::HTTP_OK, [], ['groups' => 'api_v1_movie_show']); //200
    }

     /**
     * delete a movie
     *
     * @Route("/{id<\d+>}", name="delete", methods="DELETE")
     * 
     */
    public function delete($id, EntityManagerInterface $em, MovieRepository $movieRepository) :Response
    {
        // TODO a tester
        // comme le ParamConverter renvoit une Erreur 404 par défaut et qui n'est pas du json,
        // on se passe de ses services
        // et on fait le travail à la main !
        $movie = $movieRepository->find($id);
        if (is_null($movie))
            {

            // si le movie n'existe pas on le signale à l'utilisateur
            return $this->prepareResponse(
                'No movie found for Id [' . $id . ']',
                [],
                [],
                true,
                Response::HTTP_NOT_FOUND // page 404
            ); 
            }

        // si ce n'est pas une erreur on supprime l'objet en BDD

        // Effectuer la suppression + renvoyer une réponse de confirmation 
        $em->remove($movie);

        $em->flush();

        // renvoyer un json pour dire que tout s'est bien passé
        $message = [
            'error' => false,
            'message' => 'Movie supprimé avec succès',
        ];

        // utilise la fonction pour les message
        return $this->prepareResponse('Movie [' . $id . '] deleted');

    }

    /**
     * select a random movie
     *
     * @Route("/random", name="random", methods="GET")
     * @return Response
     */
    public function random(MovieRepository $movieRepository) :Response
    {
        // récupérer tous les movies
        $allMovies = $movieRepository->findAll();

        $movieKeyRandom = (array_rand($allMovies));
        $movieRandom = $allMovies[$movieKeyRandom];

        // $movieRandom = $allMovies(array_rand($allMovies));
       

        return $this->json($movieRandom, 200, [], ['groups' => 'api_v1_movie_show']);
    }

     /**
     * add a movie
     *
     * @Route("/", name="add", methods="POST")
     * 
     */
    public function add(MovieRepository $movieRepository, Request $request) 
    {
        // récupérer les données fournies

        $jsonData = json_decode($request->getContent(), true);


        dump($jsonData);
        dump("TODO: Vous avez tenté d'ajouter un objet movie: la route n'est pas finie");
        // TODO effectuer l'ajout en BDD, renvoyer une réponse de confirmation et faire une redirection
    }

    /**
     * gestion des messages d'erreurs
     * @param string $message
     * @param array $options
     * @param array $data  liste des objets concernés
     * @param boolean $isError
     * @param int $httpCode
     * @param array $headers 
     */
    private function prepareResponse(
        string $message, 
        array $options = [], 
        array $data = [], 
        bool $isError = false, 
        int $httpCode = 200, 
        array $headers = []
    )
    {
        $responseData = [
            'error' => $isError,
            'message' => $message,
        ];
        foreach ($data as $key => $value)
        {
            $responseData[$key] = $value;
        }
        return $this->json($responseData, $httpCode, $headers, $options);
    }

    
}