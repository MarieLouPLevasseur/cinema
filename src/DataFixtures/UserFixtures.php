<?php

namespace App\DataFixtures;

use App\Entity\Review;
use App\Entity\Movie;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
// !! n'ayant pas le FAKER d'installer, cette fixture ne peut pas fonctionner. Récupérer à titre d'exemple. 
// ! ne pas lancer en load
    public function getDependencies()
    {
        return [
            AppFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $nbUser = 55;

        $allMovies = $manager->getRepository(Movie::class)->findAll();

        for( $i = 0; $i < $nbUser; $i++)
        {
            $userObj = new User();
            $userObj->setEmail($faker->unique()->email());
            $userObj->setUsername($faker->firstName() . $faker->numberBetween());
            $userObj->setRole('USER');

            // boucle qui associe la userne à un ou plusieurs movies grace à un review
            $nbReview = $faker->numberBetween(0, 3);
            for($j = 1; $j <= $nbReview; $j++ )
            {
                $reviewObj = new Review();
                $reviewObj->setUser($userObj);

                // récupérer un movie au hasard pour l'associer
                // si c'est le meme movie c'est pas grave l'acteur aura deux roles dans le film !
                // $randMovieIdx = mt_rand(0, sizeof($allMovies) - 1);
                $randomMovie = $faker->randomElement($allMovies);

                $reviewObj->setMovie($randomMovie);
                $reviewObj->setContent($faker->realText());
                $reviewObj->setRating($faker->numberBetween(1, 5));

                $manager->persist($reviewObj);
            }

            $manager->persist($userObj);
        }

        $manager->flush();
    }


}