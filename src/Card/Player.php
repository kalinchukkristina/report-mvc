<?php

namespace App\Card;

class Player
{
    public int $id;
    /**
     * @var array<Card> a hand with cards
     */
    public array $hand;

    /**
     * @param mixed $id a players id
     */
    public function __construct(mixed $id)
    {
        if (is_int($id)) {
            $this->id = $id;
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
