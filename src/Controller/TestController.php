<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TestController extends AbstractController
{
    #[Route('/admin/test', name: 'admin_test')]
    #[IsGranted('ROLE_ADMIN')]
    public function adminTest(): Response
    {
        return new Response('Si vous voyez ceci, vous êtes admin!');
    }

    #[Route('/user/test', name: 'user_test')]
    #[IsGranted('ROLE_USER')]
    public function userTest(): Response
    {
        return new Response('Si vous voyez ceci, vous êtes connecté en tant qu\'utilisateur!');
    }
}