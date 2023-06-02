<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Moto;
use App\Entity\User;
use App\Entity\Comments;
use App\Form\MessageFormType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DetailController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function show(Request $request, Environment $twig, Moto $moto, EntityManagerInterface $entityManager): Response
    {
        //récupération de la liste des commentaires associées à la moto
        $comments = $moto->getCommentairesMoto();

        $comment = new Comments;

        //récupération du token afin de récupéré l'utilisateur connecté
        $token = $this->tokenStorage->getToken();

        $form = $this->createForm(MessageFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $token->getUser();
            $comment->setUserComments($user);
            $comment->setMotoComments($moto);
            $comment->setDate(new DateTime('now'));
        
            $entityManager->persist($comment);
            $entityManager->flush();
        
        }

        return new Response($twig->render('detail/index.html.twig', [
            'moto' => $moto,
            'comments' => $comments,
            'MessageForm' => $form->createView(),
        ]));
    }
}
