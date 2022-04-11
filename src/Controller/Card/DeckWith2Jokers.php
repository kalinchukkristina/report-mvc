<?php

namespace App\DeckJoker;

use App\Card\Card;

use App\Deck\Deck;

class DeckWith2Jokers extends Deck
{
    public function addJoker(): void
    {
        $joker = new Card("joker", "joker");
        $this->add($joker);
    }
}
