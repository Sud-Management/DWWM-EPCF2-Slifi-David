<?php

namespace App\Controller;

use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{

#[Route('/profile', name: 'app_profile')]
public function edit(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
{
    /** @var \App\Entity\User $user */
    $user = $this->getUser();
    $form = $this->createForm(ProfileFormType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $plainPassword = $form->get('plainPassword')->getData();

        if ($plainPassword) {
            $hashedPassword = $hasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);
        }

        $em->flush();

        $this->addFlash('success', 'Profil mis à jour avec succès.');
        return $this->redirectToRoute('app_profile');
    }

    return $this->render('profile/index.html.twig', [
        'form' => $form->createView(),
    ]);
}
}