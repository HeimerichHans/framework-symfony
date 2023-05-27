<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message'=>'Le message ne doit pas être vide',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom doit faire minimum 2 caractères',
                        'max' => 25,
                        'maxMessage' => 'Le nom doit être inférieur à 25 caractères',
                    ])
                ]
            ])    
            ->add('prenom', TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message'=>'Le message ne doit pas être vide',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le prenom doit faire minimum 2 caractères',
                        'max' => 25,
                        'maxMessage' => 'Le prenom doit être inférieur à 25 caractères',
                    ])
                ]
            ])  
            ->add('pseudo', TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message'=>'Le message ne doit pas être vide',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le pseudo doit faire minimum 2 caractères',
                        'max' => 25,
                        'maxMessage' => 'Le pseudo doit être inférieur à 25 caractères',
                    ])
                ]
            ])     
            ->add('email', EmailType::class)
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les termes utilisateurs.',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmation du mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veulliez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit faire minimum 8 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new NotCompromisedPassword([
                        'message' => 'Votre mot de passe est compromis dans une base public'
                    ]),
                    new Regex([
                        'pattern' => '/\d+/i',
                        'message' => 'Votre mot de passe doit contenir au moins un chiffre',
                    ]),
                    new Regex([
                        'pattern' => '/[#?!@$%^&*-]+/i',
                        'message' => 'Votre mot de passe doit contenir au moins un caractère suivant: [#?!@$%^&*-]',
                    ]),
                    new Regex([
                        'pattern' => '/[azertyuiopqsdfghjklmwxcvbn]+/',
                        'message' => 'Votre mot de passe doit contenir au moins un caractère miniscule',
                    ]),
                    new Regex([
                        'pattern' => '/[AZERTYUIOPQSDFGHJKLMWXCVBN]+/',
                        'message' => 'Votre mot de passe doit contenir au moins un caractère majuscule',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
