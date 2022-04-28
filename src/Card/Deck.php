<?php

namespace App\Card;

use App\Card\Card;

class Deck
{
    /**
     * @var array<Card> a deck of cards
     */
    public $deck;

    /**
     * @return array<Card>
     */
    public function createDeck(): array
    {
        $numbers = [2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K", "A"];
        $suits = ["diamonds", "clubs", "hearts", "spades"];

        for ($z = 0; $z <= count($suits) - 1; $z += 1) {
            for ($x = 0; $x <= count($numbers) - 1; $x += 1) {
                $this->deck[] = (new \App\Card\Card($numbers[$x], $suits[$z]));
            }
        }

        return($this->deck);
    }
    /**
     * @param Card $card a card to add to the hand
     * @return void
     */

    public function add(Card $card): void
    {
        $this->deck[] = $card;
    }

    /**
     * @return array<Card>
     */

    public function shuffle(): array
    {
        shuffle($this->deck);
        return($this->deck);
    }

    /**
     * @return string returns card as a string
     */
    public function getAsString(): string
    {
        $str = "";
        foreach ($this->deck as $card) {
            $str .= $card->getAsString();
        }
        return $str;
    }
}
