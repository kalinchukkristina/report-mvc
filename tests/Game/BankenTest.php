<?php

namespace App\Game;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

use App\Card\Card;

use PHPUnit\Framework\TestCase;
/**
 * Test case for class Banken
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
/*    public function testAddCardToHandHasSession()
    {
        $bank = new Banken();
        $this->assertInstanceOf("\App\Game\Banken", $bank);

        $card = new Card(2, "hearts");
        $session = new Session(new MockArraySessionStorage());
        $session->setName("bankenHand");

        $bank->addCardtoHand($card, $session);
        $this->assertCount(1, $bank->notEmptyHand);

    }*/

    /**
     * getting a hand when the hand is saved in the session
     */
/*    public function testGetHand()
    {
        $bank = new Banken();
        $this->assertInstanceOf("\App\Game\Banken", $bank);

        $session = new Session(new MockArraySessionStorage());
        $session->setName("bankenHand");

        $res = $bank->getHand($session);
        $this->assertIsArray($res);

    }*/

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
/*    public function testAddPoints()
    {
        $bank = new Banken();
        $this->assertInstanceOf("\App\Game\Banken", $bank);

        $session = new Session(new MockArraySessionStorage());
        $session->setName("bankenPoints);

        $res = $bank->addPoints(10, $session);

    }*/

    /**
     * adding points for the first time, bo points in session
     */
    public function testGetPointsNoSession()
    {
        $bank = new Banken();
        $session = new Session(new MockArraySessionStorage());

        $res = $bank->getpoints($session);
        $this->assertEquals(0, $res);
    }
}