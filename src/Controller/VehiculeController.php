<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    #[Route('/vehicule', name: 'app_vehicule')]
    public function index(Request $request, VehiculeRepository $repoVehicule, EntityManagerInterface $manager): Response
    {
        
        $vehicules = $repoVehicule->findAll();
        $vehicule = new Vehicule;

        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($vehicule);
            $manager->flush();

            return $this->redirectToRoute('app_vehicule');
        }

        return $this->render('vehicule/index.html.twig', [
            'controller_name' => 'VehiculeController',
            'FormVehicule' => $form->createView(),
            'vehicules' => $vehicules,
            'vehicule' => $vehicule    
        ]);
    }

    
    #[Route('/vehicule/supprimer/{id}', name: 'delete_vehicule')]
    public function category_supprimer(Vehicule $vehicule , EntityManagerInterface $manager)
    {
        
        
        $manager->remove($vehicule);
        $manager->flush();
        
        $this->addFlash("success", "La categorie N°" . $vehicule->getId() ."a bien été supprimée");
        
        return $this->redirectToRoute("app_vehicule");
    }

}
  