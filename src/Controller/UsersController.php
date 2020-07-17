<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="app_users")
     */
    public function index()
    {
        return $this->render('users/profile.html.twig');
    }

    /**
     * @Route("/users/profile/edit", name="app_users_profile_edit")
     */
    public function editProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('message', "profil mis à jour");
            return $this->redirectToRoute('app_users');
        }
        return $this->render('users/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
