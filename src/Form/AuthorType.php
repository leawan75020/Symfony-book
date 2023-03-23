<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('title',TextType::class, ['label' => 'Titre du autuer:',])
            ->add('description',TextareaType::class, ['label' => 'Description du auteur:',])
            ->add('nationality',ChoiceType::class, ['label' => 'Nationalité de l\'auteur:',
                 'choices' => [
                    'French' => 'French',
                    'German' => 'German',
                    'Italian' => 'Italian',
                    'Chinesse' => 'Chinesse',
                    'American' => 'American',
                    'English' => 'English',
                ],
                'placeholder' => 'Choose a nationality',
                'required' => true,
            ])
            ->add('submit',SubmitType::class, ['label' =>'Envoyer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}