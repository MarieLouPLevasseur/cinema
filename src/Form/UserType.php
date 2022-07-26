<?php

namespace App\Form;

use App\Entity\User;
use Attribute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('username')
            ->add('role',ChoiceType::class,[
                'choices'  => [
                    'administrateur' => 'ROLE_ADMIN',
                    'manager' => 'ROLE_MANAGER',
                    'utilisateur' => 'ROLE_USER',
                ],
            ])
            ->add('password', null,[
                // ! mettre le password non lisible meme pour l'administrateur
                'data' => ' ',
                'required'   => true,
                // 'attr'=>['always_empty'=>true,]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
