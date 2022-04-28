<?php

namespace App\Game;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Card\Card;

class Player
{
    public int $points;
    public int $currentPoints;

    /**
     * @var array<Card> Players hand of cards
     */
    public array $hand;

    /**
     * @var array<Card> Players hand of card when there is already hand in session
     */
    public array $notEmptyHand;

    /**
     * @var array<Card> players hand of card from session
     */
    public array $playerHand;


    /**
     * Constructor to create a Player object
     */
    public function __construct()
    {
        $this->hand = [];
        $this->points = 0;
    }


    /**
     * @param Card $card a card to add to Players hand
     * @param SessionInterface $session session to store hand
     * @return void
     */
    public function addCardToHand(Card $card, SessionInterface $session): void
    {
        if ($session->has("playerHand")) {
            $notEmptyHand = $session->get("playerHand");
            array_push($notEmptyHand, $card);
            $session->set("playerHand", $notEmptyHand);
        } else {
            $this->hand[] = $card;
            $session->set("playerHand", $this->hand);
        }
    }


    /**
     * @param SessionInterface $session get hand from session
     * @return mixed
     */
    public function getHand(SessionInterface $session): mixed
    {
        if ($session->has("playerHand")) {
            $playerHand =  $session->get("playerHand");
        } else {
            return "Hand is empty";
        }

        return $playerHand;
    }


    /**
     * @param int $cardValue card value to calculate points
     * @param SessionInterface $session to store points in session
     */
    public function addPoints(int $cardValue, SessionInterface $session): void
    {
        if ($session->has("playerPoints")) {
            $currentPoints = $session->get("playerPoints");
            $currentPoints += $cardValue;
            $session->set("playerPoints", $currentPoints);
        } else {
            $this->points = $cardValue;
            $session->set("playerPoints", $this->points);
        }
    }

    /**
     * @param SessionInterface $session get points from session
     * @return int
     */
    public function getPoints(SessionInterface $session): int
    {
        if ($session->has("playerPoints")) {
            $points = $session->get("playerPoints");
        } else {
            $points = 0;
        }

        return $points;
    }
}
