<?php

namespace App\Controller\back;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Utils\MySlugger;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/back/movie", name= "back_movie_")
 */
class MovieController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('back/movie/index.html.twig', [
            'movies' => $movieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(
        Request $request,
        MovieRepository $movieRepository,
        MySlugger $mySlugger
        ): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // le titre sera sluggifier avec un ecouteur d'évenement
            // on slugify le titre fournit par le user avant de l'enregistrer en BDD
            // $movie->setSlug($mySlugger->slugify($movie->getTitle()));

            $movieRepository->add($movie, true);

            $this->addFlash('success', 'Le Movie a bien été ajouté');

            return $this->redirectToRoute('back_movie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/movie/add.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"},  requirements={"id"="\d+"})
     */
    public function read(Movie $movie): Response
    {
        return $this->render('back/movie/read.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        Movie $movie,
        MovieRepository $movieRepository,
        MySlugger $mySlugger
        ): Response
    {
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // le titre sera sluggifier avec un ecouteur d'évenement
        // on slugify le titre fournit par le user avant de l'enregistrer en BDD
        // $movie->setSlug($mySlugger->slugify($movie->getTitle()));

            $movieRepository->add($movie, true);

            $this->addFlash('success', 'Le Movie a bien été modifié');

            return $this->redirectToRoute('back_movie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/movie/edit.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Request $request, Movie $movie, MovieRepository $movieRepository): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->request->get('_token'))) {
            $movieRepository->remove($movie, true);
        // }
        $this->addFlash('success', 'Le Movie a bien été supprimé');

        return $this->redirectToRoute('back_movie_index', [], Response::HTTP_SEE_OTHER);
    }
}
