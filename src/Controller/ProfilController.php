<?php

namespace App\Controller;

use App\Form\ProfilFormType;
use DateTime;
use App\Entity\User;
use App\Form\UploadPPFormType;
use App\Form\ImageUploadType;
use App\Security\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'profil')]
    public function profil(Request $request,User $user, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        //On regarde si l'utilisateur possède une image de profil puis l'envoie au twig
        $ppExist = file_exists($this->getParameter('kernel.project_dir') . '/public/uploads/images/pp/' . $user->getId().".png");
        
        $formPP = $this->createForm(UploadPPFormType::class);
        $formPP->handleRequest($request);

        if ($formPP->isSubmitted() && $formPP->isValid()) {
            $imageFile = $formPP->get('imageFile')->getData();

            if ($imageFile) {
                $newFilename = $user->getId().'.'.$imageFile->guessExtension();

                // Déplacez le fichier vers le répertoire de stockage
                $imageFile->move(
                    $this->getParameter('upload_dir'),
                    $newFilename
                );

                // Vous pouvez enregistrer le nom du fichier dans la base de données
                // ou effectuer d'autres opérations selon vos besoins
            }
        }

        $form = $this->createForm(ProfilFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            
            $user->setUpdatedDate(new DateTime('now'));
            
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('profil/index.html.twig', [
            'UpdateForm' => $form->createView(),
            'UploadForm' => $formPP->createView(),
            'Pp_exist' => $ppExist,
        ]);
    }
}
