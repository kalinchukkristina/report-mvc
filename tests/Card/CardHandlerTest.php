<?php

namespace App\Card;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

use PHPUnit\Framework\TestCase;
/**
 * Test case for class CardHandler
 */
class CardHandlerTest extends TestCase
{
    /**
     * testing drawACardFromSessionDeck - draw a random Card from a Deck when the deck
     * is stored in session
     */
    public function testCreateCardHandler() 
    {
        $cardHandler = new CardHandler();
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $session = new Session(new MockArraySessionStorage());
        $res = $cardHandler->drawACardFromSessionDeck($deck->deck, $session);
        $this->assertCount(51, $session->get("deck"));
        $this->assertIsArray($res);
        $this->assertContains('false', $res);

        $deck = $session->get("deck");
        $res = $cardHandler->drawACardFromSessionDeck($deck, $session);
        $this->assertCount(50, $session->get("deck"));
        $this->assertIsArray($res);
        $this->assertContains('false', $res);

        $deck = $session->get("deck");
        $res = $cardHandler->drawACardFromSessionDeck($deck, $session);
        $this->assertCount(49, $session->get("deck"));
        $this->assertIsArray($res);
        $this->assertContains('false', $res);
    }

    /**
     * testing to draw a card from the deck for the first time,
     * no deck stored in the session
     */
    public function testDrawACardSessionEmpty()
    {
        $cardHandler = new CardHandler();
        $session = new Session(new MockArraySessionStorage());
        $res = $cardHandler->drawACardSessionEmpty($session);

        $this->assertCount(51, $session->get("deck"));
        $this->assertIsArray($res);
        $this->assertContains('false', $res);
        $this->assertContains(51, $res);
    }
}