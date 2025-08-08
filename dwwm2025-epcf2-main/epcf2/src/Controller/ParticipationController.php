<?php
// src/Controller/ParticipationController.php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Participation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participation')]
class ParticipationController extends AbstractController
{
    #[Route('/demande/{id}', name: 'participation_demande', methods: ['POST'])]
    public function demander(Evenement $evenement, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifie si déjà demandé
        $exist = $em->getRepository(Participation::class)->findOneBy([
            'utilisateur' => $user,
            'evenement' => $evenement
        ]);

        if ($exist) {
            $this->addFlash('warning', 'Vous avez déjà demandé à participer à cet événement.');
            return $this->redirectToRoute('evenement_show', ['id' => $evenement->getId()]);
        }

        $participation = new Participation();
        $participation->setUtilisateur($user);
        $participation->setEvenement($evenement);
        $participation->setStatut('en attente');
        $participation->setDateParticipation(new \DateTime());

        $em->persist($participation);
        $em->flush();

        $this->addFlash('success', 'Demande de participation envoyée.');
        return $this->redirectToRoute('evenement_show', ['id' => $evenement->getId()]);
    }

    #[Route('/accepter/{id}', name: 'participation_accepter', methods: ['POST'])]
    public function accepter(Participation $participation, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $evenement = $participation->getEvenement();

        if ($user !== $evenement->getOrganisateur() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        $participation->setStatut('acceptee');
        $em->flush();

        $this->addFlash('success', 'Participation acceptée.');
        return $this->redirectToRoute('evenement_show', ['id' => $evenement->getId()]);
    }

    #[Route('/refuser/{id}', name: 'participation_refuser', methods: ['POST'])]
    public function refuser(Participation $participation, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $evenement = $participation->getEvenement();

        if ($user !== $evenement->getOrganisateur() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        $participation->setStatut('refusee');
        $em->flush();

        $this->addFlash('info', 'Participation refusée.');
        return $this->redirectToRoute('evenement_show', ['id' => $evenement->getId()]);
    }

    #[Route('/annuler/{id}', name: 'participation_annuler', methods: ['POST'])]
    public function annuler(Participation $participation, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if ($user !== $participation->getUtilisateur() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        $participation->setStatut('annulee');
        $em->flush();

        $this->addFlash('warning', 'Participation annulée.');
        return $this->redirectToRoute('evenement_show', ['id' => $participation->getEvenement()->getId()]);
    }
}
