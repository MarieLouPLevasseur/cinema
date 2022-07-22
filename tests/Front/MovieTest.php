<?php

namespace App\Tests\Front;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MovieTest extends WebTestCase
{
    public function testHomePagePunchLine(): void
    {
        // ceci est une classe qui représente un navigateur
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'Où que vous soyez. Gratuit pour toujours.');
    }

    public function testMovieType(): void
    {
        $client = static::createClient();
        
        // ? tester que la page de show de GoT affiche bien comme type série
        $crawler = $client->request('GET', '/film/2');
        
        $this->assertSelectorTextContains('strong', 'Série');
        // ? tester que la page de show de DaVinci Code affiche bien comme type Film
        $crawler = $client->request('GET', '/film/5');
        
        $this->assertSelectorTextContains('strong', 'Film');
    }
}