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
        // $totalMinutes = 60;

        // on divise par 60 pour avoir le nombre d'heures
            // on arrondi à l'entier inférieur (pour avoir le nombre d'heure entière)
        $hours = floor($totalMinutes / 60);
        var_dump($hours);

        //on soustrait du total pour obtenir les minutes
        $minutes = floor($totalMinutes - ( 60 * $hours ));
        var_dump($minutes);

        // convertion en secondes
        $seconds = 60 * ($totalMinutes - ( 60 * $hours ) - $minutes);
        var_dump($seconds);



        /**Condition pour correspondre aux exigences d'affichage */
        // result vaut null par défaut
        $result = "";


        if ($hours > 0) {

            $result .= "{$hours}h";
        }
        if ($minutes > 0) {

            $result .= "{$minutes}min";
        }
        if ($seconds > 0) {

            // if ($result != '') 
            // {
            //     $result .= ' ';
            // }
            $result .= "{$seconds}s";
        }

        return $result;
        

        // //Toutes les valeurs sont >0 : je les affiches TOUTES
        // if($hours >0 && $minutes >0 && $seconds > 0){
        //     $result .= "{$hours}h {$minutes}m {$seconds}h";

        // }

        // //Les valeurs haute (heures) et basse (seconds) sont >0 : je les affiches TOUTES y compris les 0 dans l'encadrement
        // if ($minutes ===0 && $hours > 0 && $seconds > 0) {
        //     $result .= "{$hours}h {$minutes}m {$seconds}h";
        // }

        // // Valeur UNIQUE >0
        // if($hours>0 && $minutes===0 && $seconds ===0){
        //     $result .= "{$hours}h";

        // }
    
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