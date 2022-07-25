<?php

namespace App\Controller\back;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("back/person", name="back_person_")
 */
class PersonController extends AbstractController
{
    /**
     * @Route("/index", name="index", methods={"GET"})
     */
    public function index(PersonRepository $personRepository): Response
    {
        return $this->render('back/person/index.html.twig', [
            'people' => $personRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, PersonRepository $personRepository): Response
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personRepository->add($person, true);

            $this->addFlash('success', "l'acteur a bien été ajouté");


            return $this->redirectToRoute('back_person_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/person/new.html.twig', [
            'person' => $person,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"},  requirements={"id"="\d+"})
     */
    public function read(Person $person): Response
    {
        return $this->render('back/person/read.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"},  requirements={"id"="\d+"})
     */
    public function edit(Request $request, Person $person, PersonRepository $personRepository): Response
    {
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personRepository->add($person, true);

            $this->addFlash('success', "l'acteur a bien été modifié");

            return $this->redirectToRoute('back_person_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/person/edit.html.twig', [
            'person' => $person,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"},  requirements={"id"="\d+"})
     */
    public function delete(Request $request, Person $person, PersonRepository $personRepository): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$person->getId(), $request->request->get('_token'))) {
            $personRepository->remove($person, true);

            $this->addFlash('success', "l'acteur a bien été supprimé");

        // }

        return $this->redirectToRoute('back_person_index', [], Response::HTTP_SEE_OTHER);
    }
}
