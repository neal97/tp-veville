<?php

namespace App\Form;

use App\Entity\Agences;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextreaType::class, [
                "label" => "titre ",
                "require" => false,
            ]) 
            ->add('adresse', TextreaType::class, [
                "label" => "adresse de l'agence",
                "require" => false,
            ])
            ->add('ville', TextreaType::class, [
                "label" => "ville de l'agence",
                "require" => false,
            ])
            ->add('cp', TextreaType::class, [
                "label" => "cp de la ville",
                "require" => false,
            ])
            ->add('description', TextreaType::class, [
                "label" => "description de l'agence",
                "require" => false,
            ])
            ->add('photo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agences::class,
        ]);
    }
}
