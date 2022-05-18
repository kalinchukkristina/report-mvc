<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test suite for BooksController
 */
class BooksControllerTest extends WebTestCase
{
    /**
     * testing that it is possible to load the landing page in BooksController
     */
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
