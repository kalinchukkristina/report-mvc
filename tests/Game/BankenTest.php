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
     * Creating object Card, seting the card color to 'red'
     */
    public function testAddCardToHand()
    {
        $bank = new Banken();
        $this->assertInstanceOf("\App\Game\Banken", $bank);

        $card = new Card(2, "hearts");
        $session = new Session(new MockArraySessionStorage());

        $bank->addCardtoHand($card, $session);
        $this->assertContains($card, $bank->handB);

    }

}