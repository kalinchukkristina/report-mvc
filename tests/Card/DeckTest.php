<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test case for class Deck
 */
class DeckTest extends TestCase
{
    /**
     * create a deck of cards
     */
    public function testCreateDeck()
    {
        $deckObj = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deckObj);

        $deck = $deckObj->createDeck();
        $this->assertIsArray($deck);
    }

    /**
     * add a card to the Deck
     */
    public function testAddCard()
    {
        $deckObj = new Deck();
        $card = new Card(2, "hearts");
        $this->assertInstanceOf("\App\Card\Deck", $deckObj);

        $deck = $deckObj->add($card);
        $this->assertContains($card, $deckObj->deck);

        $this->assertCount(1, $deckObj->deck);
    }

    /**
     * shuffle the deck of cards
     */
    public function testShuffle()
    {
        $deckObj = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deckObj);

        $deck = $deckObj->createDeck();
        $deckShuffled = $deckObj->shuffle();
        $this->assertIsArray($deckShuffled);

        $this->assertCount(52, $deckShuffled);
    }

    /**
     * get deck of cards as a string
     */
    public function testGetAsString()
    {
        $deckObj = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deckObj);

        $deckObj->createDeck();
        $res = $deckObj->getAsString();
        $this->assertStringContainsString("6:clubs", $res);
        $this->assertStringContainsString("J:spades", $res);
        $this->assertStringContainsString("A:diamonds", $res);
    }
}