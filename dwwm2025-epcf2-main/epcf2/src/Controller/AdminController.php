<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\EvenementRepository;
use App\Repository\ParticipationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function index(
        UserRepository $userRepository,
        EvenementRepository $evenementRepository,
        ParticipationRepository $participationRepository
    ): Response {
        $nbUsers = $userRepository->count([]);
        $nbEvents = $evenementRepository->count([]);
        $nbParticipations = $participationRepository->count([]);
        $lastUsers = $userRepository->findBy([], ['id' => 'DESC'], 5);
        $lastEvents = $evenementRepository->findBy([], ['id' => 'DESC'], 5);

        return $this->render('admin/dashboard.html.twig', [
            'nbUsers' => $nbUsers,
            'nbEvents' => $nbEvents,
            'nbParticipations' => $nbParticipations,
            'lastUsers' => $lastUsers,
            'lastEvents' => $lastEvents,
        ]);
    }
}