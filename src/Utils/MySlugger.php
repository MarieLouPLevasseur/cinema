<?php
namespace App\Utils;

use ProxyManager\Signature\SignatureGenerator;
use Symfony\Component\String\Slugger\SluggerInterface;

class MySlugger {

    // on crée la variable pour injecter dans le construct la dépendance de service
    private $symfoSlugger;

    // injection de dépendance par le construct
    public function __construct( SluggerInterface $slugger)
    {
        $this->symfoSlugger = $slugger;
    }



    /**
     * Slugify the movie title
     * 
     * @param string $toBeSlugified
     * @return string
     */
    function slugify ($toBeSlugified) : string
    {
        // ? premiere méthode pour le slug
        // $mySlug = $this->symfoSlugger->slug($toBeSlugified)->lower();
        // return $mySlug;

        // ? seconde méthode pour le slug
        $mySlug = $this->symfoSlugger->slug($toBeSlugified);

        // attention la méthode lower renvoit un clone que l'on doit stocker
        // sinon il tombe dans les abyss de vsCode
        $loweredMySlug = $mySlug->lower();

        return $loweredMySlug;

    }
}