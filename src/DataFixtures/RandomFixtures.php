<?php

namespace App\DataFixtures;

use App\Entity\Person;
use App\Entity\Casting;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RandomFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [
            AppFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {

        // TODO ajouter les fakers 
        // composer require fakerphp/faker
        // $faker = \Faker\Factory::create();


        $nbPerson = 100;
        // $product = new Product();
        // $manager->persist($product);
        // $allMovies = $this->getReference('movie-list');
        $allMovies = $manager->getRepository(Movie::class)->findAll();

        for( $i = 0; $i < $nbPerson; $i++)
        {
            $personObj = new Person();

        // TODO Ajouter les Fakers
        // $personObj->setFirstname($faker->firstName());
        // $personObj->setLastname($faker->lastName());

            $personObj->setFirstname(uniqid('firstname-'));
            $personObj->setLastname(uniqid('lastname-'));

            // boucle qui associe la personne à un ou plusieurs movies grace à un casting
        // TODO Ajouter les Fakers
        // $nbCasting = $faker->numberBetween(0, 5);

            $nbCasting = mt_rand(0, 5);
            for($j = 1; $j <= $nbCasting; $j++ )
            {
                $castingObj = new Casting();
                $castingObj->setPerson($personObj);

                // récupérer un movie au hasard pour l'associer
                // si c'est le meme movie c'est pas grave l'acteur aura deux roles dans le film !
            // TODO Ajouter les Fakers
            // $randomMovie = $faker->randomElement($allMovies);


                $randMovieIdx = mt_rand(0, sizeof($allMovies) - 1);
                $randomMovie = $allMovies[$randMovieIdx];

                $castingObj->setMovie($randomMovie);
                $castingObj->setCreditOrder($j);
            // TODO Ajouter les Fakers
            // $castingObj->setRole($faker->name());


                $castingObj->setRole(uniqid('role-'));

                $manager->persist($castingObj);
            }

            $manager->persist($personObj);
        }

        $manager->flush();
    }


}
