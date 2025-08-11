<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class StatsController extends AbstractController
{
    public function index(ParticipationRepository $repository): Response
    {
        $participationCount = $repository->countParticipations();

        return $this->render('statistics/index.html.twig', [
            'participationCount' => $participationCount,
        ]);
    }
}



