<?php

namespace App\Controller\back;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/review", name= "back_review_")
 */
class ReviewController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ReviewRepository $reviewRepository): Response
    {
        return $this->render('back/review/index.html.twig', [
            'reviews' => $reviewRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, ReviewRepository $reviewRepository): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reviewRepository->add($review, true);

            $this->addFlash('success', "la critique a bien été ajoutée");

            return $this->redirectToRoute('back_review_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/review/add.html.twig', [
            'review' => $review,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"},  requirements={"id"="\d+"})
     */
    public function read(Review $review): Response
    {
        return $this->render('back/review/read.html.twig', [
            'review' => $review,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"},  requirements={"id"="\d+"})
     */
    public function edit(Request $request, Review $review, ReviewRepository $reviewRepository): Response
    {
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reviewRepository->add($review, true);

            $this->addFlash('success', "La critituqe a bien été modifiée");

            return $this->redirectToRoute('back_review_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/review/edit.html.twig', [
            'review' => $review,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"},  requirements={"id"="\d+"})
     */
    public function delete(Request $request, Review $review, ReviewRepository $reviewRepository): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            $reviewRepository->remove($review, true);

            $this->addFlash('success', "La critique a bien été supprimée");

        // }

        return $this->redirectToRoute('back_review_index', [], Response::HTTP_SEE_OTHER);
    }
}
