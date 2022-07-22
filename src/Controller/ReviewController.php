<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
     * @Route("/review/", name="review_")
     */
class ReviewController extends AbstractController
{
   /**
     *Ajout d'une critique sur un film ciblé par son ID
     * 
     * @Route("add/film/{id}", name="add", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function formReview(Request $request, EntityManagerInterface $em, int $id)
    {
        $review = new Review();

        // Affecter un USER aléatoire à transmettre à review 
        $allUsers = $em->getRepository(User::class)->findAll();
        $randUserIdx = mt_rand(0, sizeof($allUsers) - 1);
        $randomUser = $allUsers[$randUserIdx];

        //  récupérer le film ciblé pour lui ajouter une review
        $movieObj= $em->getRepository(Movie::class)->find($id);

        // $movieObj->addReview($review);
        // ! n'arrive pas à prendre la valeur de l'objet movie:
        // Unable to transform value for property path "movie": Expected a numeric.


        $review->setMovie($movieObj);
        $review->setUser($randomUser);


        $form = $this->createForm(ReviewType::class, $review);
            // 'action' => $this->generateUrl('review_add'),
            // 'method' => 'GET',
        

        
        
        // $form ->add("movie_id", NumberType::class);
        // $form ->add("user_id" , NumberType::class);


        // $form ->getForm();

        // ! code transmi comme salvateur mais pas trouvé comment l'utiliser
        // add('movie', NumberType::class);
        
        $form->handleRequest($request);
        // dd($movieObj);

     
        if ($form->isSubmitted()) // && $form->isValid())
        {

            // $task = $form->getData()    ???

            $movieObj->addReview($review);
            $review->setMovie($movieObj);
            $review->setUser($randomUser);

            $em->persist($movieObj);
            $em->persist($review);
            // $em->flush();

            // lorsque l'on fait une redirection 
            // il est bon d'afficher un message pour dire que le travail a été effectué
            $this->addFlash('success', 'Critique prise en compte');

            // après un traitement de formulaire on effectue une redirection
            return $this->redirectToRoute('movie_list');
        }

        return $this->render('/form/review.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}