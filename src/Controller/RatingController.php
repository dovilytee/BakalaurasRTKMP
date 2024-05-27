<?php
// src/Controller/PlaceController.php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Rating;
use App\Form\RatingType;
use App\Repository\PlaceRepository;
use App\Repository\RatingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatingController extends AbstractController
{
    #[Route('/rating/{id}', name: 'rating_show')]
    public function show(int $id, PlaceRepository $placeRepository, RatingRepository $ratingRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $place = $placeRepository->find($id);
        if (!$place) {
            throw $this->createNotFoundException('The place does not exist');
        }

        $rating = new Rating();
        $form = $this->createForm(RatingType::class, $rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rating->setPlace($place);
            $rating->setUser($this->getUser());
            $rating->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($rating);
            $entityManager->flush();

            return $this->redirectToRoute('place_show', ['id' => $place->getId()]);
        }

        $ratings = $ratingRepository->findBy(['place' => $place]);
        $averageRating = $ratingRepository->getAverageRating($place->getId());

        return $this->render('rating/show.html.twig', [
            'place' => $place,
            'form' => $form->createView(),
            'ratings' => $ratings,
            'averageRating' => $averageRating,
        ]);
    }
}