<?php
//src/Controller/MainController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render("main/home.html.twig");
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render("main/contact.html.twig");
    }
}