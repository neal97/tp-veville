<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver; 

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                "label" => "Pseudo",
                "required" => false,
                "attr" => [
                    "class" => "",
                    "placeholder" => "votre Pseudo"
                ]
            ])

            ->add('mdp', PasswordType::class, [
                "label" => "mot de passse",
                "required" => false,
                "attr" => [
                    "class" => "",
                    "placeholder" => "votre mot de passe"
                ]
            ])

            ->add('nom', TextType::class, [
                "label" => "nom",
                "required" => false,
                "attr" => [
                    "class" => "",
                    "placeholder" => "votre nom"
                ]
            ])

            ->add('prenom', TextType::class, [
                "label" => "Prenom",
                "required" => false,
                "attr" => [
                    "class" => "",
                    "placeholder" => "votre Prenom"
                ]
            ])

            ->add('email', EmailType::class, [
                "label" => "email",
                "required" => false,
                "attr" => [
                    "class" => "",
                    "placeholder" => "votre email"
                ]
            ])

            ->add('civilite', ChoiceType::class, [
                "choices" => [
                "Homme" => 'h',
                "Femme" => 'f',

                ],
               
                "attr" => [
                    "class" => "",
            
                ]
            ])

            ->add('statut', ChoiceType::class, [
                "choices" => [
                    "admin" => 0,
                    "user" => 1,
    
                    ],
                "attr" => [
                    "class" => "",
                    
                ]
            ])

            

        ->add('Enregistrer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
