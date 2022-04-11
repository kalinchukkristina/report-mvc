<?php

namespace App\Deck;

use App\Card\Card;

class Deck
{
    public $deck = [];

    public function add(Card $card): void
    {
        $this->deck[] = $card;
    }

    public function sort(): void
    {
        foreach ($this->deck as $eachCard) {
            $die->roll();
        }
    }

    public function shuffle(): array
    {
        shuffle($this->deck);
        return($this->deck);
    }

    public function getAsString(): string
    {
        $str = "";
        foreach ($this->deck as $card) {
            $str .= $card->getAsString();
        }
        return $str;
    }
}
