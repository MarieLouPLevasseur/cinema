<?php

namespace App\Controller\Api;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *  @Route("/api/v1_0/genres", name="api_v1_genres_")
 */
class GenreController extends AbstractController
{
    /**
     * @Route("/", name="list", methods="GET")
     */
    public function list(EntityManagerInterface $entityManager): Response
    {
        $genres = $entityManager
            ->getRepository(Genre::class)
            ->findAll();

            // dd($genres);
        return $this->json($genres, 200, [], ['groups' => 'group_genre']);

    }

   

    /**
     * @Route("/{id}/movies", name="movies", methods="GET")
     */
    public function show(int $id, GenreRepository $genreRepository) :Response
    {

        $genre = $genreRepository->find($id);
        if ($genre === null )
        {

        // si le genre n'existe pas on le signale à l'utilisateur
            $error = [
                'error' => true,
                'message' => 'No Genre found for Id [' . $id . ']'
            ];

            return $this->json($error, Response::HTTP_NOT_FOUND); // page 404
        }
        // ! TODO ne fonctionne pas les groupes ne sont pas bons, à revoir
        return $this->json($genre, Response::HTTP_OK, [], ['groups' => 'movie_genre','api_v1_movie_list']); //200
    }

   


}
