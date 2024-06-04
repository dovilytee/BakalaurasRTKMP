<?php
// src/Controller/CustomController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomController extends AbstractController
{
    /**
     * @Route("/not-found-list", name="not_found_list")
     */
    public function notFoundList(): Response
    {
        // Your logic to render the "not found" list
        $entities = []; // Get the list of entities that are not found

        return $this->render('not_found_list.html.twig', [
            'entities' => $entities,
        ]);
    }
}