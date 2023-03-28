<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LogoutTest extends WebTestCase
{
    public function testLogout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/logout');
        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
        $this->assertSame('http://localhost/', $client->getResponse()->headers->get('Location'));
        $client->request('GET', '/park/create');
        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
        $this->assertSame('/login', $client->getResponse()->headers->get('Location'));
    }
    }