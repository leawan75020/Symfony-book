<?php

namespace App\Controller;

use DateTime;
use App\Entity\Book;
use App\Form\BookType;
use PhpParser\Builder\Method;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;
/**
 * Controller permettant de gerer les livres de notre app. nous retrouvons 4 routes, la creation, mis a jour, delete, et la listes 
 */

class AdminBookController extends AbstractController

{
    /**
     * test si la route est fctet apres on peut modify  */   
    // #[Route('/admin/livres', name: 'app_admin_book_index')]
    // public function index(): Response
    // {
        
    //     //affichage de la vue qui contient le formulaire
    //     return $this->render('admin_book/index.html.twig',[
    //         'controller_name' => 'AdminBookController',
            
    //     ]);
    // }
    /**
     * Methode permettant de créer new livre
     */
    #[Route('/admin/livres/new', name: 'app_admin_book_create')]
    public function create(Request $request, BookRepository $repository): Response
    {

        //creation d'un formulaire
        $form = $this->createForm(BookType::class);
        // 'app\\form\\BookType'
        
        $form->handleRequest($request);

        //je veux test si le formulaire a eteit envoyée
        if($form->isSubmitted() && $form->isValid()){
            dump('ok');
            // //recupérer les donnée envoyée champs du formulaire
            // $title = $request->request->get('title');
            // $description = $request->request->get('description');
            // $genre = $request->request->get('genre');
            // $createdAt = $request->request->get('createdAt');
            // $updatedAt = $request->request->get('updatedAt');

        //créer l'objet book avec les champs du form
            // $book = new Book();
            // $book->setTitle($title);
            // $book->setDescription($description);
            // $book->setGenre($genre);
            // $today = new DateTime();

            $book = $form->getData();//recuperer le book du form

            //https://www.php.net/manual/fr/class.datetime
            //$today = new DateTime();
            //$today->format('d/m/Y H:i')
            //$hier = DateTime::createFromFormat('Y-m-d H:i:s','23-03-20 12:50:08', 2 facon de le metter le date)
            $book->setCreatedAt(new DateTime());
            $book->setUpdatedAt(new DateTime());


            //enregistrer la book dans la BD via le repository
            $repository->save($book, true);
            //redirection vers la liste des books
            return $this->redirectToRoute('app_admin_book_list');
        }
        //affichage de la vue qui contient le formulaire
        return $this->render('admin_book/create.html.twig',[
            'form' => $form->createView(),
        ]);
        
    }

    #[Route('/admin/livres/list', name:'app_admin_book_list')]
    public function list( bookRepository $repository) :Response
    {
        //recuperer la liste des book da la BD via le repo

        $books = $repository->findAll();
        //afficher la list dans la twig ['books'=> $books],on envoie a twig tous les livres
        return $this->render('admin_book/list.html.twig', ['books'=> $books]);
    }

    #[Route('/admin/livres/{id}/modify', name:'app_admin_book_update')]
    public function update( Book $book, Request $request,bookRepository $repository) :Response
    {

    // #[Route('/admin/livres/{id}/modify', name:'app_admin_book_update')]
    // public function update( int $id, bookRepository $repository, Request $request) :Response
    // {
        //recupere la book avec l'id 
        // $book = $repository->find($id);
        

        //tester si le form est envoyé (Request::METHOD_POST)eviter de mal tape
        if($request->isMethod('POST')){
             //recupérer les champs du formulaire
            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $genre = $request->request->get('genre');
            

        //modify l'objet book avec les champs du form
            $book 
            ->setTitle($title)
            ->setDescription($description)
            ->setGenre($genre)
            ->setUpdatedAt( new DateTime());
            

            //enregistrer les donnée dans la BD  via le repo
             $repository->save($book, true);
            //redirection vers la liste des books
            return $this->redirectToRoute('app_admin_book_list');
        }
        //(1 etap sur la fin )affichage du form de modify
        return $this->render('admin_book/update.html.twig',[
             'book' => $book
        ] );
    } 
    
    #[Route('/admin/livres/{id}/delete', name:'app_admin_book_remove')]
    public function remove( int $id, bookRepository $repository) :Response
    {
        //recupere la book a del selon l'id 
        $book = $repository->find($id);

        //delete la book de la BD via le repo
        $repository->remove($book, true);
        //redirection vers la liste des books
       
        return $this->redirectToRoute('app_admin_book_list');

    }
}