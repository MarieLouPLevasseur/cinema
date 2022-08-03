<?php

namespace App\Form;

use Attribute;
use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use App\EventSubscriber\PasswordShowSubscriber;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'label' => 'Email',
        ])
            ->add('username', null, [
                'label' => 'Pseudo',
            ])
            ->add('role', ChoiceType::class, [
                'label' => 'Rôle',
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Manager' => 'ROLE_MANAGER',
                    'Utilisateur' => 'ROLE_USER',
                ],
                "expanded" => true
            ])
            // ->add('password', RepeatedType::class, [
            //     'type' => PasswordType::class,
            //     'invalid_message' => 'Les champs ne sont pas identiques',
            //     'first_options'  => ['label' => 'Mot de passe'],
            //     'second_options' => ['label' => 'Resaisissez votre mot de passe'],
            // ])
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                [$this, 'onPreSetDataPassword']
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public  function onPreSetDataPassword (FormEvent $event) {
        $user = $event->getData();
        $form = $event->getForm();

        // dd($user, $form);
        if (! is_null($user->getId()))
        {
            $form->remove('password');
            $form->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les champs ne sont pas identiques',
                'first_options'  => [
                    'label' => 'Mot de passe',
                    'attr' => ['placeholder' => 'laisser vide si inchangé'],
                ],
                'second_options' => ['label' => 'Resaisissez votre mot de passe'],

                 // on indique qu'on ne veut pas que le champs soit géré pour l'affichage
        // si mdp non changé, les données ne seront pas modifiées
        // si mdp changé par l'utilisateur, alors on le gèrera sous condition dans le controller
                'mapped' => false,
            ]);
        }
    }
   
}
