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
        return $this->render('views/first/index.html.twig', [
            'name' => 'Zachary'
        ]);
    }

    #[Route('/sayHello/{name}/{firstname}', name: 'app_say_hello')]
    public function sayHello(Request $request, string $name, string $firstname): Response
    {
        return $this->render('views/first/hello.html.twig', [
            'name' => $name,
            'firstname' => $firstname,
            'path' => "            "
        ]);
    }

    public function sayHelloComp(Request $request, string $name, string $firstname): Response
    {
        return new Response("
            <p>Hello, $name $firstname</p>
        ");
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
