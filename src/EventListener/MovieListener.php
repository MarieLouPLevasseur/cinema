<?php
namespace App\EventListener;

use App\Entity\Movie;
use App\Utils\MySlugger;
use Doctrine\ORM\Event\PreFlushEventArgs;

class MovieListener
{
    private $slugger;

    public function __construct(MySlugger $mySlugger)
    {
        $this->slugger = $mySlugger;
    }

    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function preFlush(Movie $movie, PreFlushEventArgs $event): void
    {
        $movie->setSlug($this->slugger->slugify($movie->getTitle()));
    }
}