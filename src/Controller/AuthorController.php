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

class AuthorController extends AbstractController
{
    #[Route('/authors/list', name: 'app_author_list')]
    public function list(AuthorRepository $repository): Response
    {
        $authors = $repository->findAll();
        return $this->render('author/list.html.twig', ['authors'=> $authors]);
    }

    #[Route('/author/{id}', name:'app_author_detail')]
    public function show( Author $author, Request $request,authorRepository $repository) :Response
    {
    
        
        //(1 etap sur la fin )affichage du form du detail
        return $this->render('author/detail.html.twig',[
             'author' => $author,
        ] );
    }
}