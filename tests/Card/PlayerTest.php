<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;
/**
 * Test case for class PlayerCard
 */
class PlayerCardTest extends TestCase
{
    /**
     * Creating object PlayerCard with correct id
     */
    public function testCreatePlayerCard()
    {
        $playerCard = new PlayerCard(1);
        $this->assertEquals(1, $playerCard->idNum);

        $playerCard = new PlayerCard(3);
        $this->assertEquals(3, $playerCard->idNum);
    }

    /**
     * Creating object PlayerCard with incorrect id
     */
    public function testCreatePlayerCardWrongId()
    {
        $this->expectException(IdTypeException::class);
        $playerCard = new PlayerCard("33");

        $this->expectException(IdTypeException::class);
        $playerCard = new PlayerCard(false);
    }

    /**
     * Creating object PlayerCard with incorrect id
     */
    public function testAddcardToHand()
    {
        $playerCard = new PlayerCard(1);
        $card = new Card(2, "clubs");

        $playerCard->add($card);
        $this->assertContains($card, $playerCard->hand);

    }

}