<?php

namespace App\Tests\Controller;

use App\Entity\Coaster;
use App\Repository\UserRepository;
use App\Repository\CoasterRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoasterControllerTest extends WebTestCase
{
    
    
    public function testEdit(): void
    {
        $coaster = new Coaster;
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneBy([
            'email' => 'admin@monde.com',
        ]);
        $client->loginUser($user);
        $client->request('GET','coaster'. $coaster->getId(). '/edit');
        $this->assertResponseIsSuccessful();
}
}