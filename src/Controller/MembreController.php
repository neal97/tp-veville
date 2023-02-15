<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class MembreController extends AbstractController

    #[Route('/membre', name: 'app_membre')]
    public function index(MembreRepository $repoMembre,Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $mdpHash ): Response
    {   
        

        $membres = $repoMembre->findAll();

        $membre = new Membre;

        $form = $this->createForm(MembreType::class , $membre);
 
        $form->handleRequest($request);
 
        if($form->isSubmitted() && $form->isValid())
        {     
            $hashPassword = $mdpHash->hashPassword( $membre, $membre->getMdp() );

            $membre->setMdp($hashPassword);
            
            $membre->setDateEnregistrement(new \DateTime()); 
             $manager->persist($membre);
             $manager->flush();
 
             $this->addFlash('succes',' Le Membre a bien été Enregistrer');

            
             return $this->redirectToRoute("app_membre");
        } 

       

        return $this->render('membre/index.html.twig', [
            'controller_name' => 'MembreController',
            'membres' => $membres ,
            'FormMembre' => $form->createView()
        ]);
    }

    #[Route('/membre/update/{id}', name: 'update_membre')]
    public function update(Request $request, MembreRepository $repoMembre,  EntityManagerInterface $manager)
    {
        
       $membre = new Membre;
       $form = $this->createForm(MembreType::class, $membre);
       $form->handleRequest($request);
       
         

       if($form->isSubmitted() && $form->isValid())
       {    
         
            $manager->persist($membre);
            $manager->flush();
            
            $this->addFlash('succes',' Le Membre' . $membre->getId() . 'a bien été modifier');

            return $this->redirectToRoute("app_membre");
       } 


 
        return $this->render('membre/update.html.twig', [
                "formMembre" => $form->createView(),
                'membre' => $membre,
                
             ]);
    }


    #[Route('/membre/delete/{id}', name: 'delete_membre')]
    public function delete(Membre $membre, EntityManagerInterface $manager)
    {
      

       $id = $membre->getId();

       $manager->remove($membre);
       $manager->flush();

       $this->addFlash("Succes","le membre N°". $id . "a bien été supprimer");
       return $this->redirectToRoute("app_membre");
     

}


#[Route('/membre/detail/{id}', name: 'details_membre')]
public function membre_detail($id, MembreRepository $reposM){


  $membre = $reposM->find($id);

  return $this->render("membre/details.html.twig",[
   "details" => $membre
  ]);

}

}