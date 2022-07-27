<?php

namespace App\Controller\back;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/back/user", name="back_user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('back/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(
        Request $request,
         UserRepository $userRepository,
         UserPasswordHasherInterface $passwordHasher
         ): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // enregistrement du MDP par défaut avec devinci sans enregistrement manuel
            // $password = $passwordHasher->hashPassword($user, "devinci");

            // hachage MDP avant de le passé en BDD
            $password = $passwordHasher->hashPassword($user, $user->getPassword());
            $user ->setPassword($password);

            // cette méthode persist et flush
            $userRepository->add($user, true);


            $this->addFlash('success', "L'utilisateur a bien été ajouté");

            return $this->redirectToRoute('back_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/user/add.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"},  requirements={"id"="\d+"})
     */
    public function read(User $user): Response
    {
        return $this->render('back/user/read.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"},  requirements={"id"="\d+"})
     */
    public function edit(
        Request $request,
        Security $security,
        User $user,
        UserRepository $userRepository): Response
    {
        // retire le droit utilisateur à manager
        $this->denyAccessUnlessGranted('ROLE_MANAGER');

        // @isGranted("ROLE_")dans les annotations avec le bon USE

        // ! cette ligne permet de remplacer l'ensemble du bloc plus bas dans les voter
        // $this->denyAccessUnlessGranted('USER_UPDATE', $user);

        // **********BLOCK de remplacement coller dans le VOTER **************
        // si le user a modifier a le role Manager ou Admin
        // et que l'utilisateur connecté à le Role Manager
            // alors on limite l'accès
    // TODO a corriger car la route security Yaml ne permet pas non plus la modif des users correctement
        // if ($user->getRole() === 'ROLE_ADMIN' || $user->getRole() === 'ROLE_MANAGER')
        // {

        //         // et que l'utilisateur connecté a le role Manager
        //         if (in_array('ROLE_MANAGER', $security->getUser()->getRoles()))
        //         {
        //             // alors on limite l'accès
        //             throw $this->createAccessDeniedException('Les managers ne peuvent modifier que des utilisateurs');
        //         }

        //     // alors on limite l'accès
        //     throw $this->createAccessDeniedException();

        // }
        // ********************************************************************

        $form = $this->createForm(UserType::class, $user);

        // permet de retirer le champs mot de passe que pour l'édition
        $form->remove('password');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // inutile car l'accès 
            // $password = $passwordHasher->hashPassword($user, $user->getPassword());
            // $user ->setPassword($password);


            $userRepository->add($user, true);

            $this->addFlash('success', "L'utilisateur a bien été modifié");

            return $this->redirectToRoute('back_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    // ! route a modifier, chez greg  route /{id} avec méthode POST: modifier les tests par la suite
    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"},  requirements={"id"="\d+"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);

            $this->addFlash('success', "L'utilisateur a bien été supprimé");

        // }

        return $this->redirectToRoute('back_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
