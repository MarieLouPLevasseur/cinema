<?php

namespace App\Utils;

use Symfony\Component\String\Slugger\SluggerInterface;

class MySlugger {

    private $symfoSlugger;
    private $toLower;

    public function __construct( SluggerInterface $slugger, $toLower)
    {
        $this->symfoSlugger = $slugger;
        $this->toLower = $toLower;
    }

    /**
     * Slugify a string
     *
     * @param string $toBeSlugified
     * @return string
     */
    function slugify(string $toBeSlugified) :string
    {
        // ? premiere méthode pour le slug
        // $mySlug = $this->symfoSlugger->slug($toBeSlugified)->lower();
        // return $mySlug;
       
        // ? seconde méthode pour le slug
        $mySlug = $this->symfoSlugger->slug($toBeSlugified);


        if ($this->toLower) {
            // attention la méthode lower renvoit un clone que l'on doit stocker
            // sinon il tombe dans les abyss de vsCode
            return $mySlug->lower();
        }

        return $mySlug;

    }
}