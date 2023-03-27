<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'name' => 'Zachary'
        ]);
    }

    #[Route('/sayHello/{name}/{firstname}', name: 'app_say_hello')]
    public function sayHello(Request $request, string $name, string $firstname): Response
    {
        return $this->render('first/hello.html.twig', [
            'name' => $name,
            'firstname' => $firstname
        ]);
    }

    #[Route(
        '/multiply/{entier}/{entier2}',
        name: 'app_multiply',
        requirements: [
            "entier" => "\d+",
            "entier2" => "\d+"
        ]
    )]
    public function multiply(int $entier, int $entier2): Response
    {
        $result = $entier * $entier2;
        return new Response("<h1>$result</h1>");
    }
}
