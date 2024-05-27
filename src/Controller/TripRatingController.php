<?php
// src/Controller/PlaceController.php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Rating;
use App\Form\RatingType;
use App\Form\TripRatingType;
use App\Repository\PlaceRepository;
use App\Repository\RatingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TripRatingController extends AbstractController
{
    #[Route('/rating/{id}', name: 'rating_show')]
    public function show(int $id, TripRepository $tripRepository, TripRatingRepository $tripRatingRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $trip = $tripRepository->find($id);
        if (!$trip) {
            throw $this->createNotFoundException('The place does not exist');
        }

        $rating = new TripRating();
        $form = $this->createForm(TripRatingType::class, $rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rating->setTrip($trip);
            $rating->setUser($this->getUser());
            $rating->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($rating);
            $entityManager->flush();

            return $this->redirectToRoute('trip_show', ['id' => $trip->getId()]);
        }

        $ratings = $tripRatingRepository->findBy(['trip' => $trip]);
        $averageRating = $tripRatingRepository->getAverageRatingTrip($trip->getId());

        return $this->render('rating/show.html.twig', [
            'trip' => $trip,
            'form' => $form->createView(),
            'ratings' => $ratings,
            'averageRating' => $averageRating,
        ]);
    }
}