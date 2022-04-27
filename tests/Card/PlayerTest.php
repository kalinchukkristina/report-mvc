<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;
/**
 * Test case for class Player
 */
class PlayerTest extends TestCase
{
    /**
     * Creating object Player with correct id
     */
    public function testCreatePlayer()
    {
        $player = new Player(1);
        $this->assertEquals(1, $player->id);

        $player = new Player(3);
        $this->assertEquals(3, $player->id);
    }

    /**
     * Creating object Player with incorrect id
     */
    public function testCreatePlayerWrongId()
    {
        $this->expectException(IdTypeException::class);
        $player = new Player("33");

        $this->expectException(IdTypeException::class);
        $player = new Player(false);
    }

    /**
     * Creating object Player with incorrect id
     */
    public function testAddcardToHand()
    {
        $player = new Player(1);
        $card = new Card(2, "clubs");

        $player->add($card);
        $this->assertContains($card, $player->hand);

    }

}