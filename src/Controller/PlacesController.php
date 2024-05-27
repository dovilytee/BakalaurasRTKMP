<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Rating;
use App\Entity\User;
use App\Form\RatingType;
use App\Repository\PlaceRepository;
use App\Repository\RatingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface;

class PlacesController extends AbstractController
{
    #[Route('/place', name: 'place')]
    public function place(EntityManagerInterface $entityManager, UserRepository $users): Response
    {
        $repository = $entityManager->getRepository(Place::class);
        $places = $repository->findAll();
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('place/index.html.twig', [
            'places' => $places,
            'users'=>$users
        ]);
    }
    #[Route('/place/{id}', name: 'place_show')]
    public function show_place(int $id, PlaceRepository $placeRepository, RatingRepository $ratingRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $place = $entityManager->getRepository(Place::class)->find($id);

        if (!$place) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
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

        return $this->render('place/place_show.html.twig', [
            'place' => $place,
            'form' => $form->createView(),
            'ratings' => $ratings,
            'averageRating' => $averageRating,
        ]);

        //return $this->render('place/place_show.html.twig', array('place' => $place));

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
