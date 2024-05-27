<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Rating;
use App\Form\RatingType;
use App\Entity\PlaceComment;
use App\Entity\PlaceType;
use App\Entity\PlaceCity;
use App\Entity\User;
use App\Repository\PlaceRepository;
use App\Repository\RatingRepository;
use App\Form\PlaceFilterType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class PlaceController extends AbstractController
{
    #[Route('/place', name: 'place')]
    public function index(PlaceRepository $placeRepository): Response
    {
        $places = $placeRepository->findBy(['isVisible' => true]);

        return $this->render('place/index.html.twig', [
            'places' => $places,
        ]);
    }
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
    public function addAction(Request $request)
    {

        $place = new Place();
        $form= $this->createForm(PlaceType::class, $place);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $file = $place->getPhoto();
            $filename= md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photos_directory'), $filename);
            $place->setPhoto($filename);
            $place->setCreator($this->getUser());

            $em->persist($place);
            $em->flush();

            $this->addFlash('info', 'Created Successfully !');
        }
        return $this->render('place/place/index.html.twig', array(
            "Form"=> $form->createView()
        ));
    }
    public function createPlaceTypes(EntityManagerInterface $em)
    {
        $placeType1 = new PlaceType();
        $placeType1-> setName('Museum');
        $placeType2 = new PlaceType();
        $placeType2 -> setName('Church');

        $em ->persist($placeType1);
        $em ->persist($placeType2);

        $em -> flush();
    }
    #[Route('/places', name: 'place_list')]
    public function list(Request $request, PlaceRepository $placeRepository): Response
    {
        $form = $this->createForm(PlaceFilterType::class);
        $form->handleRequest($request);
        $places = [];
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $placeType = $data['placeType'];
            $placeCity = $data['placeCity'];
            if($placeType)
            {
                if($placeType) {
                    $places = $placeRepository->findByPlaceType($placeType->getId());
                }
                else {
                    $places = $placeRepository->findAll();
                }
            }
            elseif($placeCity)
            {
                if($placeCity) {
                    $places = $placeRepository->findByPlaceCity($placeCity->getId());
                }
                else {
                    $places = $placeRepository->findAll();
                }
            }
            else{
                if($placeType && $placeCity) {
                    $places = $placeRepository->findByPlaceType($placeType->getId());
                }
                else {
                    $places = $placeRepository->findAll();
                }
            }


        }
        return $this->render('place/list.html.twig', ['form' => $form->createView(),
                                                            'places' => $places,
            ]);

    }

}
