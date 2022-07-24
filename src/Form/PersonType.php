<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // on peut personnalisé les champs 
        // 1 = propriété du champ de la table
        // 2 = le type (si null, mais par défaut le champ de type attendu dans la BDD
        // ici par défaut il affiche du texte sinon on peu mettre TextAreaType::class ou TextType::class (en faisant le use de la class)
        $builder
        ->add('firstname', null, [
            'label' => 'Prénom',
            // permet d'enlever le require dans l'input
            'required' => false,
            // permet d'ajouter une classe au formulaire pour agit sur le CSS
            // 'attr' => ['class' => "toto"]


        ])
        ->add('lastname')
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
