<?php

namespace App\Card;

use App\Card\Card;
use App\Card\Deck;

class DeckWithTwoJokers extends Deck
{
    public function addJoker(): void
    {
        $joker = new Card("joker", "joker");
        $this->add($joker);
    }
}
