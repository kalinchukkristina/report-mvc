<?php

namespace App\Game;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Card\Card;

class Banken
{
    /**
     * @var int $points   keeps tract of the points the bankens hand
     * @var array<Card> $handB   bankens hand holding the card
     * @var array<Card> $notEmptyHand   bankens hand holding card when there were card stored in session before
     */

    public int $points;
    public array $handB;
    public array $notEmptyHand;


    /**
     * Constructor to create Banken object
     * with empty hand and 0 points
     */
    public function __construct()
    {
        $this->handB = [];
        $this->points = 0;
    }


    /**
     * Method to add a card to the hand
     * @param Card $card   card to be added
     * @param SessionInterface $session   session superglobal to store the hand
     * @return void
     */
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

    /**
     * Method to get the current hand Banken is holding
     * @param SessionInterface $session   session superglobal that stores hand
     * @return mixed
     */
    public function getHand(SessionInterface $session): mixed
    {
        if ($session->has("bankenHand")) {
            $bankenHand =  $session->get("bankenHand");
        } else {
            return "Hand is empty";
        }

        return $bankenHand;
    }



    /**
     * Method to add points for Banken
     * @param int $cardValue   the number to be added
     * @param SessionInterface $session   session superglobal that stores current points
     * @return void
     */

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

    /**
     * Method to get current points in the hand
     * @param SessionInterface $session   session superglobal that stores current points
     * @return int
     */

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
