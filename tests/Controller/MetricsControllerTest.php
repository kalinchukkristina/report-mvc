<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test suite for MetricsController
 */
class MetricsControllerTest extends WebTestCase
{
    /**
     * testing to render metrics landing page
     */
    public function testMetricsLandingPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/metrics');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Metrics');
    }
}
