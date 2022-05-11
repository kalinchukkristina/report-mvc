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

        $this->assertCount(53, $deckJokerObj->deck);

        $deckJokerObj->addJoker();
        $this->assertCount(54, $deckJokerObj->deck);
    }

}