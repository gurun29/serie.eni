<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main_home")
     */
    public function home()
    {
        echo "coucou";
        die();
    }

    /**
     * @Route("/test", name="app_main_test")
     */
    public function test()
    {
        echo "tesqt";
        die();
    }
}