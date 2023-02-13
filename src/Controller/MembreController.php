<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembreController extends AbstractController
{
    
    #[Route('/membres', name: 'membres')]
    public function index(MembreRepository $repoMembre,Request $request, EntityManagerInterface $manager,Membre $membre): Response
    {
        // $membres = $repoMembre->findAll();

        // $membre = new Membre;

        // $form = $this->createForm(MembreType::class , $membre);
 
        // $form->handleRequest($request);
 
        // if($form->isSubmitted() && $form->isValid())
        // {       
        //      $manager->persist($membre);
        //      $manager->flush();
 
        //      $this->addFlash('succes',' Le Membre a bien été Enregistrer');

        //      $id = $membre->getId();
        //      $manager->remove($membre);
        //      $manager->flush();

 
        //      return $this->redirectToRoute("membres");
        // } 
 

        return $this->render('membre/index.html.twig', [
            'controller_name' => 'MembreController',
            // 'membres' => $membres ,
            // 'FormMembre' => $form->createView()
        ]);
    }



    #[Route('/membre/delete/{id}', name: 'delete')]
    public function delete(Membre $membre, EntityManagerInterface $manager)
    {
     
        $id = $membre->getId();
        $manager->remove($membre);
        $manager->flush();
        $this->addFlash('succes',' Le Membre a bien été supprimer');
        return $this->redirectToRoute("membres");
    }

}
