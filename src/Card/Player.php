<?php

namespace App\Card;

class Player
{
    public $hand = [];

    public function __construct($id)
    {
        if (is_int($id)) {
            $this->id = $id;
        } else {
            throw new IdTypeException("Id should only be a number");
        }
    }

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }
}
