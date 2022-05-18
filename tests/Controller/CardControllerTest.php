<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Test suite for CardController
 */
class CardControllerTest extends WebTestCase
{
    /**
     * testing that it is possible to load the landing page in CardController
     */
    public function testRenderingCardLandingPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Kort spel');
        $this->assertSelectorTextContains('.container > ul > li', 'Deck');

        $title = "Card";
        $this->assertPageTitleContains($title);
    }

    /**
     * testing to render deck page
     */
    public function testRenderingDeckPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Deck');

        $title = "Deck";
        $this->assertPageTitleContains($title);
    }

    /**
     * testing to render shuffle page
     */
    public function testRenderingShufflePage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/shuffle');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Deck');

        $title = "Shuffle";
        $this->assertPageTitleContains($title);
    }

    /**
     * testing to render draw page
     */
    public function testRenderingDrawPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/draw');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Draw');
        $this->assertSelectorTextContains('h2', 'Your card:');

        $title = "Draw";
        $this->assertPageTitleContains($title);
    }

    /**
     * testing to render the page with cards and two jokers
     */
    public function testRenderingDeckWithjokersPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck2');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Deck containing two Jokers');

        $title = "DeckJoker";
        $this->assertPageTitleContains($title);
    }
}
