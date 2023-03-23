<?php

namespace App\Controller;

use DateTime;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAuthorController extends AbstractController
{
    #[Route('/admin/authors/new', name: 'app_admin_author_create')]
    public function create(Request $request, AuthorRepository $repository): Response
    {

        //creation d'un formulaire
        $form = $this->createForm(AuthorType::class);
        // 'app\\form\\authorType'
        // Je remplie le formulaire avec les données saisie par l'utilisateur
        $form->handleRequest($request);

        //je veux test si le formulaire a eteit envoyée
        if($form->isSubmitted() && $form->isValid()){
                     
            $author = $form->getData();//recuperer le author du form
          
            $author->setCreatedAt(new DateTime());
            $author->setUpdatedAt(new DateTime());


            //enregistrer la author dans la BD via le repository
            $repository->save($author, true);
            //redirection vers la liste des authors
            return $this->redirectToRoute('app_admin_author_list');
        }
        //affichage de la vue qui contient le formulaire
        return $this->render('admin_author/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/authors/list', name:'app_admin_author_list')]
    public function list( authorRepository $repository) :Response
    {
        //recuperer la liste des author da la BD via le repo

        $authors = $repository->findAll();
        //afficher la list dans la twig ['authors'=> $authors],on envoie a twig tous les livres
        return $this->render('admin_author/list.html.twig', ['authors'=> $authors]);
    }

    #[Route('/admin/authors/{id}/modify', name:'app_admin_author_update')]
    public function update( Author $author, Request $request,authorRepository $repository) :Response
    {

    
        //je crer le formulaire
        $form = $this->createForm(AuthorType::class, $author);// before on create vide , mais ici $author permeton recuperer les livres preremplier
        

        //je remplier le form avec les donnée saisir par user
        $form->handleRequest($request);
        //je test le formulaire bien envoyer
        if($form->isSubmitted() && $form->isValid()){
            $repository->save($author->setUpdatedAt(new DateTime()), true);
       
            //redirection vers la liste des authors
            return $this->redirectToRoute('app_admin_author_list');
        }
        //(1 etap sur la fin )affichage du form de modify
        return $this->render('admin_author/update.html.twig',[
             'form' => $form->createView(),
        ] );
    } 
    
    #[Route('/admin/authors/{id}/delete', name:'app_admin_author_remove')]
    public function remove(Author $author, authorRepository $repository) :Response
    {
        //recupere la author a del selon l'id 
        //$author = $repository->find($id);

        //delete la author de la BD via le repo
        $repository->remove($author, true);
        //redirection vers la liste des authors
       
        return $this->redirectToRoute('app_admin_author_list');

    }
}