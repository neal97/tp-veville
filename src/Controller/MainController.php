<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\AgencesRepository;
use App\Repository\UserRepository;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function accueil(VehiculeRepository $vehicule, AgencesRepository $agence, Request $request) : Response
    {
        $result = $vehicule->findVehiculesAndAgences();
        $ag = $agence->findAll();
         
        
        if ($request->isMethod("POST")) {
           $idAgence = $request->request->get('agence');
           $vehicule = $vehicule->findVehiculeByIdAgence($idAgence);
           $ag = $agence->findAll();

           $debut = \DateTime::createFromFormat('Y-m-d\TH:i', $request->request->get('debut'));
           $fin = \DateTime::createFromFormat('Y-m-d\TH:i', $request->request->get('fin'));
            
           $intervalle = $debut->diff($fin);

           return $this->render('main/accueil.html.twig', [
            'filterVehicule' => true,
            'vehicule' => $vehicule ,
            'agence' => $ag,
            'day' => $intervalle->days,
            'debut' => $debut->format('y-m-d H:i:s'),
            'fin' => $fin->format('y-m-d H:i:s')

        ]);
        }

        return $this->render('main/accueil.html.twig', [
            'vehicule' => $result ,
            'agence' => $ag,
            'filterVehicule' =>false
        ]);
    }

    #[Route('/{idVehicule}/{idAgence}/{idUser}/{prixTotal}/{debut}/{fin}', name: 'postCommande')]
    public function postCommande(EntityManagerInterface $manager,VehiculeRepository $repoVehicule, AgencesRepository $repoAgence, UserRepository $repoUser ,$prixTotal,  $idVehicule , $idAgence , $idUser,$debut, $fin, Request $request)
    {
        $vehicule = $repoVehicule->find($idVehicule);
        $agence = $repoAgence->find($idAgence);
        $user = $repoUser->find($idUser);
    
        
    
        
        $commande = new Commande;
        $commande->setIdVehicule($vehicule);
        $commande->setFkAgence($agence);
        $commande->setIdUser($user);
        $commande->setDateHeureDepart(new \Datetime($debut));
        $commande->setDateEnregistrement(new \Datetime());
        $commande->setDateHeureFin(new \Datetime($fin)); 
        $commande->setPrixTotal($prixTotal);
        // dd($commande);


        $manager->persist($commande);
        $manager->flush();

        return $this->redirectToRoute("accueil");
    }



}
