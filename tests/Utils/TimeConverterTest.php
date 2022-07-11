<?php

namespace App\Tests\Utils;

use App\Utils\TimeConverter;
use PHPUnit\Framework\TestCase;

 
class TimeConverterTest extends TestCase
{
    /**
     * @dataProvider convertProvider
     */
    public function testSomething($valueToConvert, $expectedResult): void
    {
        // valueToConvert sera la valeur à tester qu'on prédéfini
        // expectedResult sera le résultat attendu

         // ? récupérer l'objet à tester
         // out: Object Unit Test . Pas obliger mais nommage par convention
        $out = new TimeConverter();

        // ? exécuter du code de cet objet avec une valeur
        /* *******⋅TEST JOUR*******
        *  Si il y a 0 s et 0 minutes , on ne les affiche pas
        *  Si il y a 0 jours, on ne les affiche pas */

        // les valeurs de test sont directement transmis par la suite par Provider
        // utilisation méthode convertProvider
        // $expectedResult = '1h';
        $result = $out->convert($valueToConvert);

        // ? vérifier que la valeur est bien celle attendue
        $this->assertEquals($result, $expectedResult);
        /* *******⋅TEST SECONDE*******
        *  Si il y a 0 s et 0 minutes , on ne les affiche pas
        *  Si il y a 0 jours, on ne les affiche pas */
        // $expectedResult = '30s';
        // $result = $out->convert(.5);

        // ? vérifier que la valeur est bien celle attendue
        // $this->assertEquals($result, $expectedResult, 'test seconds');

    }


    public function convertProvider()
    {
        // param 1: valeur a tester
        // param 2: valeur attendue
        return [
            [60, '1h', 'test Heure'],
            [0.5,'30s'],
            [1, '1min'],
            // [1.5, '1min 30s'],
            // [61.5, '1h 1min 30s'],
        // [60.5, '1h 0min 30s'],
        // [1440, '1j'],
        ];
    }
}
