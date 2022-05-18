<?php

namespace App\Game;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

use App\Card\Card;

use PHPUnit\Framework\TestCase;
/**
 * Test suite for class Banken
 */
class BankenTest extends TestCase
{

    /**
     * creating Banken object
     */
    public function testCreateBanken()
    {
        $bank = new Banken();
        $this->assertInstanceOf("\App\Game\Banken", $bank);

        $this->assertEquals(0, $bank->points);
    }

    /**
     * adding a card to the Banken hand when
     * no hand is saved in the session
     */
    public function testAddCardToHandHasNoSession()
    {
        $bank = new Banken();
        $this->assertInstanceOf("\App\Game\Banken", $bank);

        $card = new Card(2, "hearts");
        $session = new Session(new MockArraySessionStorage());

        $bank->addCardtoHand($card, $session);
        $this->assertContains($card, $bank->handB);

    }

    /**
     * adding a card to the Banken hand when
     * there is already hand saved in the session
     */
    public function testAddCardToHandHasSession()
    {
        $bank = new Banken();
        $this->assertInstanceOf("\App\Game\Banken", $bank);

        $card = new Card(2, "hearts");
        $session = new Session(new MockArraySessionStorage());
        $session->set("bankenHand", [$card]);

        $card2 = new Card(7, "hearts");
        $bank->addCardtoHand($card2, $session);
        $this->assertCount(2, $session->get("bankenHand"));

    }

    /**
     * getting a hand when the hand is saved in the session
     */
    public function testGetHand()
    {
        $bank = new Banken();
        $this->assertInstanceOf("\App\Game\Banken", $bank);

        $session = new Session(new MockArraySessionStorage());
        $session->set("bankenHand", [1]);

        $res = $bank->getHand($session);
        $this->assertIsArray($res);

    }

    /**
     * getting hand when hand in not in session
     */
    public function testGetHandEmpty()
    {
        $bank = new Banken();
        $this->assertInstanceOf("\App\Game\Banken", $bank);

        $session = new Session(new MockArraySessionStorage());

        $res = $bank->getHand($session);
        $this->assertStringContainsString("empty", $res);

    }

    /**
     * adding points when there are already poonts in session
     */
    public function testAddPointsSession()
    {
        $bank = new Banken();
        $this->assertInstanceOf("\App\Game\Banken", $bank);

        $session = new Session(new MockArraySessionStorage());
        $session->set("bankenPoints", 15);

        $bank->addPoints(10, $session);
        $this->assertEquals(25, $session->get("bankenPoints"));

    }

    /**
     * adding points for the first time, no points in session
     */
    public function testAddPointsNoSession()
    {
        $bank = new Banken();
        $session = new Session(new MockArraySessionStorage());

        $bank->addPoints(10, $session);
        $this->assertEquals(10, $session->get("bankenPoints"));
    }

    /**
     * get points when no points stored in session
     */
    public function testGetPointsNoSession()
    {
        $bank = new Banken();
        $session = new Session(new MockArraySessionStorage());

        $res = $bank->getPoints($session);
        $this->assertEquals(0, $res);
    }

    /**
     * get points when points are stored in session
     */
    public function testGetPointsInSession()
    {
        $bank = new Banken();
        $session = new Session(new MockArraySessionStorage());
        $session->set("bankenPoints", 25);

        $res = $bank->getPoints($session);
        $this->assertEquals(25, $res);
    }
}
