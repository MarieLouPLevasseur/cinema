<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Season;
use DateTimeImmutable;
use App\Entity\Casting;
use App\Entity\Review;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       

    // ********** GENRE: name **********

        $genres = [
            "Action",
            "Animation",
            "Aventure",
            "Comédie",
            "Dessin animé",
            "Documentaire",
            "Drame",
            "Espionnage",
            "Famille",
            "Fantastique",
            "Historique",
            "Policier",
            "Romance",
            "Science-fiction",
            "Thriller",
            "Western",
        ];
        //  $genreKeyRandom = (array_rand($genres));
        //     $genreDefault = $genres[$genreKeyRandom];
    
        // création d'un tableau pour réutilisation des indexations pour les clés étrangères
        $genreObjArray = [];

        foreach ($genres as $currentGenre) {
            $genreObj = new Genre();
            $genreObj->setName($currentGenre);
        
            // md5 permet de faire un hachage (une espece de token) pour s'assurer que les clés sont uniques
            // permet d'avoir pour chaque genre une chaine de caractère
            // différente ET qui ne contient que des chiffres et des lettres

            $genreObjArray[md5($currentGenre)] = $genreObj;

            $manager->persist($genreObj);
        }

        // *************DONNES EN DOUBLON*****************************

        // **** CASTING (personnages d'un film: person_id, role, credit_order, movie_id *********

        $roles =        [
        //game of throne
                "Daenerys Targaryen",
                "Sansa Stark",
                "Jon Snow",
                "Arya Stark",
                "Cersei Lannister",
                "Khal Drogo",
                "Tyrion Lannister",
                "Brienne de Torth, Brienne",
                "Ygrid",
                "Robb Stark",
                "Margaery Tyrell",
                "Oberyn Martell",
                "Jaime Lannister",
                "Theon Greyjoy",
                "Bran Stark",
                "Missandei",
                "Samwell Tarly",
                "Dickon Tarly",
        // Da Vinci Code
                "Robert Langdon",
                "Sophie Neveu",
                "Silas",
                "Bézu Fache",
                "Sir Leigh Teabing",
                "Manuel Aringarosa",
        // Bug's Life
                "Harry le moustique",
                "Heimlich",
                "Bug Zapper Bug ",
                "Tilt",
                "Le Borgne",
                "Lilipuce",
                "Princesse Atta",
        // Aline
                "Aline Dieu",
                "Guy-Claude Kamar",
                "Sylvette",
                "Anglomard",
        // Stranger Things
                "Onze",
                "Mike Wheeler",
                "Lucas Sinclair",
                "Will Byers",
                "Max",
        //Ghostbuster
                "Dr Peter Venkman",
                "Dr Raymond Stantz",
                "Dr Egon Spengler",
                "Dana Barrett",
                "Winston Zeddemore",
                "Janine Melnitz",
                "Louis Tully",
        // le Grinch
                "Le Grinch",
                "Cindy Lou Who",
                "Martha May Whovier",
                "Maire Augustus Maywho",
        //the man of earth
                "John Oldman",
                "Harry",
                "Dr. Arthur M. Jenkins",
                "Dan",
                "Edith",
                "Sandy",
                "Linda Murphy",
        //interstellar
                "Joseph Cooper",
                "Amelia Brand",
                "Murphy Cooper",
                "Professeur John Brand",
                "Murphy Cooper",
                "Tom Cooper",
                "Dr Mann",
        // Matrix
                "Thomas A. Anderson, alias « Neo »",
                "Trinity",
                "Morpheus",
                "l'agent Smith",
                "l'Oracle",
                "Cypher ou Mr Reagan",
                "Tank",
                "le Mulot",
                "Switch",
                "Apoc",
                "Dozer",
                "l'agent Brown",
                "l'agent Jones",
        // Starship troopers
                "Carmen Ibanez",
                "Dizzy Flores",
                "Johnny Rico",
                "Ace Levy",
                "Carl Jenkins ",
                "Sergeant Charles Zim ",
                "Pilot Cadet Stack Lumbreiser",
        // Thor
                "Thor",
                "Jane Foster / The Mighty Thor",
                "Gorr le Boucher",
                "Valkyrie",
                "Zeus",
                "Sif",
                "Peter Quill / Star-Lord",
                "Dave",
                "Drax",
        // Truman Show
                "Truman Burbank",
                "Meryl Burbank, Hannah Gill",
                "Christof",
                "Lauren Garland",
                "Marlon",
        // La cité de la peur
                "Serge Karamazov",
                "Odile Deray",
                "Simon Jérémi",
                "Le commissaire Patrick Bialès",
                "Emile Gravier",
                "La veuve joyeuse",
        // Django unchained
            "Frankie",
            "Django",
            "Docteur King Schultz",
            "Calvin Candie",
            "Stephen",
            "Broomhilda von Shaft",
            "Big Daddy",
        ];
      

        // **** PERSON (acteur d'un film : firstname, lastname) *********
        $persons =[
        // Game of Throne
            [
            "firstname" =>"Emilia",     //   Daenerys Targaryen
            "lastname"  =>"Clarke",
            ],
            [
            "firstname" =>"Sophie",     //   Sansa Stark
            "lastname"  =>"Turner",
            ],
            [
            "firstname" =>"Kit",        //    Jon Snow
            "lastname"  =>"Harington",
            ],
            [
            "firstname" =>"Maisie",     //     Arya Stark
            "lastname"  =>"Williams",
            ],
            [
            "firstname" =>"Lena",       //     Cersei Lannister
            "lastname"  =>"Headey",
            ],
            [
            "firstname" =>"Jason",      //     Khal Drogo
            "lastname"  =>"Momoa",
            ],
            [
            "firstname" =>"Peter",      //     Tyrion Lannister
            "lastname"  =>"Dinklage",
            ],
            [
            "firstname" =>"Gwendoline", //    Brienne de Torth, Brienne
            "lastname"  =>"Christie",
            ],
            [
            "firstname" =>"Rose",       //    Ygrid
            "lastname"  =>"Leslie",
            ],
            [
            "firstname" =>"Richard",    //     Robb Stark
            "lastname"  =>"Madden",
            ],
            [
            "firstname" =>"Natalie",    //     Margaery Tyrell
            "lastname"  =>"Dormer",
            ],
            [
            "firstname" =>"Pedro",      //     Oberyn Martell
            "lastname"  =>"Pascal",
            ],
            [
            "firstname" =>"Nikolaj",    //    Jaime Lannister
            "lastname"  =>"Coster-Waldau",
            ],
            [
            "firstname" =>"Alfie",      //     Theon Greyjoy
            "lastname"  =>"Allen",
            ],
            [
            "firstname" =>"Isaac",      //     Bran Stark
            "lastname"  =>"Hempstead-Wright",
            ],
            [
            "firstname" =>"Nathalie",  //    Missandei
            "lastname"  =>"Emmanuel",
            ],
            [
            "firstname" =>"John",       //    Samwell Tarly
            "lastname"  =>"Bradley-West",
            ],
            [
            "firstname" =>"Tom",        //     Dickon Tarly
            "lastname"  =>"Hopper",
            ],
        // Da Vinci Code
            [
            "firstname" =>"Tom",        //     Robert Langdon
            "lastname"  =>"Hanks",
            ],
            [
            "firstname" =>"Audrey",     //     Sophie Neveu
            "lastname"  =>"Tautou",
            ],
            [
            "firstname" =>"Paul",        //     Silas
            "lastname"  =>"Bettany",
            ],
            [
            "firstname" =>"Jean",        //     Bézu Fache
            "lastname"  =>"Reno",
            ],
            [
            "firstname" =>"Ian",        //     Sir Leigh Teabing
            "lastname"  =>"McKellen",
            ],
            [
            "firstname" =>"Alfred",     //    Manuel Aringarosa
            "lastname"  =>"Molina",
            ],
        // bug's life

            [
            "firstname" =>"John",     //    Harry le moustique
            "lastname"  =>"Lasseter",
            ],
            [
            "firstname" =>"Joe",     //    Heimlich
            "lastname"  =>"Ranft",
            ],
            [
            "firstname" =>"Andrew",     //    Bug Zapper Bug
            "lastname"  =>" Stanton",
            ],
            [
            "firstname" =>"Dave",     //    Tilt
            "lastname"  =>" Foley",
            ],
        
            [
            "firstname" =>"Kevin",     //    Le Borgne
            "lastname"  =>"Spacey",
            ],
            [
            "firstname" =>"John",     //    Lilipuce
            "lastname"  =>"Ratzenberger",
            ],
            [
            "firstname" =>"Julia",     //    Princesse Atta
            "lastname"  =>"Louis-Dreyfus",
            ],
            
        // aline
            [
            "firstname" =>"Valérie",     //    Aline Dieu
            "lastname"  =>"Lemercier",
            ],
            [
            "firstname" =>"Sylvain",     //    Guy-Claude Kamar
            "lastname"  =>"Marcel",
            ],
            [
            "firstname" =>"Danielle",     //    Sylvette
            "lastname"  =>"Fichaud",
            ],
            [
            "firstname" =>"Roc",     //    Anglomard
            "lastname"  =>"LaFortune",
            ],
        // Stranger Things
            [
            "firstname" =>"Millie",     //    Onze
            "lastname"  =>"Bobby Brown",
            ],
            [
            "firstname" =>"Finn",     //    Mike Wheeler
            "lastname"  =>"Wolfhard",
            ],
            [
            "firstname" =>"Caleb",     //    Lucas Sinclair
            "lastname"  =>"McLaughlin",
            ],
            [
            "firstname" =>"Noah",     //    Will Byers
            "lastname"  =>"Schnapp",
            ],
            [
            "firstname" =>"Sadie",     //   Max
            "lastname"  =>"Sink",
            ],
        // Ghosbuster
            [
            "firstname" =>"Bill",     //   Dr Peter Venkman
            "lastname"  =>"Murray",
            ],
            [
            "firstname" =>"Dan",     //  Dr Raymond Stantz
            "lastname"  =>"Aykroyd",
            ],
            [
            "firstname" =>"Harold",     //  Dr Egon Spengler
            "lastname"  =>"Ramis",
            ],
            [
            "firstname" =>"Sigourney",     //  Dana Barrett
            "lastname"  =>"Weaver",
            ],
            [
            "firstname" =>"Ernie",     //  Winston Zeddemore
            "lastname"  =>"Hudson",
            ],
            [
            "firstname" =>"Annie",     //  Janine Melnitz
            "lastname"  =>"Potts",
            ],
            [
            "firstname" =>"Rick",     //  Louis Tully
            "lastname"  =>"Moranis",
            ],
        // Le Grinch
            [
            "firstname" =>"Jim",     //  Le Grinch
            "lastname"  =>"Carrey",
            ],
            [
            "firsname" =>"Taylor",     //  Cindy Lou Who
            "lastname"  =>"Momsen",
            ],
            [
            "firstname" =>"Christine",     //  Martha May Whovier
            "lastname"  =>"Baranski",
            ],
            [
            "firstname" =>"Jeffrey",     //  Maire Augustus Maywho
            "lastname"  =>"Tambor",
            ],
        //The man from earth
            [
            "firstname" =>"David",     //  John Oldman
            "lastname"  =>"Lee Smith",
            ],
            [
            "firstname" =>"John",     //  Harry
            "lastname"  =>"Billingsley",
            ],
            [
            "firstname" =>"William",     //  Dr. Arthur M. Jenkins
            "lastname"  =>"Katt",
            ],
            [
            "firstname" =>"Tony",     //  Dan
            "lastname"  =>"Todd",
            ],
            [
            "firstname" =>"Ellen",     //  Edith
            "lastname"  =>"Crawford",
            ],
            [
            "firstname" =>"Annika",     //  Sandy
            "lastname"  =>"Peterson",
            ],
            [
            "firstname" =>"Alexis",     //  Linda Murphy
            "lastname"  =>"Thorpe",
            ],
        //Interstellar
            [
            "firstname" =>"Matthew",     //  Joseph Cooper
            "lastname"  =>"McConaughey",
            ],
            [
            "firstname" =>"Anne",     //  Amelia Brand
            "lastname"  =>"Hathaway",
            ],
            [
            "firstname" =>"Jessica",     //   Murphy Cooper
            "lastname"  =>"Chastain",
            ],
            [
            "firstname" =>"Michael",     //   Professeur John Brand
            "lastname"  =>"Caine",
            ],
            [
            "firstname" =>"Mackenzie",     //   Murphy Cooper
            "lastname"  =>"Foy",
            ],
            
            [
            "firstname" =>"Timothée",     //   Tom Cooper
            "lastname"  =>"Chalamet",
            ],
            
            [
            "firstname" =>"Matt",     //   Dr Mann
            "lastname"  =>"Damon",
            ],
        // Matrix
            [
            "firstname" =>"Keanu",     //   Thomas A. Anderson, alias « Neo »
            "lastname"  =>"Reeves",
            ],
            [
            "firstname" =>"Carrie-Anne",     //   Trinity
            "lastname"  =>"Moss",
            ],
            [
            "firstname" =>"Laurence",     //   Morpheus
            "lastname"  =>"Fishburne",
            ],
            [
            "firstname" =>"Hugo",     //   l'agent Smith
            "lastname"  =>"Weaving",
            ],
            [
            "firstname" =>"Gloria",     //   l'Oracle
            "lastname"  =>"Foster",
            ],
            [
            "firstname" =>"Joe",     //    Cypher ou Mr Reagan
            "lastname"  =>"Pantoliano",
            ],
            [
            "firstname" =>"Marcus",     //     Tank
            "lastname"  =>"Chong",
            ],
            [
            "firstname" =>"Matt",     //     le Mulot
            "lastname"  =>"Doran",
            ],
        
            [
            "firstname" =>"Belinda",     //     Switch
            "lastname"  =>"McClory",
            ],
            [
            "firstname" =>"Julian",     //     Apoc
            "lastname"  =>"Arahanga",
            ],
            [
            "firstname" =>"Anthony Ray",     //     Dozer
            "lastname"  =>"Parker",
            ],
            [
            "firstname" =>"Paul",     //     l'agent Brown
            "lastname"  =>"Goddard",
            ],
            [
            "firstname" =>"Robert",     //     l'agent Jones
            "lastname"  =>"Taylor",
            ],
        // starship troopers
            [
            "firstname" =>"Denise",     //     Carmen Ibanez
            "lastname"  =>"Richards",
            ],
            [
            "firstname" =>"Dina",     //     Dizzy Flores
            "lastname"  =>"Meyer",
            ],
            [
            "firstname" =>"Casper",     //     Johnny Rico
            "lastname"  =>"Van Dien",
            ],
            [
            "firstname" =>"Jake",     //     Ace Levy
            "lastname"  =>"Busey",
            ],
            [
            "firstname" =>"Neil Patrick ",     //    Carl Jenkins
            "lastname"  =>"Harris",
            ],
            [
            "firstname" =>"Clancy ",     //   Sergeant Charles Zim
            "lastname"  =>"Brown",
            ],
            [
            "firstname" =>"Amy ",     //   Pilot Cadet Stack Lumbreiser
            "lastname"  =>"Smart",
            ],
        // Thor
            [
            "firstname" =>"Chris ",     //   Thor
            "lastname"  =>"Hemsworth",
            ],
            [
            "firstname" =>"Natalie ",     //   Jane Foster / The Mighty Thor
            "lastname"  =>"Portman",
            ],
            [
            "firstname" =>"Christian ",     //   Gorr le Boucher
            "lastname"  =>"Bale",
            ],
            [
            "firstname" =>"Tessa ",     //   Valkyrie
            "lastname"  =>"Thompson",
            ],
            [
            "firstname" =>"Russell ",     //   Zeus
            "lastname"  =>"Crowe",
            ],
            [
            "firstname" =>"Jaimie ",     //   Sif
            "lastname"  =>"Alexander",
            ],
            [
            "firstname" =>"Chris ",     //   Peter Quill / Star-Lord
            "lastname"  =>"Pratt",
            ],
            [
            "firstname" =>"Dave ",     //   Drax
            "lastname"  =>"Bautista",
            ],
        // truman show
            [
            "firstname" =>"Jim ",     //   Truman Burbank
            "lastname"  =>"Carrey",
            ],
            [
            "firstname" =>"Laura ",     //   Meryl Burbank, Hannah Gill
            "lastname"  =>"Linney",
            ],
            [
            "firstname" =>"Ed ",     //  Christof
            "lastname"  =>"Harris",
            ],
            [
            "firstname" =>"Natascha ",     //  Lauren Garland
            "lastname"  =>"McElhone",
            ],
            [
            "firstname" =>"Noah ",     // Marlon
            "lastname"  =>"Emmerich",
            ],
        // la cité de la peur

            [
            "firstname" =>"Alain ",     // Serge Karamazov
            "lastname"  =>"Chabat",
            ],
            [
            "firstname" =>"Chantal ",     // Odile Deray
            "lastname"  =>"Lauby",
            ],
            [
            "firstname" =>"Dominique ",     // Simon Jérémi
            "lastname"  =>"Farrugia",
            ],
            [
            "firstname" =>"Gérard ",     // Le commissaire Patrick Bialès
            "lastname"  =>"Darmon",
            ],
            [
            "firstname" =>"Sam ",     // Emile Gravier
            "lastname"  =>"Karmann",
            ],
            [
            "firstname" =>"Valérie ",     // La veuve joyeuse
            "lastname"  =>"Lemercier",
            ],
        // django unchained
            [
            "firstname" =>"Quentin ",     // Frankie
            "lastname"  =>"Tarantino",
            ],
            [
            "firstname" =>"Jamie",     // Django
            "lastname"  =>"Foxx",
            ],
            [
            "firstname" =>"Christoph",     // Docteur King Schultz
            "lastname"  =>"Waltz",
            ],
            [
            "firstname" =>"Leonardo",     // Calvin Candie
            "lastname"  =>"DiCaprio",
            ],
            [
            "firstname" =>"Samuel",     // Stephen
            "lastname"  =>"L. Jackson",
            ],
            [
            "firstname" =>"Kerry",     // Broomhilda von Shaft
            "lastname"  =>"Washington",
            ],
            [
            "firstname" =>"Don",     // Big Daddy
            "lastname"  =>"Johnson",
            ],
        ];
    //********************FIN DOUBLON **************************** */

    // **** USER (écrit les critiques: email, username, role *********

    $loremFirstName = [
        //garcons
            "Aaron",
            "Antonin",
            "Anthony",
            'Ayoub',
            'Bastien',
            'Alan',
            'Aymeric',
            'Bryan',
            'Charles',
            'Elias',
            'Dorian',
            'Dylan',
            'Alex',
            'Augustin',
            'Alban',
            'Gabin',
            'Guillaume',
            'Samuel',
            'Simon',
            'Kevin',
            'Sacha',
            'Tristan',
            'Victor',
            'Jordan',
            'Killian',
            'Marius',
            'Vincent',
        //filles
            'Andrea',
            'Audrey',
            'Angele',
            'Adele',
            'Alexia',
            'Amandine',
            'Angelina',
            'Chiara',
            'Claire',
            'Coralie',
            'Elsa',
            'Agathe',
            'Constance',
            'Eleonore',
            'Elisa',
            'Elodie',
            'Fanny',
            "Alice",
            'Anna',
            'Apolline',
            'Candice',
            'Charline',
            'Elise',
            'Emilie',
            'Amelie',
            'Axelle',
            'Capucine',
            'Flavie',
            'Heloise',
            'Emeline',
            'Leonie',
            'Carla',
            'Cassandra',
            'Clarisse',
            'Elina',
            'Clementine',
            'Elena',
            'Marion',
            'Melina',
            'Marine',
            'Melissa',
            'Lise'
        ];

            $loremLastName= [
            "Lawson",
            "Bailey",
            "Espinoza",
            "Stuart",
            "Wyatt",
            "Kerr",
            "Ball",
            "Bradley",
            "Duran",
            "Moody",
            "Alvarado",
            "Boyle",
            "Riley",
            "Castillo",
            "Charles",
            "Dalton",
            "Murray",
            "Eaton",
            "Khan",
            "Leonard",
            "Craig",
            "Villanueva",
            "Wise",
            "Goodman",
            "Stein",
            "Solomon",
            "Haney",
            "Beard",
            "Rojas"
        ];

        $loremRole = ["admin", "co-admin", "simple_user"];
    //tableau des objects users
        $allUsers =[];

        for ($i = 0; $i < 55; $i++) {
            $userObj = new User();
            $userFirstNameKeyRandom = (array_rand($loremFirstName));
            $userFirstNameDefault = $loremFirstName[$userFirstNameKeyRandom];

            $userLastNameKeyRandom = (array_rand($loremFirstName));
            $userLastNameDefault = $loremFirstName[$userLastNameKeyRandom];

            $userRoleKeyRandom = (array_rand($loremRole));
            $userRoleDefault = $loremRole[$userRoleKeyRandom];
            
            $userObj->setUsername($userFirstNameDefault." ".$userLastNameDefault);
            $userObj->setEmail($userFirstNameDefault.".".$userLastNameDefault."@gmail.com");
            $userObj->setRole($userRoleDefault);

            // mise en tableau pour réutilisation ultérieure
            $allUsers[]= $userObj;

            $manager->persist($userObj);
        }

    // **** REVIEW 3-4 par users (critiques film: movie_id, user_id, content, rating *********

                // **** Reviews *********
                $LoremReviewArray = [];
                $LoremReviewArray[] = 'Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium. Qui animated corpse, cricket bat max brucks terribilem incessu zomby. The voodoo sacerdos flesh eater, suscitat mortuos comedere carnem virus.';
                $LoremReviewArray[] = 'Hamburger ribeye t-bone, meatball boudin ham pork belly shank picanha bresaola. Cupim sausage sirloin tri-tip, flank chuck tenderloin tongue leberkas bacon ham spare ribs pig. Sausage pig sirloin, ham hock picanha ham pork belly bacon bresaola pork strip steak landjaeger jerky salami. Burgdoggen short ribs rump jowl kielbasa salami. Capicola meatball boudin leberkas burgdoggen. Alcatra flank ball tip, kevin filet mignon bresaola t-bone chuck turkey chicken beef pork belly burgdoggen fatback.';
                $LoremReviewArray[] = 'Fruitcake apple pie fruitcake gingerbread chocolate bar bear claw candy croissant marzipan. Danish oat cake gingerbread chocolate bar muffin marshmallow chocolate sweet jelly beans. Chocolate caramels bonbon gummies chocolate bar.';      
                $LoremReviewArray[] = "Cibolac de verrat de mangeux d'marde de crucifix d'esprit de câline de bine de gériboire de p'tit Jésus de caltor de patente à gosse de mosus de saintes fesses de cibouleau de bâtard de calvinouche de sacristi de cibole d'astie de cossin de Jésus Marie Joseph de ciboire de mautadine.";
                $LoremReviewArray[] = "Purée de sapristi de charrue d'enfant d'chienne de mosus de taboire de boswell de charogne de viande à chien de sacrament de baptême d'ostifie de bâtard de sacristi d'estique de cimonaque de maudite marde de batèche de mangeux d'marde de calvinouche de ciboire de cibolac.";
                $LoremReviewArray[] = "Baptême de sainte-viarge d'enfant d'chienne de saint-ciarge de viande à chien de bout d'ciarge de cibolac de verrat de marde de calvinouche de charrue de Jésus de plâtre de patente à gosse de charogne de mautadine de bâtard de torrieux de tabarouette de Jésus Marie Joseph de cibole de purée de ciarge";
                $LoremReviewArray[] = "Ostifie d'étole de batince de ciboire de cul de calvinouche de viande à chien de verrat de bout d'viarge de batèche de saint-cimonaque de mosus d'enfant d'chienne d'ostie de gériboire de patente à gosse de cibole de sapristi de cibolac de ciarge de baptême de bâtard.";
                $LoremReviewArray[] = "But I've got news for them, too. And Ashley said that when she was nine years old, her mother got cancer. It is where our union grows stronger. That is why we will honor our agreement with Iraq's democratically-elected government to remove combat troops from Iraqi cities by July, and to remove all our troops from Iraq by 2012. But we can only achieve it together.Thank you, God Bless you, and God Bless the United States of America.";
                $LoremReviewArray[] ="Last time we took up immigration reform, it failed. I love this country, and so do you, and so does John McCain. As a student of history, I also know civilization's debt to Islam. That experience guides my conviction that partnership between America and Islam must be based on what Islam is, not what it isn't. Thank you, and God bless America.";

                // tableau des objets reviews
                $allReviews =[];

                // for ($i = 1; $i <= 50; $i++) {
                //     $ReviewKeyRandom = (array_rand($LoremReviewArray));
                //     $ReviewDefault = $LoremReviewArray[$ReviewKeyRandom];

                //     $reviewObj = new Review();
                //     $reviewObj->setRating(mt_rand(1,5));
                //     $reviewObj->setContent($ReviewDefault);

                //     // Sélection d'un utilisateur aléatoire
                //     $randUserIdx = mt_rand(1, sizeof($allUsers));
                //     $randUserIdx -- ;
                //     // dump(sizeof(($allUsers)));
                //     // dump($randUserIdx);
                //     $randomUser = $allUsers[$randUserIdx];
                //     // dump($randomUser);
                //     $reviewObj->setUser($randomUser);

                //     // mise en tableau pour réutilisation ultérieure
                //     $allReviews[]=$reviewObj;

                //     // ! je pense que c'est ce persiste qui attend le movie ID mais movie Id est déclaré plus bas :-/
                //     // $manager->persist($reviewObj);

                // }
                // dd($allReviews);

        // ********** MOVIES : isan, title, duration (min), summary, released_at, synopsis, poster, rating) **********

        $movies = [
        // bug's life
             [
                'isan' => '',
                'type' => 'Film',
                'title' => 'A Bug\'s Life',
                'released_at' => 1998,
                'duration' => 93,
                'summary' => 'Tilt, fourmi quelque peu tête en l\'air, détruit par inadvertance la récolte de la saison.',
                'synopsis' => 'Tilt, fourmi quelque peu tête en l\'air, détruit par inadvertance la récolte de la saison. La fourmilière est dans tous ses états. En effet cette bévue va rendre fou de rage le Borgne, méchant insecte qui chaque été fait main basse sur une partie de la récolte avec sa bande de sauterelles racketteuses. Tilt décide de quitter l\'île pour recruter des mercenaires capables de chasser le Borgne.',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BNThmZGY4NzgtMTM4OC00NzNkLWEwNmEtMjdhMGY5YTc1NDE4XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',
                'rating' => 3.8,
                'genres' => [
                    'Action',
                    'Animation',
                    'Dessin animé',
                    'Famille',
                ],
                "casting" =>
                [
                "Harry le moustique"=>[
                    [
                        "firstname" =>"John",     //    Harry le moustique
                        "lastname"  =>"Lasseter",
                        ],
                    ],
                "Heimlich"=>[
                    [
                        "firstname" =>"Joe",     //    Heimlich
                        "lastname"  =>"Ranft",
                        ],
                    ],
                "Bug Zapper Bug " =>[
                    [
                        "firstname" =>"Andrew",     //    Bug Zapper Bug
                        "lastname"  =>" Stanton",
                        ],
                    ],
                "Tilt"=>[
                    [
                        "firstname" =>"Dave",     //    Tilt
                        "lastname"  =>" Foley",
                        ],
                    ],
                "Le Borgne"=>[
                    [
                        "firstname" =>"Kevin",     //    Le Borgne
                        "lastname"  =>"Spacey",
                        ],
                    ],
                "Lilipuce"=>[
                    [
                        "firstname" =>"John",     //    Lilipuce
                        "lastname"  =>"Ratzenberger",
                        ],
                    ],
                "Princesse Atta"=>[
                    [
                        "firstname" =>"Julia",     //    Princesse Atta
                        "lastname"  =>"Louis-Dreyfus",
                        ],
                    ],
                ]
            ],
        // GOT
            [
                'isan' => '',
                'type' => 'Série',
                'title' => 'Game of Thrones',
                'released_at' => 2011,
                'duration' => 52,
                'summary' => 'Neuf familles nobles se battent pour le contrôle des terres de Westeros, tandis qu\'un ancien ennemi revient...',
                'synopsis' => 'Il y a très longtemps, à une époque oubliée, une force a détruit l\'équilibre des saisons. Dans un pays où l\'été peut durer plusieurs années et l\'hiver toute une vie, des forces sinistres et surnaturelles se pressent aux portes du Royaume des Sept Couronnes. La confrérie de la Garde de Nuit, protégeant le Royaume de toute créature pouvant provenir d\'au-delà du Mur protecteur, n\'a plus les ressources nécessaires pour assurer la sécurité de tous. Après un été de dix années, un hiver rigoureux s\'abat sur le Royaume avec la promesse d\'un avenir des plus sombres. Pendant ce temps, complots et rivalités se jouent sur le continent pour s\'emparer du Trône de Fer, le symbole du pouvoir absolu.',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BYTRiNDQwYzAtMzVlZS00NTI5LWJjYjUtMzkwNTUzMWMxZTllXkEyXkFqcGdeQXVyNDIzMzcwNjc@._V1_SX300.jpg',
                'rating' => 4.7,
                'genres' => [
                    "Science-fiction",
                    "Thriller",
                    "Espionnage",
                    "Action",
                ],
                'seasons' => [
                    [
                        'number' => 1,
                        'episode_count' => 10
                    ],
                    [
                        'number' => 2 ,
                        'episode_count' => 10
                    ],
                    [
                        'number' => 3,
                        'episode_count' => 10
                    ],
                    [
                        'number' => 4,
                        'episode_count' => 10
                    ],
                    [
                        'number' => 5,
                        'episode_count' => 10
                    ],
                    [
                        'number' => 6,
                        'episode_count' => 10
                    ],
                    [
                        'number' => 7,
                        'episode_count' => 7
                    ],
                    [
                        'number' => 8,
                        'episode_count' => 6
                    ]
                    ],
                "casting" => [
                    "Daenerys Targaryen"=>[
                        [
                            "firstname" =>"Emilia",
                            "lastname"  =>"Clarke",
                            ],
                        ],
                    "Sansa Stark"=>[
                        [
                            "firstname" =>"Sophie",
                            "lastname"  =>"Turner",
                            ],
                        ],
                    "Jon Snow" =>[
                        [
                            "firstname" =>"Kit",        //    Jon Snow
                            "lastname"  =>"Harington",
                            ],
                        ],
                    "Arya Stark" => [
                        [
                            "firstname" =>"Maisie",     //     Arya Stark
                            "lastname"  =>"Williams",
                            ],
                        ],
                    "Cersei Lannister" =>[
                        [
                            "firstname" =>"Lena",       //     Cersei Lannister
                            "lastname"  =>"Headey",
                            ],
                        ],
                    "Khal Drogo" =>[
                        [
                            "firstname" =>"Jason",      //     Khal Drogo
                            "lastname"  =>"Momoa",
                            ],
                        ],
                    "Tyrion Lannister" =>[
                        [
                            "firstname" =>"Peter",      //     Tyrion Lannister
                            "lastname"  =>"Dinklage",
                            ],
                        ],
                    "Brienne de Torth, Brienne" =>[
                        [
                            "firstname" =>"Gwendoline", //    Brienne de Torth, Brienne
                            "lastname"  =>"Christie",
                            ],
                        ],
                    "Ygrid"=>[
                        [
                            "firstname" =>"Rose",       //    Ygrid
                            "lastname"  =>"Leslie",
                            ],
                        ],
                    "Robb Stark" =>[
                        [
                            "firstname" =>"Richard",    //     Robb Stark
                            "lastname"  =>"Madden",
                            ],
                        ],
                    "Margaery Tyrell"=>[
                        [
                            "firstname" =>"Natalie",    //     Margaery Tyrell
                            "lastname"  =>"Dormer",
                            ],
                        ],
                    "Oberyn Martell"=>[
                        [
                            "firstname" =>"Pedro",      //     Oberyn Martell
                            "lastname"  =>"Pascal",
                            ],
                        ],
                    "Jaime Lannister"=>[
                        [
                            "firstname" =>"Nikolaj",    //    Jaime Lannister
                            "lastname"  =>"Coster-Waldau",
                            ],
                        ],
                    "Theon Greyjoy"=>[
                        [
                            "firstname" =>"Alfie",      //     Theon Greyjoy
                            "lastname"  =>"Allen",
                            ],
                        ],
                    "Bran Stark"=>[
                        [
                            "firstname" =>"Isaac",      //     Bran Stark
                            "lastname"  =>"Hempstead-Wright",
                            ],
                        ],
                    "Missandei"=>[
                        [
                            "firstname" =>"Nathalie",  //    Missandei
                            "lastname"  =>"Emmanuel",
                            ],
                        ],
                    "Samwell Tarly"=> [
                        [
                            "firstname" =>"John",       //    Samwell Tarly
                            "lastname"  =>"Bradley-West",
                            ],
                        ],
                    "Dickon Tarly"=>[
                        [
                            "firstname" =>"Tom",        //     Dickon Tarly
                            "lastname"  =>"Hopper",
                            ],
                        ],
                ]
            ],
        // Aline
            [
                'isan' => '',
                'type' => 'Film',
                'title' => 'Aline',
                'released_at' => 2020,
                'duration' => 126,
                'summary' => 'Québec, fin des années 60, Sylvette et Anglomard accueillent leur 14ème enfant : Aline. On lui découvre un don, elle a une voix en or.',
                'synopsis' => 'Québec, fin des années 60, Sylvette et Anglomard accueillent leur 14ème enfant : Aline. Dans la famille Dieu, la musique est reine et quand Aline grandit on lui découvre un don, elle a une voix en or. Lorsqu’il entend cette voix, le producteur de musique Guy-Claude n’a plus qu’une idée en tête… faire d’Aline la plus grande chanteuse au monde. Epaulée par sa famille et guidée par l’expérience puis l’amour naissant de Guy-Claude, ils vont ensemble écrire les pages d’un destin hors du commun.',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BNjUxYTQ3YzItNjU5Ny00ZGM0LWJkMGUtN2FkMWRiNjFlY2ExXkEyXkFqcGdeQXVyMzcwMzExMA@@._V1_SX300.jpg',
                'rating' => 4.0,
                'genres' => [
                    "Documentaire",
                ],
                "casting" =>
                [
                    "Aline Dieu"=>[
                        [
                            "firstname" =>"Valérie",     //    Aline Dieu
                            "lastname"  =>"Lemercier",
                            ],
                        ],
                    "Guy-Claude Kamar"=>[
                        [
                            "firstname" =>"Sylvain",     //    Guy-Claude Kamar
                            "lastname"  =>"Marcel",
                            ],
                        ],
                    "Sylvette"=>[
                        [
                            "firstname" =>"Danielle",     //    Sylvette
                            "lastname"  =>"Fichaud",
                            ],
                        ],
                    "Anglomard"=>[
                        [
                            "firstname" =>"Roc",     //    Anglomard
                            "lastname"  =>"LaFortune",
                            ],
                        ],
                ]
            ],
        // Strangers Thing
            [
                'isan' => '',
                'type' => 'Série',
                'title' => 'Stranger Things',
                'released_at' => 2016,
                'duration' => 50,
                'summary' => '1983, à Hawkins dans l\'Indiana. Après la disparition d\'un garçon de 12 ans dans des circonstances mystérieuses, la petite ville du Midwest est témoin d\'étranges phénomènes.',
                'synopsis' => 'A Hawkins, en 1983 dans l\'Indiana. Lorsque Will Byers disparaît de son domicile, ses amis se lancent dans une recherche semée d’embûches pour le retrouver. Dans leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite. Les garçons se lient d\'amitié avec la demoiselle tatouée du chiffre "11" sur son poignet et au crâne rasé et découvrent petit à petit les détails sur son inquiétante situation. Elle est peut-être la clé de tous les mystères qui se cachent dans cette petite ville en apparence tranquille…',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BN2ZmYjg1YmItNWQ4OC00YWM0LWE0ZDktYThjOTZiZjhhN2Q2XkEyXkFqcGdeQXVyNjgxNTQ3Mjk@._V1_SX300.jpg',
                'rating' => 4.2,
                'genres' => [
                    "Fantastique",
                    "Policier",
                    "Thriller",
                    "Science-fiction",
                ],
                'seasons' => [
                    [
                        'number' => 1,
                        'episode_count' => 8
                    ],
                    [
                        'number' => 2 ,
                        'episode_count' => 9
                    ],
                    [
                        'number' => 3,
                        'episode_count' => 8
                    ],
                    [
                        'number' => 4,
                        'episode_count' => 9
                    ]
                    ],
                "casting" =>
                [
                    "Onze"=>[
                        [
                            "firstname" =>"Millie",     //    Onze
                            "lastname"  =>"Bobby Brown",
                            ],
                        ],
                    "Mike Wheeler"=>[
                        [
                            "firstname" =>"Finn",     //    Mike Wheeler
                            "lastname"  =>"Wolfhard",
                            ],
                        ],
                    "Lucas Sinclair"=>[
                        [
                            "firstname" =>"Caleb",     //    Lucas Sinclair
                            "lastname"  =>"McLaughlin",
                            ],
                        ],
                    "Will Byers"=>[
                        [
                            "firstname" =>"Noah",     //    Will Byers
                            "lastname"  =>"Schnapp",
                            ],
                        ],
                    "Max"=>[
                        [
                            "firstname" =>"Sadie",     //   Max
                            "lastname"  =>"Sink",
                            ],
                        ],
                ]
            ],
        // davinci Code
            [
                'isan' => '',
                'type' => 'Film',
                'title' => 'Da Vinci Code',
                'released_at' => 2006,
                'duration' => 149,
                'summary' => '1983, à Hawkins dans l\'Indiana. Après la disparition d\'un garçon de 12 ans dans des circonstances mystérieuses, la petite ville du Midwest est témoin d\'étranges phénomènes.',
                'synopsis' => "Une nuit, le professeur Robert Langdon, éminent spécialiste de l'étude des symboles, est appelé d'urgence au Louvre : le conservateur du musée a été assassiné, mais avant de mourir, il a laissé de mystérieux symboles... Avec l'aide de la cryptologue Sophie Neveu, Langdon va mener l'enquête et découvrir des signes dissimulés dans les oeuvres de Léonard de Vinci.",
                'poster' => 'https://www.cine-feuilles.ch/storage/app/uploads/public/5a3/d5b/b12/thumb_17976_360_480_0_0_auto.jpg',
                'rating' => 5,
                'genres' => [
                    "Documentaire",
                    "Policier",
                    "Thriller",
                ],
                "casting" =>
                [
                    "Robert Langdon" =>[
                        [
                            "firstname" =>"Tom",        //     Robert Langdon
                            "lastname"  =>"Hanks",
                            ],
                        ],
                    "Sophie Neveu"=>[
                        [
                            "firstname" =>"Audrey",     //     Sophie Neveu
                            "lastname"  =>"Tautou",
                            ],
                        ],
                    "Silas"=>[
                        [
                            "firstname" =>"Paul",        //     Silas
                            "lastname"  =>"Bettany",
                            ],
                        ],
                    "Bézu Fache"=>[
                        [
                            "firstname" =>"Jean",        //     Bézu Fache
                            "lastname"  =>"Reno",
                            ],
                        ],
                    "Sir Leigh Teabing"=>[
                        [
                            "firstname" =>"Ian",        //     Sir Leigh Teabing
                            "lastname"  =>"McKellen",
                            ],
                        ],
                    "Manuel Aringarosa"=>[
                        [
                            "firstname" =>"Alfred",     //    Manuel Aringarosa
                            "lastname"  =>"Molina",
                            ],
                        ],
                ]
            ],
        // ghostbuster
            [
                'type' => 'Film',
                'title' => 'Ghostbusters',
                'duration' => 105,
                'synopsis' => "Les docteurs Peter Venkman, Raymond « Ray » Stantz et Egon Spengler, des chercheurs de l'université Columbia de New York spécialisés en parapsychologie, sont accusés de mener des recherches farfelues. Radiés de leur poste par le doyen de l’université, ils décident alors d'ouvrir une société d'investigations paranormales nommée « SOS Fantômes » (en VO « Ghostbusters »a). Engageant leurs derniers deniers dans cette activité, ils rachètent une ancienne caserne de pompier new-yorkaise à l'abandon, qu'ils rénovent et modifient, et partent chasser les phénomènes paranormaux partout dans la ville au volant de leur Ectomobile (en) « Ecto 1 »,
                                une Cadillac Miller Meteor Futura Duplex blanche décorée au motif de leur société.",
                'summary' => "La soudaine recrudescence de phénomènes paranormaux inquiète les habitants de New York. Des revenants sèment la pagaille dans les rues de la ville ! Peter, Raymond et Egon, trois jeunes chercheurs en parapsychologie, décident de monter leur propre entreprise : SOS Fantômes. Les ectoplasmes n'ont qu'à bien se tenir car nos trois joyeux lurons se feront un plaisir de les capturer à l'aide de leur équipement électronique dernier cri.",
                'poster' => 'https://www.themoviedb.org/t/p/original/srUmxMzDG4g5y0BPzslJUBB9lsr.jpg',
                'rating' => 5,
                'isan' => '',
                'released_at' => '1984-07-31',
                'genres' => [
                    "Action",
                    "Comédie",
                    "Fantastique",
                ],
                "casting" =>
                [
                    "Dr Peter Venkman"=>[
                        [
                            "firstname" =>"Bill",     //   Dr Peter Venkman
                            "lastname"  =>"Murray",
                            ],
                        ],
                "Dr Raymond Stantz"=>[
                    [
                        "firstname" =>"Dan",     //  Dr Raymond Stantz
                        "lastname"  =>"Aykroyd",
                        ],
                    ],
                "Dr Egon Spengler"=>[
                    [
                        "firstname" =>"Harold",     //  Dr Egon Spengler
                        "lastname"  =>"Ramis",
                        ],
                    ],
                "Dana Barrett"=>[
                    [
                        "firstname" =>"Sigourney",     //  Dana Barrett
                        "lastname"  =>"Weaver",
                        ],
                    ],
                "Winston Zeddemore"=>[
                    [
                        "firstname" =>"Ernie",     //  Winston Zeddemore
                        "lastname"  =>"Hudson",
                        ],
                    ],
                "Janine Melnitz"=>[
                    [
                        "firstname" =>"Ernie",     //  Winston Zeddemore
                        "lastname"  =>"Hudson",
                        ],
                    ],
                "Louis Tully"=>[
                    [
                        "firstname" =>"Rick",     //  Louis Tully
                        "lastname"  =>"Moranis",
                        ],
                    ],
                ]
            ],
        // grinch
            [
                'type' => 'Film',
                'title' => 'Le Grinch',
                'duration' => 104,
                'synopsis' => "Le Grinch est un croque-mitaine de poils verts qui arbore un sourire élastique jusqu'aux oreilles. Misanthrope exilé, il vit depuis 53 ans dans une grotte sur le mont Crumpit avec son chien Max. Il se nourrit de jus de laitue, d'huile de castor et de lait tourné, et a un coeur trois fois trop petit pour aimer qui que ce soit.
                                Recueilli par deux charmantes vieilles dames, le Grinch aurait aimé avoir une enfance et une scolarité normales, avoir des copains et flirter avec la gentille Martha qui le couvait d'un oeil tendre. Mais les petits Whos se comportèrent si cruellement avec lui qu'ils le contraignirent à l'exil.
                                C'est ainsi que le Grinch devint un ermite grognon et un farceur pervers détestant Noël et tout ce qui va avec. Surtout le Noël des habitants de Whoville, en bas, dans la vallée. Leurs préparatifs pour les fêtes et leurs chants mélodieux l'ont toujours contrarié au plus haut point. Il est allergique à toute cette joie qui émane de cette petite ville.
                                Mais une petite fille, Cindy Lou, souhaiterait en savoir plus sur celui qu'on présente partout comme un monstre. Pour ce faire, elle gravit courageusement le Mont Crumpit et s'en va frapper à la porte du Grinch.
                                Après avoir cherché à lui faire peur, le reclus, ému malgré lui par tant de sollicitude, prend le risque de descendre à Whoville et de se mêler aux habitants. Hélas, ses espoirs d'être nommé directeur des fêtes tournent court par la faute du maire, et le Grinch regagne son antre, bien décidé à se venger.
                                Il a alors une idée monstrueuse : il revêt le costume du Père Noël, construit un traîneau, déguise son chien en renne et passe de maison en maison avec son gros sac vide pour voler tous les cadeaux, sapins, bûches, dindes et ainsi gâcher la nuit du réveillon des habitants de Whoville. Mais il découvre rapidement que l'esprit de Noël ne se réduit pas aux jouets, chants, parades et autres présents.",
                'summary' => 'Chaque année à Noël, les Chous viennent perturber la tranquillité solitaire du Grinch avec des célébrations toujours plus grandioses, brillantes et bruyantes. Quand les Chous déclarent qu’ils vont célébrer Noël trois fois plus fort cette année, le Grinch réalise qu’il n’a plus qu’une solution pour retrouver la paix et la tranquillité: il doit voler Noël.',
                'poster' => 'https://fr.web.img4.acsta.net/c_310_420/medias/05/07/12/050712_af.jpg',
                'rating' => 3,
                'isan' => '',
                'released_at' => '2000-12-06',
                'genres' => [
                    "Comédie",
                    "Fantastique",
                ],
                "casting" =>
                [
                    "Le Grinch"=>[
                        [
                            "firstname" =>"Jim",     //  Le Grinch
                            "lastname"  =>"Carrey",
                            ],
                        ],
                    "Cindy Lou Who"=>[
                        [
                            "firstname" =>"Taylor",     //  Cindy Lou Who
                            "lastname"  =>"Momsen",
                            ],
                        ],
                    "Martha May Whovier"=>[
                        [
                            "firstname" =>"Christine",     //  Martha May Whovier
                            "lastname"  =>"Baranski",
                            ],
                        ],
                    "Maire Augustus Maywho"=>[
                        [
                            "firstname" =>"Jeffrey",     //  Maire Augustus Maywho
                            "lastname"  =>"Tambor",
                            ],
                        ],
                ]
            ],
        // the man of earth
            [
                'type' => 'Film',
                'title' => 'The man from earth',
                'duration' => 87,
                'synopsis' => "Alors qu'il s'apprête à prendre la route et à tout délaisser pour commencer une nouvelle vie ailleurs, le professeur John Oldman reçoit la visite surprise de ses amis et collègues de travail, qui lui ont préparé une fête d'adieu : le biologiste Harry ; Edith, enseignant l'histoire de l'art et par ailleurs fervente chrétienne ; l'anthropologue Dan ; l'historienne Sandy, amoureuse de John ; le psychiatre Will Gruber ; l'archéologue Art et son élève Linda.
                                Devant l'insistance de ses collègues qui lui demandent la raison de son départ prématuré, John finit par leur révéler qu'il est en réalité un homme des cavernes âgé de 14 000 ans. Il décide alors de leur en dire davantage sur sa vie passée. Invitant tout d'abord ses amis à considérer son propos comme un simple récit de science fiction, John abandonne rapidement cette approche et semble répondre de manière véridique à toutes les questions qu'on lui pose. Bien que ses amis manifestent tout d'abord de l'incrédulité devant son histoire, John poursuit et raconte quelques épisodes marquants de sa vie.Au cours de la conversation, les différents collègues de John lui posent des questions en rapport avec leur spécialité",
                'summary' => "Un scientifique à l'aube de la retraite dévoile sa véritable identité : il est un immortel âgé de plus de 14 000 ans. Une révélation qui va remettre en cause toutes les croyances de son assistance...",
                'poster' => 'http://upload.wikimedia.org/wikipedia/en/3/3b/The_Man_from_Earth.png?w=144',
                'rating' => '5',
                'isan' => '',
                'released_at' => '2011-07-5',
                'genres' => [
                    "Science-fiction",
                ],
                "casting" =>
                [
                    "John Oldman"=>[
                        [
                            "firstname" =>"David",     //  John Oldman
                            "lastname"  =>"Lee Smith",
                            ],
                        ],
                    "Harry"=>[
                        [
                            "firstname" =>"John",     //  Harry
                            "lastname"  =>"Billingsley",
                            ],
                        ],
                    "Dr. Arthur M. Jenkins"=>[
                        [
                            "firstname" =>"William",     //  Dr. Arthur M. Jenkins
                            "lastname"  =>"Katt",
                            ],
                        ],
                    "Dan"=>[
                        [
                            "firstname" =>"Tony",     //  Dan
                            "lastname"  =>"Todd",
                            ],
                        ],
                    "Edith"=>[
                        [
                            "firstname" =>"Ellen",     //  Edith
                            "lastname"  =>"Crawford",
                            ],
                        ],
                    "Sandy"=>[
                        [
                            "firstname" =>"Annika",     //  Sandy
                            "lastname"  =>"Peterson",
                            ],
                        ],
                    "Linda Murphy"=>[
                        [
                            "firstname" =>"Alexis",     //  Linda Murphy
                            "lastname"  =>"Thorpe",
                            ],
                        ],
                ]
            ],
        // interstellar
            [
                'type' => 'Film',
                'title' => 'Interstellar',
                'duration' => 142,
                'synopsis' => "Alors que la Terre se meurt, une équipe d'astronautes franchit un trou de ver apparu près de Saturne et conduisant à une autre galaxie, afin d'explorer un nouveau système stellaire et dans l'espoir de trouver une planète habitable et y établir une colonie spatiale pour sauver l'humanité.",
                'summary' => "En 2067, la Terre est devenue de moins en moins accueillante pour l'humanité plongée dans une grave crise alimentaire. Une humanité tellement résignée sur son destin que les écoles enseignent que les missions Apollo n'eurent pas lieu et n'étaient que des impostures destinées à ruiner l'URSS. Cooper, ancien pilote de la NASA devenu agriculteur, vit dans une ferme avec sa famille.",
                'poster' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSIVryzUKVaqs-5yb0-uHykg7Ob4rUWFl-Ojl28OvBExh8Xc8GT',
                'rating' => '5',
                'isan' => '',
                'released_at' => '2014-11-05',
                'genres' => [
                    'Drame',
                    "Science-fiction",
                ],
                "casting" =>
                [
                    "Joseph Cooper"=>[
                        [
                            "firstname" =>"Matthew",     //  Joseph Cooper
                            "lastname"  =>"McConaughey",
                            ],
                        ],
                "Amelia Brand"=>[
                    [
                        "firstname" =>"Anne",     //  Amelia Brand
                        "lastname"  =>"Hathaway",
                        ],
                    ],
                "Murphy Cooper"=>[
                    [
                        "firstname" =>"Jessica",     //   Murphy Cooper
                        "lastname"  =>"Chastain",
                        ],
                    ],
                "Professeur John Brand"=>[
                    [
                        "firstname" =>"Michael",     //   Professeur John Brand
                        "lastname"  =>"Caine",
                        ],
                    ],
                "Murphy Cooper"=>[
                    [
                        "firstname" =>"Jessica",     //   Murphy Cooper
                        "lastname"  =>"Chastain",
                        ],
                    ],
                "Tom Cooper"=>[
                    [
                        "firstname" =>"Timothée",     //   Tom Cooper
                        "lastname"  =>"Chalamet",
                        ],
                    ],
                "Dr Mann"=>[
                    [
                        "firstname" =>"Matt",     //   Dr Mann
                        "lastname"  =>"Damon",
                        ],
                    ],
                ]
            ],
        // matrix
            [
                'type' => 'Film',
                'title' => 'Matrix',
                'duration' => 136,
                'synopsis' => "Thomas A. Anderson, un jeune informaticien connu dans le monde du hacking sous le pseudonyme de Neo18, est contacté via son ordinateur par ce qu’il pense être un groupe de hackers. Ils lui font découvrir que le monde dans lequel il vit n’est qu’un monde virtuel appelé la Matrice, à l'intérieur duquel les êtres humains sont gardés inconsciemment sous contrôle.
                                Morpheus, le capitaine du Nebuchadnezzar, contacte Néo et pense que celui-ci est l’Élu qui peut libérer les êtres humains du joug des machines et prendre le contrôle de la matrice (selon ses croyances et ses convictions).
                                Une fois libéré de la Matrice, Neo, préparé au combat, est emmené par Morpheus dans la Matrice pour rencontrer l'Oracle, celle qui guide les hommes dans la Matrice en faisant des prédictions qui se réalisent. Cette dernière annonce à Neo que, soit lui, soit Morpheus, mourra rapidement dans les prochaines heures. En effet, un membre de l'équipe de Morpheus, Cypher, le trahit en le livrant aux Agents (les gardiens de la Matrice). Neo prend la décision d'aller les affronter pour sauver Morpheus mais au mépris de sa vie après une longue course-poursuite. Pourtant, un bug ramène Neo à la vie, il devient ainsi l'élu tant attendu tout en neutralisant l'agent Smith ainsi que l'attaque des machines sur le Nebuchadnezzar. Depuis, il déjoue les systèmes et les bases dans la Matrice.",
                'summary' => "Programmeur anonyme dans un service administratif le jour, Thomas Anderson devient Neo la nuit venue. Sous ce pseudonyme, il est l'un des pirates les plus recherchés du cyber-espace. À cheval entre deux mondes, Neo est assailli par d'étranges songes et des messages cryptés provenant d'un certain Morpheus. Celui-ci l'exhorte à aller au-delà des apparences et à trouver la réponse à la question qui hante constamment ses pensées : qu'est-ce que la Matrice ?",
                'poster' => 'https://fr.web.img6.acsta.net/medias/04/34/49/043449_af.jpg',
                'rating' => '5',
                'isan' => 'ISA287256810187',
                'released_at' => '1999-02-07',
                'genres' => [
                    'Action',
                    'Aventure',
                    "Fantastique",
                ],
                "casting" =>
                [
                    "Thomas A. Anderson, alias « Neo »"=>[
                        [
                            "firstname" =>"Keanu",     //   Thomas A. Anderson, alias « Neo »
                            "lastname"  =>"Reeves",
                            ],
                        ],
                    "Trinity"=>[
                        [
                            "firstname" =>"Carrie-Anne",     //   Trinity
                            "lastname"  =>"Moss",
                            ],
                        ],
                    "Morpheus"=>[
                        [
                            "firstname" =>"Laurence",     //   Morpheus
                            "lastname"  =>"Fishburne",
                            ],
                        ],
                    "l'agent Smith"=>[
                        [
                            "firstname" =>"Hugo",     //   l'agent Smith
                            "lastname"  =>"Weaving",
                            ],
                        ],
                    "l'Oracle"=>[
                        [
                            "firstname" =>"Gloria",     //   l'Oracle
                            "lastname"  =>"Foster",
                            ],
                        ],
                    "Cypher ou Mr Reagan"=>[
                        [
                            "firstname" =>"Joe",     //    Cypher ou Mr Reagan
                            "lastname"  =>"Pantoliano",
                            ],
                        ],
                    "Tank"=>[
                        [
                            "firstname" =>"Marcus",     //     Tank
                            "lastname"  =>"Chong",
                            ],
                        ],
                    "le Mulot"=>[
                        [
                            "firstname" =>"Matt",     //     le Mulot
                            "lastname"  =>"Doran",
                            ],
                        ],
                    "Switch"=>[
                        [
                            "firstname" =>"Belinda",     //     Switch
                            "lastname"  =>"McClory",
                            ],
                        ],
                    "Apoc"=>[
                        [
                            "firstname" =>"Julian",     //     Apoc
                            "lastname"  =>"Arahanga",
                            ],
                        ],
                    "Dozer"=>[
                        [
                            "firstname" =>"Anthony Ray",     //     Dozer
                            "lastname"  =>"Parker",
                            ],
                        ],
                    "l'agent Brown"=>[
                        [
                            "firstname" =>"Paul",     //     l'agent Brown
                            "lastname"  =>"Goddard",
                            ],
                        ],
                    "l'agent Jones"=>[
                        [
                            "firstname" =>"Robert",     //     l'agent Jones
                            "lastname"  =>"Taylor",
                            ],
                        ],
                ]
            ],
        // starship troopers
            [
                'type' => 'Film',
                'title' => 'Starship Troopers',
                'duration' => 135,
                'synopsis' => "Au XXIVe siècle, une fédération musclée fait régner sur la Terre l'ordre et la vertu, exhortant sans relâche la jeunesse à la lutte, au devoir, à l'abnégation et au sacrifice de soi. Mais aux confins de la galaxie, une armée d'arachnides se dresse contre l'espèce humaine et ces insectes géants rasent en quelques secondes la ville de Buenos-Aires. Cinq jeunes gens, cinq volontaires à peine sortis du lycée, pleins d'ardeurs et de courage, partent en mission dans l'espace pour combattre les envahisseurs. Ils sont loin de se douter de ce qui les attend.",
                'summary' => "Dans un futur lointain, les pays de la Terre se sont regroupés au sein de la Fédération, un gouvernement mondial et une stratocratie. Cette Fédération se lance alors dans la conquête de l’espace. Les terriens colonisent des planètes et explorent de nouveaux systèmes planétaires.",
                'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_iI7dFnH_sdgOsEvj8BNGB3A8I2fIYIu72beiYsv8Pr_GMBNg',
                'rating' => '3',
                'isan' => '',
                'released_at' => '1998-01-21',
                'genres' => [
                    'Action',
                    'Aventure',
                    "Fantastique",
                    "Science-fiction",
                ],
                "casting" =>
                [
                    "Carmen Ibanez"=>[
                        [
                            "firstname" =>"Denise",     //     Carmen Ibanez
                            "lastname"  =>"Richards",
                            ],
                        ],
                "Dizzy Flores"=>[
                    [
                        "firstname" =>"Dina",     //     Dizzy Flores
                        "lastname"  =>"Meyer",
                        ],
                    ],
                "Johnny Rico"=>[
                    [
                        "firstname" =>"Casper",     //     Johnny Rico
                        "lastname"  =>"Van Dien",
                        ],
                    ],
                "Ace Levy"=>[
                    [
                        "firstname" =>"Neil Patrick ",     //    Carl Jenkins
                        "lastname"  =>"Harris",
                        ],
                    ],
                "Carl Jenkins "=>[
                    [
                        "firstname" =>"Neil Patrick ",     //    Carl Jenkins
                        "lastname"  =>"Harris",
                        ],
                    ],
                "Sergeant Charles Zim "=>[
                    [
                        "firstname" =>"Clancy ",     //   Sergeant Charles Zim
                        "lastname"  =>"Brown",
                        ],
                    ],
                "Pilot Cadet Stack Lumbreiser"=>[
                    [
                        "firstname" =>"Amy ",     //   Pilot Cadet Stack Lumbreiser
                        "lastname"  =>"Smart",
                        ],
                    ],
                ]
            ],
        // thor
            [
                'type' => 'Film',
                'title' => 'Thor: Love and Thunder',
                'duration' => 119,
                'synopsis' => 'Alors que Thor est en pleine introspection et en quête de sérénité, sa retraite est interrompue par un tueur galactique connu sous le nom de Gorr, qui s’est donné pour mission d’exterminer tous les dieux. Pour affronter cette menace, Thor demande l’aide de Valkyrie, de Korg et de son ex-petite amie Jane Foster, qui, à sa grande surprise, manie inexplicablement son puissant marteau, le Mjolnir. Ensemble, ils se lancent dans une dangereuse aventure cosmique pour comprendre les motivations qui poussent Gorr à la vengeance et l’arrêter avant qu’il ne soit trop tard.',
                'summary' => "Thor se lance dans un voyage différent de tout ce qu'il a connu jusqu'à présent : une quête de paix intérieure. Cependant, sa retraite est interrompue par Gorr le boucher des dieux, un tueur galactique qui cherche l'extinction des dieux.",
                'poster' => 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTzvvaC-TeVQqlEYgwgrt9b2A3f5vNMnvDZS4HTtjqp7hyCkQ58',
                'rating' => '2.8',
                'isan' => '',
                'released_at' => '2022-07-13',
                'genres' => [
                    'Action',
                    'Aventure',
                    "Fantastique",
                    "Science-fiction",
                ],
                "casting" =>
                [
                    "Thor"=>[

                    ],
                "Jane Foster / The Mighty Thor"=>[
                    [
                        "firstname" =>"Natalie ",     //   Jane Foster / The Mighty Thor
                        "lastname"  =>"Portman",
                        ],
                    ],
                "Gorr le Boucher"=>[
                    [
                        "firstname" =>"Christian ",     //   Gorr le Boucher
                        "lastname"  =>"Bale",
                        ],
                    ],
                "Valkyrie"=>[
                    [
                        "firstname" =>"Tessa ",     //   Valkyrie
                        "lastname"  =>"Thompson",
                        ],
                    ],
                "Zeus"=>[
                    [
                        "firstname" =>"Russell ",     //   Zeus
                        "lastname"  =>"Crowe",
                        ],
                ],
                "Sif"=>[
                    [
                        "firstname" =>"Jaimie ",     //   Sif
                        "lastname"  =>"Alexander",
                        ],
                ],
                "Peter Quill / Star-Lord"=>[
                    [
                        "firstname" =>"Chris ",     //   Peter Quill / Star-Lord
                        "lastname"  =>"Pratt",
                        ],
                ],
            
                "Drax"=>[
                    [
                        "firstname" =>"Dave ",     //   Drax
                        "lastname"  =>"Bautista",
                        ],
                ],
                ]
            ],
        // truman show
            [
                'type' => 'Film',
                'title' => 'Truman Show',
                'duration' => 103,
                'synopsis' => "Truman Burbank mène une vie calme et heureuse. Il habite dans un petit pavillon propret de la radieuse station balnéaire de Seahaven. Il part tous les matins à son bureau d'agent d'assurances dont il ressort huit heures plus tard pour regagner son foyer, savourer le confort de son habitat modèle, la bonne humeur inaltérable et le sourire mécanique de sa femme, Meryl. Mais parfois, Truman étouffe sous tant de bonheur et la nuit l'angoisse le submerge. Il se sent de plus en plus étranger, comme si son entourage jouait un rôle. Il se sent observé...",
                'summary' => "À trente ans passés, Truman commence à remarquer des détails étranges autour de lui: des projecteurs qui tombent du ciel, la pluie qui ne tombe ...",
                'poster' => "https://fr.web.img3.acsta.net/pictures/22/05/16/16/32/4176595.jpg",
                'rating' => '5',
                'isan' => '',
                'released_at' => '2022-10-28',
                'genres' => [
                    'Drame',
                    'Comédie',
                ],
                "casting" =>
                [
                "Truman Burbank"=>[
                    [
                        "firstname" =>"Jim ",     //   Truman Burbank
                        "lastname"  =>"Carrey",
                        ],
                ],
                "Meryl Burbank, Hannah Gill"=>[
                    [
                        "firstname" =>"Laura ",     //   Meryl Burbank, Hannah Gill
                        "lastname"  =>"Linney",
                        ],
                ],
                "Christof"=>[
                    [
                        "firstname" =>"Ed ",     //  Christof
                        "lastname"  =>"Harris",
                        ],
                ],
                "Lauren Garland"=>[
                    [
                        "firstname" =>"Natascha ",     //  Lauren Garland
                        "lastname"  =>"McElhone",
                        ],
                ],
                "Marlon"=>[
                    [
                        "firstname" =>"Noah ",     // Marlon
                        "lastname"  =>"Emmerich",
                        ],
                    ],
                ]
            ],
        // cité de la peur
            [
                'type' => 'Film',
                'title' => 'La cité de la peur',
                'duration' => 93,
                'synopsis' => "Odile Deray, attachée de presse, vient au Festival de Cannes pour présenter le film `Red is Dead'. Malheureusement, celui-ci est d'une telle faiblesse que personne ne souhaite en faire l'écho. Cependant, lorsque les projectionnistes du long-métrage en question meurent chacun leur tour",
                'summary' => "Le film commence sur une projection des dernières minutes de Red Is Dead, un film d'horreur nanardesque dans lequel un tueur en série communiste tue ses victimes à la faucille et au marteau, à l'occasion du premier jour du festival de Cannes. Lorsque le générique de fin apparaît, tout le monde a déjà quitté la salle au grand désespoir d'Odile Deray, l'attachée de presse, qui essaie de retenir un dernier critique de cinéma en le suppliant d'écrire un bon papier mais celui-ci refuse. Alors qu'Odile quitte le cinéma dépitée, le projectionniste du film est assassiné par un tueur de la même façon que dans le film. Le deuxième jour du festival, Odile réalise que le meurtre pourrait assurer une bonne publicité à son film, elle décide alors de faire venir à Cannes l'acteur principal du film, Simon Jérémi, et d'embaucher un garde du corps. À l'aéroport de Nice, Odile retrouve le garde du corps, Serge Karamazov, et Simon. Alors qu'Odile retourne à la salle de projection et que Serge et Simon s'installent à l'hôtel Martinez, le nouveau projectionniste est assassiné. Odile découvre le corps et appelle la police, le commissaire Bialès est alors dépêché sur place. À son arrivée, il s'interroge sur le sens des lettres tracées sur le mur après chaque meurtre, un O et un D. Odile est amenée au commissariat pour y être interrogée, Bialès la soupçonne d'avoir commis les deux meurtres pour faire de la publicité à son film....",
                'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcST-hR7dI9i1qYIQxj8boLUhaV1l7vvTc_Ws_EcvP9kGcVxkG4y',
                'rating' => '5',
                'isan' => '',
                'released_at' => '1994-03-09',
                'genres' => [
                    'Aventure',
                    'Comédie',
                    'Drame',
                    'Policier',
                ],
                "casting" =>
                [
                    "Serge Karamazov"=>[
                        [
                            "firstname" =>"Alain ",     // Serge Karamazov
                            "lastname"  =>"Chabat",
                            ],
                    ],
                    "Odile Deray"=>[
                        [
                            "firstname" =>"Chantal ",     // Odile Deray
                            "lastname"  =>"Lauby",
                            ],
                    ],
                    "Simon Jérémi"=>[
                        [
                            "firstname" =>"Dominique ",     // Simon Jérémi
                            "lastname"  =>"Farrugia",
                            ],
                    ],
                    "Le commissaire Patrick Bialès"=>[
                        [
                            "firstname" =>"Gérard ",     // Le commissaire Patrick Bialès
                            "lastname"  =>"Darmon",
                            ],
                    ],
                    "Emile Gravier"=>[
                        [
                            "firstname" =>"Sam ",     // Emile Gravier
                            "lastname"  =>"Karmann",
                            ],
                    ],
                    "La veuve joyeuse"=>[
                        [
                            "firstname" =>"Valérie ",     // La veuve joyeuse
                            "lastname"  =>"Lemercier",
                            ],
                    ],
                ]
            ],
        // django unchained
            [
                'type' => 'Film',
                'title' => 'Django Unchained',
                'duration' => 165,
                'synopsis' => "Au Texas, en 1858, une file d'esclaves enchaînés avance péniblement sous la garde des frères Ace et Dicky Speck. En pleine nuit, le groupe croise le docteur King Schultz, qui voyage avec son ancienne roulotte de dentiste ambulant (avec Fritz le cheval et une grande dent factice qui gigote au bout de son ressort sur le toit). Schultz, ignorant l'hostilité manifeste des Speck, demande aux prisonniers si l'un d'entre eux connaît les dénommés « frères Brittle » ; celui qui s'avérera être Django répond par l'affirmative. Mais lorsque Schultz insiste pour acquérir Django, Ace Speck le menace de son fusil. Schultz tue rapidement Ace, libère Django, et laisse les autres esclaves s'occuper de Dicky.
                            Une fois en ville, Schultz explique à Django qu'il est un chasseur de primes et qu'il doit ramener les frères Brittle, morts ou vivants. Malheureusement, Schultz ignore à quoi ressemblent ses proies, et a donc besoin de quelqu'un pour les lui montrer. Il propose à Django de l'accompagner jusqu'à ce qu'ils aient retrouvé les Brittle ; leur travail accompli, Django sera libre et recevra même 25 dollars par tête. Django accepte.",
                'summary' => "À Greenville, où Django avait été vendu, Schultz et Django rencontrent le nouveau maître de Broomhilda, le richissime Calvin J. Candie, propriétaire de la plantation Candyland. Entre autres cruautés, cet homme aux apparences raffinées oblige ses esclaves les plus forts à se battre à mort dans des combats de « lutte mandingue ». Schultz et Django sont conscients que Calvin Candie ne consentira à les rencontrer que s'il y trouve son intérêt. Ils l'aborderont donc en prétendant vouloir acheter le meilleur lutteur de Candie pour une somme énorme, soit 12 000 dollars, puis ils renonceront à la négociation pour n'acheter « que » Broomhilda. L'approche fonctionne : Candie les invite chez lui. Durant leur voyage, pour éviter de se faire démasquer, Django et Schultz doivent se montrer insensibles à la condition des autres esclaves (ils doivent par exemple renoncer à sauver D'Artagnan, un lutteur affaibli et borgne, que Candie fait dévorer par ses chiens pour le punir d'avoir fui).",
                'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSaKWQt2piQJ7IwdSSMh5gp4QyiqD1ZiCRDUJwd-BKvr7Z-HbwS',
                'rating' => '4.5',
                'isan' => '',
                'released_at' => '2013-01-16',
                'genres' => [
                    'Action',
                    'Aventure',
                    'Western',
                ],
                "casting" =>
                [
                "Frankie"=>[
                    [
                        "firstname" =>"Quentin ",     // Frankie
                        "lastname"  =>"Tarantino",
                        ],
                ],
                "Django"=>[
                    [
                        "firstname" =>"Jamie",     // Django
                        "lastname"  =>"Foxx",
                        ],
                ],
                "Docteur King Schultz"=>[
                    [
                        "firstname" =>"Christoph",     // Docteur King Schultz
                        "lastname"  =>"Waltz",
                        ],
                ],
                "Calvin Candie"=>[
                    [
                        "firstname" =>"Leonardo",     // Calvin Candie
                        "lastname"  =>"DiCaprio",
                        ],
                ],
                "Stephen"=>[
                    [
                        "firstname" =>"Samuel",     // Stephen
                        "lastname"  =>"L. Jackson",
                        ],
                ],
                "Broomhilda von Shaft"=>[
                    [
                        "firstname" =>"Kerry",     // Broomhilda von Shaft
                        "lastname"  =>"Washington",
                        ],
                ],
                "Big Daddy"=>[
                    [
                        "firstname" =>"Don",     // Big Daddy
                        "lastname"  =>"Johnson",
                        ],
                ],
                ]
            ],
        ];

        foreach ($movies as $currentMovie) {
            $movieObj = new Movie();
            $movieObj->setTitle($currentMovie['title']);
            $movieObj->setDuration($currentMovie['duration']);
            $movieObj->setSynopsis($currentMovie['synopsis']);
            $movieObj->setSummary($currentMovie['summary']);
            $movieObj->setPoster($currentMovie['poster']);

            // on peut convertir de plusieurs manière une chaine de caractère en entier
            // en précisant le type entre parenthèse avant la valeur
            // en utilisant des fonctions dédiées
            $movieObj->setRating((float)$currentMovie['rating']);
            $movieObj->setIsan($currentMovie['isan']);
            $movieObj->setReleasedAt(new DateTimeImmutable($currentMovie['released_at']));

        // *******************************************************************
        //********* */ récupération des clés et des collections! *************

            // ? ** GENRE ** : plusieurs genres possible donc boucle:

            foreach ($currentMovie['genres'] as $currentGenreName) {
                // $currentGenre = Action
                // $genreObjArray [
                //     obj('Action')
                // ]
                $currentGenreObj = $genreObjArray[md5($currentGenreName)];
                // récupérer le genre du tableau $genreObjArr
                //  attend un objet et pas un array
                $movieObj->addGenre($currentGenreObj);

                // $manager->persist($movieObj);

            }
            // $movieObj ->addGenre($currentMovie['genres']);


            // ? ** SAISON ** : plusieurs saisons possible donc boucle:

            // si des saison existe on les ajoute autrement non
            if (isset($currentMovie['seasons'])) {
                foreach ($currentMovie['seasons'] as $currentSeasonInfos) {
                    $currentSeasonObj = new Season();
                    $currentSeasonObj->setNumber($currentSeasonInfos['number']);
                    $currentSeasonObj->setEpisodeCount($currentSeasonInfos['episode_count']);

                    // on fixe les saisons:
                    $manager->persist($currentSeasonObj);

                    // on l'ajoute à movie
                    $movieObj->addSeason($currentSeasonObj);
                }
            }

            // tableau d'object pour le transmettre a RandomFixtures
            // $movieObjArray[] = $movieObj;
            // ? ** CASTING ** : plusieurs roles dans le casting possible donc boucle:
            foreach ($currentMovie['casting'] as $role =>$currentCastingRole) {
                $castingObj = new Casting();
                $castingObj->setRole($role);
                $castingObj->setCreditOrder(mt_rand(1, 5));
                    
                // on l'ajoute à movie
                $castingObj->setMovie($movieObj);
                    
                // ? ** PERSON (acteurs) ** : prénom et nom donc boucle pour y placer les infos
                // ? condition car pour l'instant que GOT enregistré

            // on ajoute chaque casting au movie: 
            $movieObj->addCasting($castingObj);

                foreach ($currentCastingRole as $currentperson) {
                    // dd($currentperson["firstname"]);
                    $personObj = new Person();
                        
                    $personObj->setFirstname($currentperson['firstname']);
                    $personObj->setLastname($currentperson['lastname']);

                    $castingObj->setPerson($personObj);

                    
                    $manager->persist($personObj);
                    $manager->persist($castingObj);
                }
                $manager->persist($castingObj);
            }
        // ? ** Review (critiques) ** : récupéréer 3-4 critiques par films
        // tire au sort le nombre de reviews qui sera affecté
        $aleaCount = mt_rand(3,5);
        // dd($aleaCount);
            for ($i = 0; $i<=$aleaCount; $i ++){
            // récupération de tous les reviews $allReviews généré plus haut



        // pour chaque nouvelle review on crée un contenu aléatoire
            $ReviewKeyRandom = (array_rand($LoremReviewArray));
            $ReviewDefault = $LoremReviewArray[$ReviewKeyRandom];

            // on affecte les données dans un objet
            $reviewObj = new Review();
            $reviewObj->setRating(mt_rand(1,5));
            $reviewObj->setContent($ReviewDefault);

        // Sélection d'un utilisateur aléatoire pour chaque revieuw
            $randUserIdx = mt_rand(1, sizeof($allUsers));
            $randUserIdx -- ;
            // dump(sizeof(($allUsers)));
            // dump($randUserIdx);
            $randomUser = $allUsers[$randUserIdx];
            // dump($randomUser);
            $reviewObj->setUser($randomUser);

        // Affectation du film à la review
            $reviewObj->setMovie($movieObj);

        // Affection de la review au film
            $movieObj->addReview($reviewObj);


        // On persiste notre review
            $manager->persist($reviewObj);
        // On persiste notre film
            $manager->persist($movieObj);

            }
        
        // si utilisation report des données dans un autre fixture
        // $movieObjArray[] = $movieObj;
            $manager->persist($movieObj);

            // dd($movieObj);
        }
      
    
        // cela permet de rendre disponible notre tableau de d'objet dans les autres fixtures
        // $this->addReference('movie-list', $movieObjArray);  

        $manager->flush();
    }
}