<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/evenement', name: 'evenement_index')]
    public function index(Request $request, EvenementRepository $evenementRepository, EntityManagerInterface $em): Response
    {
        $categorie = $request->query->get('categorie');
        $lieu = $request->query->get('lieu');
        $date = $request->query->get('date');
        $search = $request->query->get('search');

        $evenements = $evenementRepository->findByFilters($categorie, $lieu, $date, $search);

        
        $categories = $em->getRepository(\App\Entity\Categorie::class)->findAll();
        $lieux = $em->getRepository(\App\Entity\Lieu::class)->findAll();

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
            'categories' => $categories,
            'lieux' => $lieux,
        ]);
    }

    #[Route('/evenement/new', name: 'evenement_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('EVENEMENT_CREATE');

        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $evenement->setOrganisateur($this->getUser());
            $evenement->setDateCreation(new \DateTimeImmutable());

            // Pour chaque média ajouté
            foreach ($form->get('medias') as $mediaForm) {
                $file = $mediaForm->get('file')->getData();
                if ($file) {
                    $filename = uniqid().'.'.$file->guessExtension();
                    $file->move($this->getParameter('media_directory'), $filename);

                    $media = $mediaForm->getData();
                    $media->setFilename($filename);
                    $media->setEvenement($evenement);
                    $em->persist($media);
                }
            }

            $em->persist($evenement);
            $em->flush();

            $this->addFlash('success', 'Événement créé avec succès.');

            return $this->redirectToRoute('evenement_show', [
                'id' => $evenement->getId(),
            ]);
        }

        return $this->render('evenement/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/evenement/{id}', name: 'evenement_show', requirements: ['id' => '\d+'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/evenement/{id}/edit', name: 'evenement_edit')]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('EVENEMENT_EDIT', $evenement);

        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Pour chaque média ajouté
            foreach ($form->get('medias') as $mediaForm) {
                $file = $mediaForm->get('file')->getData();
                if ($file) {
                    $filename = uniqid().'.'.$file->guessExtension();
                    $file->move($this->getParameter('media_directory'), $filename);

                    $media = $mediaForm->getData();
                    $media->setFilename($filename);
                    $media->setEvenement($evenement);
                    $em->persist($media);
                }
            }

            $em->flush();
            $this->addFlash('success', 'Événement modifié');
            return $this->redirectToRoute('evenement_show', ['id' => $evenement->getId()]);
        }

        return $this->render('evenement/edit.html.twig', [
            'form' => $form->createView(),
            'evenement' => $evenement,
        ]);
    }

    #[Route('/evenement/{id}/delete', name: 'evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('EVENEMENT_DELETE', $evenement);

        if ($this->isCsrfTokenValid('delete' . $evenement->getId(), $request->request->get('_token'))) {
            $em->remove($evenement);
            $em->flush();
            $this->addFlash('success', 'Événement supprimé.');
        }

        return $this->redirectToRoute('evenement_index');
    }
}
