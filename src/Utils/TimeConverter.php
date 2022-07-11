<?php
namespace App\Utils;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

// une fonction qui convertit des minutes au format xxHrs yyMin

class TimeConverter  extends AbstractExtension
{

    /**
     * Convert minutes to forùat wwhyym
    * On veut convertir au format j h m s 
     *  Si il y a 0 jours, on ne les affiche pas
     *  Si il y a 0 jours et 0 heures on ne les affiche pas
     *  Si il y a 0 jours et 0 heures et 0 minutes on ne les affiche pas
     *  Si il y a 0 s , on ne les affiche pas
     *  Si il y a 0 s et 0 minutes , on ne les affiche pas
     *  Si il y a 0 s et 0 minutes et 0 heures , on ne les affiche pas
     * @param integer $totalMinutes
     * @return string
     */
    public function convert(float $totalMinutes):string
    {

    // exemple d'injection de dépendance si on avait besoin de l'objet Request
    // private $request;
    // public function __construct(Request $request)
    // {
    //     $this->request = $request;
    // }

        //TEST a supprimer
        // $totalMinutes = 1440.5;


        //**** calcul jours **** */
        $days = floor($totalMinutes/1440);
        // var_dump($days);

        //**** calcul heures **** */
        // on divise par 60 pour avoir le nombre d'heures
            // on enlève le nb jour (1jour = 1440min)
            // on arrondi à l'entier inférieur (pour avoir le nombre d'heure entière)
        $hours = floor(($totalMinutes-($days *1440))  /60 );
        // var_dump($hours);

        //**** calcul minutes **** */
        //on soustrait du total:
            // les jours (1 jour  = 1440 min)
            // et les heures (1h = 60 min)
        $minutes = floor($totalMinutes -($days *1440) -( 60 * $hours ));
        // var_dump($minutes);

        //**** calcul secondes **** */
        // on soustrait du total:
            // les jours (1 jour  = 1440 min)
            // et les heures (1h = 60 min)
            // les minutes (déjà en minutes)
        $seconds = 60 * ( $totalMinutes -($days *1440) -( 60 * $hours ) - ($minutes));
        // var_dump($seconds);






        /**Condition pour correspondre aux exigences d'affichage */
        // result vaut null par défaut
        $result = "";

/******************************
 ******* GESTION JOURS ********
 ******************************/
        // si days >0 on affiche sa valeur
        if ($days > 0) {

            
            $result .= "{$days}j";
        }
/******************************
 ******* GESTION HEURES *******
 ******************************/
        // si hours >0 on affiche sa valeur
        if ($hours > 0) {
            
            // + espace d'affichage ergonomie visuel
            if ($result != '') 
            {
                $result .= ' ';
            }

            $result .= "{$hours}h";
        }

          // si les heures sont nulles, on ne les affiche que si encadrement avec jours et minutes OU secondes >0
          if ($hours == 0 && $seconds >0 | $hours >0 && $days >0){

            // + espace d'affichage ergonomie visuel
            if ($result != '') {
            $result .= ' ';
            }

        $result .= "{$hours}h";

        }
/******************************
 ******* GESTION MINUTES *******
 ******************************/
        // si minutes >0 on affiche sa valeur
        if ($minutes > 0) {

            // + espace d'affichage ergonomie visuel
            if ($result != '') 
            {
                $result .= ' ';
            }

            $result .= "{$minutes}min";
        }
        // si les minutes sont nulles, on ne les affiche que si encadrement avec heures et secondes >0
        if ($minutes == 0 && $seconds >0 && $hours >0 | $days >0){

            // + espace d'affichage ergonomie visuel
            if ($result != '') {
            $result .= ' ';
            }

        $result .= "{$minutes}min";

        }

        // si secondes >0 on affiche sa valeur
        if ($seconds > 0) {
            
            // + espace d'affichage ergonomie visuel
            if ($result != '') 
            {
                $result .= ' ';
            }
            $result .= "{$seconds}s";
        }
        
       
        return $result;
    }
          

                 
    

    /**
     * permet d'utiliser la méthode convert directement dans Twig en utilisant "minToHours"
     *
     *
     */
    public function getFilters()
    {
        return [
            new TwigFilter('minToHours', [$this, 'convert']),
        ];
    }
}