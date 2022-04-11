<?php

namespace App\Card;

class Player
{
    public $hand = [];

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }
}
