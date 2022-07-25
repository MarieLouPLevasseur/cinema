<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isan')
            ->add('title', null,[
                'label' => 'Titre du film'

            ])
            ->add('duration', null,[
                'label' => 'Durée en minutes'

            ])
            ->add('releasedAt', DateType::class, [
                'label' => 'Date de sortie',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',

            ])
            ->add('summary', null,[
                'label' => 'Résumé',

            ])
            ->add('synopsis')
            ->add('poster', null, [
                'label' => 'Poster/image au format URL'

            ])
            // ->add('rating')
            ->add('genres')

            // ->add('genres', EntityType::class, [
            //     'class' => Genre::class,
            //     'choice_label' => 'name',
            //     'multiple' => true,
            //     'expanded' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
