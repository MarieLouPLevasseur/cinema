<?php

namespace App\Controller\Api;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 *  @Route("/api/v1_0/genres", name="api_v1_genres_")
 */
class GenreController extends AbstractController
{
    /**
     * list all genres
     * @Route("/", name="list", methods="GET")
     */
    public function list(GenreRepository $genreRepository) :Response
    {
        $allGenres = $genreRepository->findAll();
          

            // dd($genres);
        //sans la fonction
        // return $this->json($genres, 200, [], ['groups' => 'api_v1_genres_list']);

        return $this->prepareResponse(
            'OK',
            ['groups' => 'api_v1_genre_list'],
            ['data' => $allGenres]
        );
    }

   

    /**
     * liste les films d'un genre
     * @Route("/{id}/movies", name="movies", methods="GET")
     */
    public function listMovies($id, MovieRepository $movieRepository) :Response
    {
        // avec la requetes DQL
        $movieList = $movieRepository->findByGenre($id);
       
        return $this->prepareResponse(
            'OK',
            ['groups' => 'api_v1_movie_list'],
            ['data' => $movieList]
        );

        // avant la fonction 
        // return $this->json($genre, Response::HTTP_OK, [], ['groups' => 'api_v1_genres_list']); //200
    }

    /**
     * list all movies for given genre id
     *
     * GG Steve Isaac, Svitlana, Louise c'est TOPISSIME
     * @Route("/{id}/movies2", name="list_movies", methods="GET")
     * @return Response
     */
    public function listMovies2($id, GenreRepository $genreRepository) :Response
    {
        $genre = $genreRepository->find($id);
        if ($genre === null )
        {
            // si le genre n'existe pas on le signale à l'utilisateur
            return $this->prepareResponse(
                'No genre found for Id [' . $id . ']',
                [],
                [],
                true,
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->prepareResponse(
            'OK',
            ['groups' => 'api_v1_genre_list_movies'],
            ['data' => $genre]
        );
    }

   /**
     * Adds one genre
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
        $genre = $serializer->deserialize($data, Genre::class, 'json');


        // validation de l'objet grace au composant validator
        // qui va nous permettre de vérifier les contraintes définies au niveau de l'entité
        $errors = $validator->validate($genre);

        if (count($errors) > 0) {
            /*
            * Uses a __toString method on the $errors variable which is a
            * ConstraintViolationList object. This gives us a nice string
            * for debugging.
            */
            $errorsString = (string) $errors;

            return $this->prepareResponse($errorsString, [], [], true, Response::HTTP_BAD_REQUEST);
        }

        // on enregistre en BDD
        $em->persist($genre);
        $em->flush();

        return $this->prepareResponse('OK', [], [], false, Response::HTTP_CREATED );
    }



    
//    ! Rajouter les autres fonctions

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
