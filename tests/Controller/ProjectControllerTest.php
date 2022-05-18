<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test suite for ProjectController
 */
class ProjectControllerTest extends WebTestCase
{
    /**
     * testing to render project documentation page
     */
    public function testProjectAboutLandingPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/proj/about');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'About-sida till projektet');
    }
}
