<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LogoutTest extends WebTestCase
{
    public function testLogout(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Connexion')->form();
        $form['email'] = 'test@test.com';
        $form['password'] = 'password';
        $client->submit($form);

        // Vérifie que l'utilisateur est bien connecté
        $this->assertTrue($client->getResponse()->isRedirect());

        // Se déconnecter de l'application
        $client->request('GET', '/logout');

        // Vérifie que l'utilisateur est bien déconnecté
        $this->assertTrue($client->getResponse()->isRedirect());

        // On essaie d'accèder à une page qui nécessite d'être connecté
        $client->request('GET', '/coaster/create');
        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
        $this->assertSame('/login', $client->getResponse()->headers->get('Location'));
    }
}