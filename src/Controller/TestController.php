<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $content = json_decode($request->getContent());

        return $this->json($request->getContent());
    }
}
