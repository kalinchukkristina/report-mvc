<?php

namespace App\Card;

class PlayerCard
{
    public int $idNum;
    /**
     * @var array<Card> a hand with cards
     */
    public array $hand;

    /**
     * @param mixed $idNum a players idNum
     */
    public function __construct(mixed $idNum)
    {
        if (is_int($idNum)) {
            $this->idNum = $idNum;
        } else {
            throw new IdTypeException("Id should only be a number");
        }
    }

    /**
     * @param Card $card a card to be added to the hand
     */
    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }
}
