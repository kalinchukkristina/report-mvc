<?php

namespace App\Game;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Deck\Deck;
use App\Card\Card;

class Game
{
    public function __construct(SessionInterface $session)
    {
        $this->deckObj = new \App\Deck\Deck();
        $this->currentDeck = $this->deckObj->createDeck();
        $this->player = new \App\Game\Player();
        $this->banken = new \App\Game\Banken();
    }

    public function drawACard(SessionInterface $session): Card
    {
        if ($session->has("deckSpel")) {
            $deck = $session->get("deckSpel");
            if (count($deck) > 0) {
                shuffle($deck);
                $randomNumber = random_int(0, count($deck) - 1);

                $randomCard = $deck[$randomNumber];
                unset($deck[$randomNumber]);
                $deck2 = array_values($deck);
                $this->currentDeck = $deck2;

                $session->set("deckSpel", $deck2);
                $flag = 'false';
            } else {
                $flag = 'true';
            }
        } else {
            $deck = $this->deckObj->shuffle();
            $randomNumber = random_int(0, count($deck) - 1);
            $randomCard = $deck[$randomNumber];
            unset($deck[$randomNumber]);
            $deck2 = array_values($deck);
            $this->currentDeck = $deck2;
            var_dump(count($deck2));
            $session->set("deckSpel", $deck2);
            $flag = 'false';
        }

        return $randomCard;
    }

    public function getCardvalue(Card $card): int
    {
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
