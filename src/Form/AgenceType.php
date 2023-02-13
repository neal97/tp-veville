<?php

namespace App\Form;

use App\Entity\Agences;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                "label" => "titre ",
                "required" => false,
                "attr" => [
                    "placeholder"=> "titre",
                    "class"=> "form-control",
                ]
            ]) 
            ->add('adresse', TextType::class, [
                "label" => "adresse de l'agence",
                "required" => false,
                "attr" => [
                    "placeholder"=> "adresse",
                    "class"=> "form-control",
                ]
            ])
            ->add('ville', TextType::class, [
                "label" => "ville de l'agence",
                "required" => false,
                "attr" => [
                    "placeholder"=> "ville",
                    "class"=> "form-control",
                ]
            ])
            ->add('cp', TextType::class, [
                "label" => "cp de la ville",
                "required" => false,
                "attr" => [
                    "placeholder"=> "cp",
                    "class"=> "form-control",
                ]
            ])
            ->add('description', TextareaType::class, [
                "label" => "description de l'agence",
                "required" => false,
                "attr" => [
                    "placeholder"=> "description",
                    "class"=> "form-control",
                ]
            ])
            ->add('photo', TextType::class, [
                "label" => "photo de l'agence",
                "required" => false,
                "attr" => [
                    "placefolder" => "photo",
                    "class" => "form-control"
                ] 
            ]) 
        
        ->add('Ajouter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agences::class,
        ]);
    }
}
