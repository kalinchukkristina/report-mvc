<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testGameLandingPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Game');
//        $client->clickLink('StartGame');
    }

    public function testGamePage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Card game');
    }

    public function testGamePageClickedOnGetNewCardButton(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $client->submitForm('card');
    }

    public function testGamePageClickedOnStopButton(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $client->submitForm('stop');
    }

    public function testGamePageClickedOnGetNewCardBankButton(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $client->submitForm('stop');
        $client->submitForm('cardBank');
    }

    public function testGamePageClickedOnStopBankButton(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $client->submitForm('stop');
        $client->submitForm('stopBank');
    }
}
