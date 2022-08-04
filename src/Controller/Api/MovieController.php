<?php

namespace App\Controller\Api;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
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
     * Adds one movie
     *
     * @Route("", name="add", methods="POST")
     * @return Response
     */
    public function add(
        EntityManagerInterface $em, 
        Request $request, 
        SerializerInterface $serializer,
        ValidatorInterface $validator
        )
    {
        // pour récupérer le json on utilise getContent
        // https://symfony.com/doc/current/components/http_foundation.html#accessing-request-data
        $data = $request->getContent();

        // on créé un objet à partir du json
        // https://symfony.com/doc/current/components/serializer.html#deserializing-an-object
        $movie = $serializer->deserialize($data, Movie::class, 'json');

        // validation de l'objet grace au composant validator
        // qui va nous permettre de vérifier les contraintes définies au niveau de l'entité
        $errors = $validator->validate($movie);

        // todo générer un message d'erreur plus joli
        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->prepareResponse($errorsString, [], [], true, Response::HTTP_BAD_REQUEST);
        }

        // on enregistre en BDD
        $em->persist($movie);
        $em->flush();

        return $this->prepareResponse('Created', [], [], false, Response::HTTP_CREATED );
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