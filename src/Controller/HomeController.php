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
    public function index(Request $request, Environment $twig, MotoRepository $motoRepository, ?string $type = null, ?string $filter = null): Response
    {
        $page = max(0, $request->query->getInt('page', 1));
        $paginator = $motoRepository->getMotoPaginator(MotoRepository::PAGINATOR_PER_PAGE*($page-1),($type != null) ? ($type) : ('null'),($filter != null) ? ($filter) : ('null'));
        //dd($paginator->getIterator());
        return new Response($twig->render('home/index.html.twig', [
            'motos' => $paginator,
            'page' => $page,
            'numbermotoparpage' => MotoRepository::PAGINATOR_PER_PAGE,
            'type' => $type,
            'filter' => $filter,
        ]));
    }
}
