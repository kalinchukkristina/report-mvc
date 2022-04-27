<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;
/**
 * Test case for class Card
 */
class CardTest extends TestCase
{
    /**
     * Creating object Card, seting the card color to 'red'
     */
    public function testCreateCard()
    {
        $card = new Card(2, "hearts");
        $this->assertInstanceOf("\App\Card\Card", $card);
    }

    /**
     * Creating object Card, seting the card color to 'black'
     */
    public function testCreateCardBlackColor()
    {
        $card = new Card(2, "clubs");
        $this->assertInstanceOf("\App\Card\Card", $card);
    }

    /**
     * Creating object Card, geting back a string representation of the card
     */
    public function testGetCardAsAString()
    {
        $card = new Card(2, "clubs");

        $res = $card->getAsString();
        $exp = "[2:clubs]";
        $this->assertEquals($exp, $res);
    }
}