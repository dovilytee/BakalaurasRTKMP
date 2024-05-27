<?php

namespace App\Controller;

use App\Entity\Rating;
use App\Entity\Trip;
use App\Entity\TripComment;
use App\Entity\TripCity;
use App\Entity\TripRating;
use App\Entity\User;
use App\Form\RatingType;
use App\Form\TripFilterType;
use App\Form\TripRatingType;
use App\Repository\PlaceRepository;
use App\Repository\RatingRepository;
use App\Repository\TripRatingRepository;
use App\Repository\TripRepository;
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
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class TripController extends AbstractController
{
    #[Route('/trip', name: 'trip')]
    public function route(EntityManagerInterface $entityManager, UserRepository $users): Response
    {
        $repository = $entityManager->getRepository(Trip::class);
        $trips = $repository->findAll();
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('trip/index.html.twig', [
            'trips' => $trips,
            'users'=>$users
        ]);
    }
    #[Route('/trip/{id}', name: 'trip_show')]
    public function show_trip(int $id, TripRepository $tripRepository, TripRatingRepository $tripRatingRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $trip = $entityManager->getRepository(Trip::class)->find($id);

        if (!$trip) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
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
        $averageRating = $tripRatingRepository->getAverageRating($trip->getId());

        return $this->render('trip/trip_show.html.twig', [
            'trip' => $trip,
            'form' => $form->createView(),
            'ratings' => $ratings,
            'averageRating' => $averageRating,
        ]);


       // return $this->render('trip/trip_show.html.twig', array('trip' => $trip));

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
    public function addAction(Request $request)
    {

        $trip = new Trip();
        $form= $this->createForm(TripType::class, $trip);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $file = $trip->getPhoto();
            $filename= md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photos_directory'), $filename);
            $trip->setPhoto($filename);
            $trip->setCreator($this->getUser());

            $em->persist($trip);
            $em->flush();

            $this->addFlash('info', 'Created Successfully !');
        }
        return $this->render('trip/trip/index.html.twig', array(
            "Form"=> $form->createView()
        ));
    }
    #[Route('/trip', name: 'trip_list')]
    public function list(Request $request, TripRepository $tripRepository): Response
    {

        $form = $this->createForm(TripFilterType::class);
        $form->handleRequest($request);
        $trips = [];
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $tripCity = $data['tripCity'];
                if($tripCity) {
                    $trips = $tripRepository->findByTripCity($tripCity->getId());
                    if(!$trips ){
                        throw $this->createNotFoundException(
                            'No product found for id ');
                    }
                }
                else {
                    $trips = $tripRepository->findAll();
                }

        }
        return $this->render('trip/list.html.twig', ['form' => $form->createView(),
            'trips' => $trips,
        ]);

    }

}
