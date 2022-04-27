<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test case for class DeckWithTwoJokers
 */
class DeckWithTwoJokersTest extends TestCase
{
    /**
     * create a deck of cards with two jokers
     */
    public function testAddJoker()
    {
        $deckJokerObj = new DeckWithTwoJokers ();
        $this->assertInstanceOf("\App\Card\DeckWithTwoJokers", $deckJokerObj);

        $deckJokerObj->addJoker();
        $this->assertContainsOnlyInstancesOf(Card::class, $deckJokerObj->deck);

        $this->assertCount(1, $deckJokerObj->deck);

        $deckJokerObj->addJoker();
        $this->assertCount(2, $deckJokerObj->deck);
    }

}