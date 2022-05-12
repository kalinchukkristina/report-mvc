<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Annotation\Route;

class CardControllerTest extends WebTestCase
{
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

    public function testRenderingDeckPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Deck');

        $title = "Deck";
        $this->assertPageTitleContains($title);
    }

    public function testRenderingShufflePage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/shuffle');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Deck');

        $title = "Shuffle";
        $this->assertPageTitleContains($title);
    }

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

/*    public function testRenderingDrawNumberPageNoSession(): void
    {
        $client = static::createClient();
        $param = 3;
        $client->request('GET', "/card/deck/draw/", [3]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Draw a number of cards');
        $this->assertSelectorTextContains('h2', 'Your card:');

        $title = "DrawNumber";
        $this->assertPageTitleContains($title);
    }*/

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
