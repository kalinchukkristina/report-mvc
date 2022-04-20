<?php

namespace App\Game;


use App\Deck\Deck;
use App\Card\Card;

class Game
{
    public function __construct()
    {
        $deck = new \App\Deck\Deck;
        $this->currentDeck = $deck->createDeck();
        $this->player = new \App\Game\Player;
    }

    public function drawACard($session) {
        if ($session->has("deckGame")) {
            $deck = $session->get("deckGame");
            if (count($deck) > 0) {
                shuffle($deck);
                $randomNumber = random_int(0, count($deck) - 1);

                $randomCard = $deck[$randomNumber];
                unset($deck[$randomNumber]);
                $deck2 = array_values($deck);

                $session->set("deckGame", $deck2);
                $flag = 'false';
            } else {
                $flag = 'true';
            }
        } else {
            $deck = $this->currentDeck;
            shuffle($deck);
            $randomNumber = random_int(0, count($deck) - 1);
            $randomCard = $deck[$randomNumber];
            unset($deck[$randomNumber]);
            $deck2 = array_values($deck);
            $session->set("deckGame", $deck2);
            $flag = 'false';
        }

        return $randomCard;
    }

    public function getCardvalue(Card $card) {
        if ($card->number == "J") {
            $value = 11;
        } elseif ($card->number == "Q") {
            $value = 12;
        } elseif ($card->number == "K") {
            $value = 13;
        } elseif ($card->number == "A") {
            $value = 14;
        } else {
            $value = $card->number;
        }

        return $value;
    }
}
