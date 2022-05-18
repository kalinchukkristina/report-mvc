<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectControllerTest extends WebTestCase
{
    public function testProjectLandingPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/proj');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hållbar energi för all');
    }

    public function testProjectAboutLandingPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/proj/about');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'About-sida till projektet');
    }
}
