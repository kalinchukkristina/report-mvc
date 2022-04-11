<?php

namespace App\Card;

class Card
{
    public function __construct($num, $suits)
    {
        $this->number = $num;
        $this->suits = $suits;
        $this->class1 = "card";
        if ($suits == "diamonds" || $suits == "hearts") {
            $this->class2 = "red";
        } else {
            $this->class2 = "black";
        }
    }

    public function getAsString(): string
    {
        return "[{$this->number}:{$this->suits}]";
    }
}
