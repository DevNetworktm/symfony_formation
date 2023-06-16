<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/twig')]
class TwigHeritageController extends AbstractController
{

    #[Route('', name: 'app_twig')]
    public function index(): Response
    {
        return $this->render('views/twig_heritage/index.html.twig', [
            'controller_name' => 'TwigHeritageController',
        ]);
    }
    #[Route('/heritage', name: 'app_twig_heritage')]
    public function heritage(): Response
    {
        return $this->render('layouts/layout.default.html.twig', [
            'controller_name' => 'TwigHeritageController',
        ]);
    }
}
