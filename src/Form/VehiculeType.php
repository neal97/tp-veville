<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
              ->add('id_agence')
            ->add('titre', TextType::class, [
                "label" => "Titre",
                "required" => false,
                "attr" =>[
                     "class" => "",
                     "placeholder" => "Titre de l'annonce"
                ]
            ] )
            ->add('marque', TextType::class, [
                "label" => "Marque",
                "required" => false,
                "attr" =>[
                     "class" => "",
                     "placeholder" => "Marque"
                ]
            ] )
            ->add('modele', TextType::class, [
                "label" => "Modele",
                "required" => false,
                "attr" =>[
                     "class" => "",
                     "placeholder" => "Modele"
                ]
            ] )
            ->add('description', TextareaType::class, [
                "label" => "Description",
                "required" => false,
                "attr" =>[
                     "class" => "",
                     "placeholder" => "Description de votre vehicule"
                ]
            ] )
            ->add('photo', TextType::class)
            
            ->add('prix_journalier', TextType::class, [
                "label" => "prix",
                "required" => false,
                "attr" =>[
                     "class" => "",
                     "placeholder" => "Prix_journalier"
                ]
            ] )
          
            ->add('Enregistrer', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}