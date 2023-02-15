<?php

namespace App\Form;

use App\Entity\Agences;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
        // $builder
        // ->add('titre', TextType::class, [
        //     "label" => "titre ",
        //     "required" => false,
        //     "attr" => [
        //         "placeholder"=> "titre",
        //         "class"=> "form-control",
        //     ]
        // ]) 
        // ->add('adresse', TextType::class, [
        //     "label" => "marque",
        //     "required" => false,
        //     "attr" => [
        //         "placeholder"=> "marque",
        //         "class"=> "form-control",
        //     ]
        // ])
        // ->add('ville', TextType::class, [
        //     "label" => "modele",
        //     "required" => false,
        //     "attr" => [
        //         "placeholder"=> "modele",
        //         "class"=> "form-control",
        //     ]
        // ])
        // ->add('cp', TextType::class, [
        //     "label" => "description",
        //     "required" => false,
        //     "attr" => [
        //         "placeholder"=> "description",
        //         "class"=> "form-control",
        //     ]
        // ])
        // ->add('description', TextareaType::class, [
        //     "label" => "prix_journalier",
        //     "required" => false,
        //     "attr" => [
        //         "placeholder"=> "prix_journalier",
        //         "class"=> "form-control",
        //     ]
        // ])
        // ->add('photo', TextType::class, [
        //     "label" => "photo de l'agence",
        //     "required" => false,
        //     "attr" => [
        //         "placefolder" => "photo",
        //         "class" => "form-control"
        //     ] 
        // ]) 
            
        // ->add('Ajouter', SubmitType::class);
        
        $builder
        ->add('id_agence', EntityType::class, [
            'class' => Agences::class,
            'placeholder' => 'selectioner une agence',
            'choice_label'=>'titre',
            'required'=>false
           ])      
        
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
            
            ->add('prix_journalier', TextType::class,  [
                "label"=>"Prix",
                "required"=>false,//mettre valeur par défaut qui est ne nom de propriété à false pour le modifier
                "attr"=>[
                    "placeholder"=> "Prix journalier",
                    "class"=>"border border-primary"]
            ])

            ->add('id_agence', EntityType::class, [
                'class' => Agences::class,
                'placeholder' => 'selectioner une agence',
                'choice_label'=>'titre',
                'required'=>false
               ])      
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}