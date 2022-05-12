<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BooksControllerTest extends WebTestCase
{
    public function testRenderLandingPageForBooks(): void
    {
        $client = static::createClient();
        $client->request('GET', '/books');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.container > ul > li', 'Show all books');

        $title = "Library";
        $this->assertPageTitleSame($title);
    }
}
