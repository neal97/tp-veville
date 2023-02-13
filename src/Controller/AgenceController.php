<?php

namespace App\Controller;

use App\Entity\Agences;
use App\Form\AgenceType;
use App\Repository\AgencesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgenceController extends AbstractController
{
    #[Route('/agence', name: 'app_agence')]
    public function index(AgencesRepository $repoAgences, Request $request, EntityManagerInterface $manager): Response
    {
         $agences = $repoAgences->findAll();
                     
         $agence = new Agences;
         $form = $this->createForm(AgenceType::class, $agence );

         $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($agence);
            $manager->flush(); 
        }

        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
            'agences' => $agences,
            'formAgence' => $form->createView()
                ]); 
    }
}