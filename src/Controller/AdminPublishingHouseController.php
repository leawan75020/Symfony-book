<?php

namespace App\Controller;

use DateTime;
use App\Entity\PublishingHouse;
use App\Form\PublishingHouseType;
use App\Repository\PublishingHouseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPublishingHouseController extends AbstractController
{
    #[Route('/admin/publishingHouses/new', name: 'app_admin_publishing_house_create')]
    public function create(Request $request, PublishingHouseRepository $repository): Response
    {

        //creation d'un formulaire
        $form = $this->createForm(PublishingHouseType::class);
        // 'app\\form\\publishingHouseType'
        // Je remplie le formulaire avec les données saisie par l'utilisateur
        $form->handleRequest($request);

        //je veux test si le formulaire a eteit envoyée
        if($form->isSubmitted() && $form->isValid()){
                     
            $publishingHouse = $form->getData();//recuperer le publishingHouse du form
          
            $publishingHouse->setCreatedAt(new DateTime());
            $publishingHouse->setUpdatedAt(new DateTime());


            //enregistrer la publishingHouse dans la BD via le repository
            $repository->save($publishingHouse, true);
            //redirection vers la liste des publishingHouses
            return $this->redirectToRoute('app_admin_publishing_house_list');
        }
        //affichage de la vue qui contient le formulaire
        return $this->render('admin_publishing_house/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/publishingHouses/list', name:'app_admin_publishing_house_list')]
    public function list( PublishingHouseRepository $repository) :Response
    {
        //recuperer la liste des publishingHouse da la BD via le repo

        $publishingHouses = $repository->findAll();
        //afficher la list dans la twig ['publishingHouses'=> $publishingHouses],on envoie a twig tous les livres
        return $this->render('admin_publishing_house/list.html.twig', ['publishingHouses'=> $publishingHouses]);
    }

    #[Route('/admin/publishingHouses/{id}/modify', name:'app_admin_publishing_house_update')]
    public function update( PublishingHouse $publishingHouse, Request $request,PublishingHouseRepository $repository) :Response
    {

    
        //je crer le formulaire
        $form = $this->createForm(PublishingHouseType::class, $publishingHouse);// before on create vide , mais ici $publishingHouse permeton recuperer les livres preremplier
        

        //je remplier le form avec les donnée saisir par user
        $form->handleRequest($request);
        //je test le formulaire bien envoyer
        if($form->isSubmitted() && $form->isValid()){
            $repository->save($publishingHouse->setUpdatedAt(new DateTime()), true);
       
            //redirection vers la liste des publishingHouses
            return $this->redirectToRoute('app_admin_publishing_house_list');
        }
        //(1 etap sur la fin )affichage du form de modify
        return $this->render('admin_publishing_house/update.html.twig',[
             'form' => $form->createView(),
        ] );
    } 
    
    #[Route('/admin/publishingHouses/{id}/delete', name:'app_admin_publishing_house_remove')]
    public function remove( PublishingHouse $publishingHouse, PublishingHouseRepository $repository) :Response
    {
        //recupere la publishingHouse a del selon l'id 
        

        //delete la publishingHouse de la BD via le repo
        $repository->remove($publishingHouse, true);
        //redirection vers la liste des publishingHouses
       
        return $this->redirectToRoute('app_admin_publishing_house_list');

    }
}