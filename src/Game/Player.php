<?php

namespace App\Game;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Card\Card;

class Player
{
    public array $hand;
    public int $points;
    public array $notEmptyHand;
    public array $playerHand;
    public int $currentPoints;

    public function __construct()
    {
        $this->hand = [];
        $this->points = 0;
    }

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

    public function getHand(SessionInterface $session): mixed
    {
        if ($session->has("playerHand")) {
            $playerHand =  $session->get("playerHand");
        } else {
            return "Hand is empty";
        }

        return $playerHand;
    }

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
