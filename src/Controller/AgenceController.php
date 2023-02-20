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
            return $this->redirectToRoute("app_agence");
        }

        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
            'agences' => $agences,
            'formAgence' => $form->createView()
                ]); 
    }
    #[Route('/agence/detail/{id}', name: 'DetailAgence')]
    public function detail(AgencesRepository $repoAgences, $id): Response
    {
        $agences = $repoAgences->find($id);

        return $this->render('agence/DetailAgence.html.twig',[
            'agence' => $agences,

        ]);
    }

    #[Route('/agence/delete/{id}', name: 'DeleteAgence')]
    public function delete(AgencesRepository $repoAgences, EntityManagerInterface $manager, $id)
    {
        $agences = $repoAgences->find($id);

        $manager->remove($agences);
        $manager->flush();
           
        return $this->redirectToRoute("app_agence");
    }

    #[Route('/agence/update/{id}', name: 'UpdateAgence')]
    public function update(AgencesRepository $repoAgences, $id, Request $request, EntityManagerInterface $manager)
    {
        $agences = $repoAgences->find($id);
        $form= $this->createForm(AgenceType::class, $agences);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($agences);
            $manager->flush();

            $this->addFlash("success", "l'Agence" . $agences->getId() . " à bien été ajouter");
            return $this->redirectToRoute("UpdateAgence");
        }

        return $this->render('agence/UpdateAgence.html.twig',[
            "formAgence" => $form->createView(),
            'agences' => $agences,
        ]);
    }

    }
