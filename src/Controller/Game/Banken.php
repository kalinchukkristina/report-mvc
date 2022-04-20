<?php

namespace App\Game;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Card\Card;

class Banken
{
    public function __construct()
    {
        $this->handB = [];
        $this->points = 0;
    }

    public function addCardToHand(Card $card, SessionInterface $session): void
    {
        if ($session->has("bankenHand")) {
            $notEmptyHand = $session->get("bankenHand");
            array_push($notEmptyHand, $card);
            $session->set("bankenHand", $notEmptyHand);
        } else {
            $this->handB[] = $card;
            $session->set("bankenHand", $this->handB);
        }
    }

    public function getHand(SessionInterface $session): mixed
    {
        if ($session->has("bankenHand")) {
            $bankenHand =  $session->get("bankenHand");
        } else {
            return "Hand is empty";
        }

        return $bankenHand;
    }

    public function addPoints(int $cardValue, SessionInterface $session): void
    {
        if ($session->has("bankenPoints")) {
            $currentPoints = $session->get("bankenPoints");
            $currentPoints += $cardValue;
            $session->set("bankenPoints", $currentPoints);
        } else {
            $this->points = $cardValue;
            $session->set("bankenPoints", $this->points);
        }
    }

    public function getPoints(SessionInterface $session): int
    {
        if ($session->has("bankenPoints")) {
            $points = $session->get("bankenPoints");
        } else {
            $points = 0;
        }

        return $points;
    }
}