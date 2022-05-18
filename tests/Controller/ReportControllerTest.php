<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test suite for ReportController
 */
class ReportControllerTest extends WebTestCase
{
    /**
     * testing to render index page
     */
    public function testIndexPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Om mig');

        $title = "Me";
        $this->assertPageTitleSame($title);
    }

    /**
     * testing to render about page
     */
    public function testAboutPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/about');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Om kursen mvc');

        $title = "About";
        $this->assertPageTitleSame($title);
    }

    /**
     * testing to render report page
     */
    public function testReportPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/report');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Redovisning av kursmoment i kursen mvc');

        $title = "Report";
        $this->assertPageTitleSame($title);
    }
}
