<?php

namespace App\Controller;

use App\Entity\Moto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MotoRepository;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{
    #[Route('', name: 'homepage')]
    public function index(Request $request, Environment $twig, MotoRepository $motoRepository): Response
    {
        $page = max(0, $request->query->getInt('page', 1));
        $paginator = $motoRepository->getMotoPaginator(MotoRepository::PAGINATOR_PER_PAGE*($page-1));

        return new Response($twig->render('home/index.html.twig', [
            'motos' => $paginator,
            'page' => $page,
            'numbermotoparpage' => MotoRepository::PAGINATOR_PER_PAGE
        ]));
    }
}
