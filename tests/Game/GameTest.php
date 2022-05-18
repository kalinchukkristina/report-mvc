<?php

namespace App\Game;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

use App\Card\Card;

use PHPUnit\Framework\TestCase;
/**
 * Test suite for class Game
 */
class GameTest extends TestCase
{
    /**
     * creating object Game
     */
    public function testCreateGame()
    {
        $game = new Game;
        $this->assertInstanceOf("\App\Game\Game", $game);
    }

    /**
     * testing to get a random Card from Deck when
     * no deck is saved in the session
     */
    public function testGetRandomCardWhenNoSessionIsSet()
    {
        $game = new Game;
        $this->assertInstanceOf("\App\Game\Game", $game);

        $session = new Session(new MockArraySessionStorage());
        $randomCard = $game->drawACard($session);

        $this->assertInstanceOf("\App\Card\Card", $randomCard);
    }

    /**
     * testing to get a random card from the deck when
     * deck is stored in session
     */
    public function testGetRandomCardWhenSessionIsSet()
    {
        $game = new Game;
        $this->assertInstanceOf("\App\Game\Game", $game);

        $card = new Card("J", "spades");
        $session = new Session(new MockArraySessionStorage());
        $session->set("deckSpel", [$card]);

        $randomCard = $game->drawACard($session);

        $this->assertInstanceOf("\App\Card\Card", $randomCard);
    }

    /**
     * geting a numerical value of the card if the card is
     * Jack, Queen, King or Ace
     */
    public function testGetCardValueLetter()
    {
        $game = new Game;

        $card = new Card("J", "spades");
        $res = $game->getCardvalue($card);
        $this->assertEquals(11, $res);

        $card = new Card("Q", "hearts");
        $res = $game->getCardvalue($card);
        $this->assertEquals(12, $res);

        $card = new Card("K", "clubs");
        $res = $game->getCardvalue($card);
        $this->assertEquals(13, $res);

        $card = new Card("A", "diamonds");
        $res = $game->getCardvalue($card);
        $this->assertEquals(14, $res);
    }

    /**
     * geting a numerical value of the card if the card has number
     */
    public function testGetCardValueNumber()
    {
        $game = new Game;

        $card = new Card(7, "spades");
        $res = $game->getCardvalue($card);
        $this->assertEquals(7, $res);

        $card = new Card(8, "hearts");
        $res = $game->getCardvalue($card);
        $this->assertEquals(8, $res);
    }

}