<?php

namespace App\Tests\Front;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    
    /**
     * @dataProvider httpUrlProvider
     */
    public function testSomething($url, $requestedHttpCode): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $url);
        $this->assertResponseStatusCodeSame($requestedHttpCode);
    }

    public function httpUrlProvider()
    {
        return [
            ['/', Response::HTTP_OK],
            ['/films', Response::HTTP_OK],
            ['/films/1', Response::HTTP_OK],
            // ['/favoris', Response::HTTP_OK],
            // ['/favoris/2', Response::HTTP_FOUND],
        ];
    }

    

}