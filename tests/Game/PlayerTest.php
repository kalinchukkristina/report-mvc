<?php

namespace App\Game;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

use App\Card\Card;

use PHPUnit\Framework\TestCase;
/**
 * Test suite for class Player
 */
class PlayerTest extends TestCase
{

    /**
     * creating Player object
     */
    public function testCreatePlayer()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Game\Player", $player);

        $this->assertEquals(0, $player->points);
    }

    /**
     * adding a card to the Player hand when
     * no hand is saved in the session
     */
    public function testAddCardToHandHasNoSessionPlayer()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Game\Player", $player);

        $card = new Card(2, "hearts");
        $session = new Session(new MockArraySessionStorage());

        $player->addCardtoHand($card, $session);
        $this->assertContains($card, $player->hand);

    }

    /**
     * adding a card to the Player hand when
     * there is already hand saved in the session
     */
    public function testAddCardToHandHasSessionPlayer()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Game\Player", $player);

        $card = new Card(2, "hearts");
        $session = new Session(new MockArraySessionStorage());
        $session->set("playerHand", [$card]);

        $card2 = new Card(7, "hearts");
        $player->addCardtoHand($card2, $session);
        $this->assertCount(2, $session->get("playerHand"));

    }

    /**
     * getting Players hand when the hand is saved in the session
     */
    public function testGetHandPlayer()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Game\Player", $player);

        $session = new Session(new MockArraySessionStorage());
        $session->set("playerHand", [1]);

        $res = $player->getHand($session);
        $this->assertIsArray($res);

    }

    /**
     * getting Players hand when hand in not in session
     */
    public function testGetHandEmptyPlayer()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Game\Player", $player);

        $session = new Session(new MockArraySessionStorage());

        $res = $player->getHand($session);
        $this->assertStringContainsString("empty", $res);

    }

    /**
     * adding points when there are already points in session
     */
    public function testAddPointsSessionPlayer()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Game\Player", $player);

        $session = new Session(new MockArraySessionStorage());
        $session->set("playerPoints", 15);

        $player->addPoints(10, $session);
        $this->assertEquals(25, $session->get("playerPoints"));

    }

    /**
     * adding points for the first time, no points in session
     */
    public function testAddPointsNoSessionPlayer()
    {
        $player = new Player();
        $session = new Session(new MockArraySessionStorage());

        $player->addPoints(10, $session);
        $this->assertEquals(10, $session->get("playerPoints"));
    }

    /**
     * get points when no points stored in session
     */
    public function testGetPointsNoSessionPlayer()
    {
        $player = new Player();
        $session = new Session(new MockArraySessionStorage());

        $res = $player->getPoints($session);
        $this->assertEquals(0, $res);
    }

    /**
     * get points when points are stored in session
     */
    public function testGetPointsInSessionPlayer()
    {
        $player = new Player();
        $session = new Session(new MockArraySessionStorage());
        $session->set("playerPoints", 25);

        $res = $player->getPoints($session);
        $this->assertEquals(25, $res);
    }
}