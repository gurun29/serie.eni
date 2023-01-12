<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/series", name="app_serie_")
 */
class SerieController extends AbstractController
{
    /* Route("/series", name="app_serie_list") */
    /**
     * @Route("", name="list")
     */
    public function list(): Response
    {
        //todo : aller chercher les series en bdd

        return $this->render('serie/list.html.twig', [

        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id): Response
    {
        //todo : aller chercher la serie en bdd
        return $this->render('serie/details.html.twig');

    }

    /**
     * @Route("/create", name="create")
     */
    public function create(): Response
    {

        return $this->render('serie/create.html.twig');

    }
}
