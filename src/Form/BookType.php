<?php

namespace App\Form;

use App\Entity\Book;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Représente le « cerveau » de notre formulaire. C'est celui qui contient
 * la configuration du formulaire.
 */
class BookType extends AbstractType

{

    /**
     * Cette méthode permet de configurer les champs de notre formulaire. Par exemple
     * si nous avons une champ pour le titre c'est ici qu'il faut le rajouter.
     * 
     * Pour configurer un champs, symfony utilise un objet c'est la FormBuilderInterface.
     * Dans cette objet nous pouvons utiliser la méthode `add` afin d'ajouter des champs.
     * 
     * IMPORTANT : Pour ajouter un champ, il faut que notre `data_class` (notre livre) posséde
     * la donnée.
     * 
     * La méthode `add` accépte 3 paramètres :
     * 1. C'est le nom du champs (doit corespondre à la nom d'une propriété de notre entité)
     * 2. C'est le type du champs (Il en existe un bon paquet : https://symfony.com/doc/current/reference/forms/types.html)
     * 3. Ce sont les options du champs de formulaire
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, ['label' => 'Titre du livre:',])
            ->add('description',TextareaType::class, ['label' => 'Description du livre:',])
            ->add('genre',ChoiceType::class, [
                 'choices' => [
                    'Fantasy' => 'fantasy',
                    'Science Fiction' => 'sci-fi',
                    'Romance' => 'romance',
                    'Mystery' => 'mystery',
                    'Autobiography' => 'autobiography',
                ],
                'placeholder' => 'Choose a genre',
                'required' => true,
            ])
            
            ->add('price',NumberType::class, ['label' => 'Price du livre',])
       
            ->add('submit',SubmitType::class, ['label' =>'Envoyer'])

        ;
    }

    /**
     * cette methode permet de configurer les option de la balise(form) de notre foumulaire
     * par exemple nous pouvons choisir la methode de notre formulaires.
     * cette method accepte un parametre, c'est l'optionResolver, cet objet nous permet de choir les option de notre balise form
     */

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}