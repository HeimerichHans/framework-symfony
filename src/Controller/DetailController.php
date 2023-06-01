<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Moto;
use App\Entity\User;
use App\Entity\Comments;
use Twig\Environment;

class DetailController extends AbstractController
{
    #[Route('/detail/{id}', name: 'detail')]
    public function show(Environment $twig, Moto $moto): Response
    {
        $comments = $moto->getCommentairesMoto();

        return new Response($twig->render('detail/index.html.twig', [
            'moto' => $moto,
            'comments' => $comments
        ]));
    }
}
