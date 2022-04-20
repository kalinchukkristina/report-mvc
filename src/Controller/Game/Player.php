<?php

namespace App\Game;

use App\Card\Card; 

class Player
{
    public function __construct() 
    {
        $this->hand = [];
        $this->points = 0;
    }

    public function addCardToHand(Card $card, $session, $cardValue) 
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

    public function getHand($session) {
        if ($session->has("playerHand")) {
            $playerHand =  $session->get("playerHand");
        } else {
            return "Hand is empty";
        }

        return $playerHand;
    }

    public function addPoints($cardValue, $session) {
        if ($session->has("playerPoints")) {
            $currentPoints = $session->get("playerPoints");
            $currentPoints += $cardValue;
            $session->set("playerPoints", $currentPoints);
        } else {
            $this->points = $cardValue;
            $session->set("playerPoints", $this->points);
        }
    }

    public function getPoints($session) {
        $points =  $session->get("playerPoints");

        return $points;
    }
}