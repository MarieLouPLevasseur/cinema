<?php

namespace App\Command;

use App\Utils\MySlugger;
use Doctrine\ORM\EntityManager;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MovieSlugifyUnsluggedCommand extends Command
{
    protected static $defaultName = 'app:movie:slugify-unslugged';
    protected static $defaultDescription = 'A command to slugify unslugged movies';
    private $slugger;
    private $movieRepo;
    private $entityManager;


     // injection dans le construct de NOTRE service pour mettre le slug
     public function __construct(
         MySlugger $mySlugger,
         MovieRepository $movieRepository,
         EntityManagerInterface $entityManager)
    {
        $this->movieRepo = $movieRepository;

        $this->entityManager = $entityManager;
        $this->mySlugger = $mySlugger;

        // pour initialiser correctement une commande, il faut exécuter le code du constructeur parent
        parent::__construct();

    }


    protected function configure(): void
    {
        $this
            // ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            // nom commande, raccourci, valeur attendu optionnelle, nom de l'option, valeur par défaut
            ->addOption('movie-count', 'c', InputOption::VALUE_OPTIONAL, 'Number of movies to update ( default is 5)', 5)

            // option pour mettre en minuscule (nécessite le setToLower dans la classe service MySlugger)
            ->addOption('tolower', 'l', InputOption::VALUE_NONE, 'Force slugs to towercase')
            // argument pour choisir le nombre de movie à modifier
            ->addArgument('movie-count', InputArgument::OPTIONAL, 'Number of movies to update ( default is 5)', 5)

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // gère 
        $numberOfMoviesToUpdate = $input->getOption('movie-count');

        // permet de gérer l'option lower
        $toLower = $input->getOption('tolower');
        $this->mySlugger->setToLower($toLower);

        $io->note("Updating {$numberOfMoviesToUpdate} movies");


        // récupérer les movies qui n'ont pas de slug (le bon nombre)
            // $allmovies= $manager->getRepository(Movie::class)->findAll();
            // $allmovies=  $this->$manager->getRepository(Movie::class)->findAll();
            $movieList = $this->movieRepo->findBy(['slug' => ''], [], $numberOfMoviesToUpdate);
            // dump($movieList);


        // sluggifier le titre pour chaque movie
            foreach($movieList as $currentMovie){

                // if (empty($currentMovie->slug)){

                    $io->note('slugifing movie ' . $currentMovie->getId());

                    $slugifiedTitle = $this-> mySlugger->slugify($currentMovie->getTitle());
                    $currentMovie->setSlug($slugifiedTitle);
                // }


            }
        //   ? enregistrer en BDD
        $this->entityManager->flush();


        $io->success("Yaii job done for ${numberOfMoviesToUpdate} movies !");

        return Command::SUCCESS;
    }
}
