<?php

namespace App\Tests\Front;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AccessControlTest extends WebTestCase
{



/**
     * @dataProvider httpRoleUserProvider
     */
    public function testAccessControl($url, $httpMethod, $requestedHttpCode)
    {
        // ? connecter un utilisateur
        // récupéré de https://symfony.com/doc/current/testing.html#logging-in-users-authentication

        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneBy(['email' => 'user@oflix.com']);

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // ? accéder à une page sécurisé
        // - { path: ^/films/\d+/critiques/ajout, roles: ROLE_USER }
        $client->request($httpMethod, $url);

        // ? vérifier si on a un access denied ou 200 en fonction de ce qui est attendu
        $this->assertResponseStatusCodeSame($requestedHttpCode);
    }

   
    public function httpRoleUserProvider()
    {
        return [
            ['/films/1/critiques/ajout', 'GET', Response::HTTP_OK],
            ['/back/movie/1', 'GET', Response::HTTP_FORBIDDEN],
            ['/back/movie/index', 'GET', Response::HTTP_FORBIDDEN],
            ['/back/movie/add', 'GET', Response::HTTP_FORBIDDEN],
            ['/back/movie/1/edit', 'GET', Response::HTTP_FORBIDDEN],
            ['/back/movie/1/delete', 'GET', Response::HTTP_FORBIDDEN],
            // ! POST a corriger: bug
            // ['/back/movie/1', 'POST', Response::HTTP_FORBIDDEN],
        ];
    }
}