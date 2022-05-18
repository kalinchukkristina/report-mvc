<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test suite for GameController
 */
class GameControllerTest extends WebTestCase
{
    /**
     * testing to render game landing page
     */
    public function testGameLandingPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Game');
    }

    /**
     * testing to render play page
     */
    public function testGamePage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Card game');
    }

    /**
     * testing to click on the Player's button "Get card" button
     */
    public function testGamePageClickedOnGetNewCardButton(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $client->submitForm('card');
    }

    /**
     * testing to click on the Player's button "Stop" button
     */
    public function testGamePageClickedOnStopButton(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $client->submitForm('stop');
    }

    /**
     * testing to click on the Banken's button "Get card" button
     */
    public function testGamePageClickedOnGetNewCardBankButton(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $client->submitForm('stop');
        $client->submitForm('cardBank');
    }

    /**
     * testing to click on the Banken's button "Stop" button
     */
    public function testGamePageClickedOnStopBankButton(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $client->submitForm('stop');
        $client->submitForm('stopBank');
    }
}
