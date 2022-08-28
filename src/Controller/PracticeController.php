<?php

namespace App\Controller;

use App\Utils\DD;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test', methods: ['POST'])]
    public function practiceCheck(Request $request): Response
    {
        $content = json_decode($request->getContent());

        return $this->json($request->getContent());
    }
}
