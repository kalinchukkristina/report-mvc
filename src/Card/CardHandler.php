<?php

namespace App\Card;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Card\Deck;
use App\Card\Card;

class CardHandler
{

    private int $numberOfCardsLeft;
    private Card $randomCard;

    /**
     * A function to draw a random card from deck if there is already a previous deck stored
     * in session
     * @param Deck $deck - a deck of cards
     * @param SessionInterface $session   session superglobal to store the deck
     * @return array<mixed>
     */
    public function drawACardFromSessionDeck(array $deck, SessionInterface $session): array
    {
        $flag = 'true';
        if (count($deck) > 0) {
            shuffle($deck);

            $randomNumber = random_int(0, count($deck) - 1);
            $randomCard = $deck[$randomNumber];

            unset($deck[$randomNumber]);
            $deck2 = array_values($deck);
            $session->set("deck", $deck2);

            $numberOfCardsLeft = count($deck2);
            $flag = 'false';
        }

        return [$flag, $randomCard, $numberOfCardsLeft];
    }

    /**
     * A function to draw a card for the first time, the deck is full, has 52 cards
     * @param SessionInterface $session   session superglobal to store the deck
     * @return array<mixed>
     */
    public function drawACardSessionEmpty(SessionInterface $session): array
    {
        $deckObj = new Deck();
        $deck = $deckObj->shuffle();

        $randomNumber = random_int(0, count($deck) - 1);
        $randomCard = $deck[$randomNumber];

        unset($deck[$randomNumber]);
        $deck2 = array_values($deck);
        $session->set("deck", $deck2);

        $numberOfCardsLeft = count($deck2);
        $flag = 'false';

        return [$flag, $randomCard, $numberOfCardsLeft];
    }
}
