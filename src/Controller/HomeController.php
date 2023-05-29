<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MotoRepository;
use Twig\Environment;

class HomeController extends AbstractController
{
    #[Route('', name: 'homepage')]
    public function index(Environment $twig, MotoRepository $motoRepository): Response
    {
        return new Response($twig->render('home/index.html.twig', [
            'motos' => $motoRepository->findAll(),
        ]));
    }
}
