<?php

namespace App\Controller\front;

use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * @Route("handleSearch", name="handleSearch")
 */
class SearchController extends AbstractController
{


    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot-clé',
                    // ! le not blank ne fonctionne pas comme il devrait
                    'NotBlank' => NotBlank::class,
                    'NotNull' => NotNull::class,
                    
                ]
            ])
            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
        return $this->render('front/search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * handlesearch for a movie
     * 
     * @Route("", name="")
     * @param Request $request
     */
    public function handleSearch(Request $request, MovieRepository $movieRepository): Response
    {

        // dd($request);
        $query = $request->request->get('form')['query'];
        if($query) {
            $movies = $movieRepository->findMoviesByName($query);
        }

        return $this->render('front/search/searchResult.html.twig', [
            'movies' => $movies,
        ]);
    }
}
