<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todo')]
class TodoController extends AbstractController
{
    #[Route('', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('todos')) {
            $todos = [
                'achat' => 'acheter une clef USB',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "La liste des todos viens d'être initialiser !");
        }

        return $this->render('todo/index.html.twig');
    }

    #[Route(
        '/add/{name}/{content}',
        name: 'app_todo_add',
        defaults: [
            "name" => "Symfony",
            "content" => "default value symfony 6"
        ]
    )]
    public function addTodo(Request $request, string $name, string $content): RedirectResponse
    {
        $session = $request->getSession();

        if ($session->has('todos')) {
            $todos = $session->get('todos');
            if (isset($todos[$name])) $this->addFlash('error', "Le todo $name existe déjà dans la liste");
            else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "$name a était ajouter a liste de todos !");
            }
        } else {
            $this->addFlash('error', "La liste des todos n'es pas encore initialiser !");
        }

        return $this->redirectToRoute('app_todo');
    }

    #[Route('/update/{name}/{content}', name: 'app_todo_update')]
    public function updateTodo(Request $request, string $name, string $content): RedirectResponse
    {
        $session = $request->getSession();

        if ($session->has('todos')) {
            $todos = $session->get('todos');
            if (!isset($todos[$name])) $this->addFlash('error', "Le todo $name n'existe pas dans la liste");
            else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "$name a était modifier !");
            }
        } else {
            $this->addFlash('error', "La liste des todos n'es pas encore initialiser !");
        }

        return $this->redirectToRoute('app_todo');
    }

    #[Route('/del/{name}', name: 'app_todo_del')]
    public function delTodo(Request $request, string $name): RedirectResponse
    {
        $session = $request->getSession();

        if ($session->has('todos')) {
            $todos = $session->get('todos');
            if (!isset($todos[$name])) $this->addFlash('error', "Le todo $name n'existe pas dans la liste");
            else {
                unset($todos[$name]);
                $session->set('todos', $todos);
                $this->addFlash('success', "$name a était correctement supprimer!");
            }
        } else {
            $this->addFlash('error', "La liste des todos n'es pas encore initialiser !");
        }

        return $this->redirectToRoute('app_todo');
    }

    #[Route('/reset', name: 'app_todo_reset')]
    public function resetTodo(Request $request): RedirectResponse
    {
        $session = $request->getSession();
        $session->remove('todos');
        return $this->redirectToRoute('app_todo');
    }
}
