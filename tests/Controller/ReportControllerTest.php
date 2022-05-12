<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportControllerTest extends WebTestCase
{
    public function testIndexPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Om mig');

        $title = "Me";
        $this->assertPageTitleSame($title);
    }

    public function testAboutPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/about');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Om kursen mvc');

        $title = "About";
        $this->assertPageTitleSame($title);
    }

    public function testReportPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/report');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Redovisning av kursmoment i kursen mvc');

        $title = "Report";
        $this->assertPageTitleSame($title);
    }
}
