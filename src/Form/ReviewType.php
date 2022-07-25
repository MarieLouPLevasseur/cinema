<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
    // ? CONTENT
        // ligne 1: type par défaut (null) sinon préciser ce qu'on veut
        // ligne 2: label: permet de changer le nom sur l'affichage du formulaire
        ->add('content', null, [
            'label' => 'Critique'
        ])
    // ? RATING
        // options de choix pour créer une liste déroulante
        ->add('rating', ChoiceType::class, [
            
            'label' => 'Note',
            // permet de faire une liste de choix,
            // valeur 1 correspond à ce qui est proposé à l'utilisateur
            // valeur 2: donné qui sera enregistré en BDD 
                // symfo vérifie que les valeurs sont parmi les 5 attendues (impossible de mettre 10 en trichan par exemple)
            'choices' => [
                'Excellent'       => 5,
                'Très bon'        => 4,
                'Bon'             => 3,
                'Peu mieux faire' => 2,
                'A éviter'        => 1,
            ],
            // permet de faire des boutons radio (sinon liste par défaut avec les choix)
            'expanded' => true,
            // permet la sélection de champs multiples
            'multiple' => false, // un ou plusieurs éléments sélectionnables


        ])
        ->add('reactions', ChoiceType::class, [
            'label' => 'Ce film vous a fait:',
            'choices' => [
                "Rire" => 'smile',
                "Pleurer" => 'cry',
                "Réfléchir" => 'think',
                "Dormir" => 'sleep',
                "Rêver" => 'dream'
            ],
            'expanded' => true, // un ou plusieurs widget affichés
            'multiple' => true, // un ou plusieurs éléments sélectionnables
        ])
        // ici pas besoin de l'heure donc on modifie le type en DateType::class
        ->add('watchedAt', DateType::class, [
            'label' => 'Vu le',
            // permet de faire une sélection de la date avec le petit calendrier
            'widget' => 'single_text',
            'html5' => true, // valeur par défaut
            'input' => 'datetime_immutable',
            // si l'utilisateur ne rempli pas alors que valeur Not Null en BDD
            'empty_data' => ""

        ])
        ->add('user', null, [
            'label' => 'Utilisateur'
        ])
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
