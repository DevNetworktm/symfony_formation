<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tab')]
class TabController extends AbstractController
{
    #[Route('/{nb<\d+>?5}', name: 'app_tab')]
    public function index($nb): Response
    {
        $notes = [];
        for ($i = 0; $i < $nb; $i++) $notes[] = rand(0, 20);
        return $this->render('views/tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }

    #[Route('/users', name: 'app_tab_users')]
    public function users(): Response
    {
        $users = [
            [
                'firstname' => 'Zachary',
                'lastname' => 'Masson',
                'age' => 18
            ],
            [
                'firstname' => 'Célia',
                'lastname' => 'Dezwemeer',
                'age' => 17
            ],
            [
                'firstname' => 'Gauthier',
                'lastname' => 'Delhay',
                'age' => 25
            ],
            [
                'firstname' => 'Nicolas',
                'lastname' => 'Magne',
                'age' => 22
            ]
        ];

        return $this->render('views/tab/users.html.twig', [
            'users' => $users
        ]);
    }
}
