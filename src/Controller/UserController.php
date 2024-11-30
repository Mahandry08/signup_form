<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    #[Route('/user', name: 'app_user')]
    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Inscription réussie !');
                return $this->redirectToRoute('app_user'); // Ajustez le nom de la route ici
            }else{
                $this->addFlash('error', 'Il y a des erreurs dans les champs !');
                return $this->redirectToRoute('app_user');
            }
            
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
