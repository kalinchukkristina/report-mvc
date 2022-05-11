<?php

namespace App\Card;

class Card
{
    public int|string $number;
    public string $suits;
    public string $class1;
    public string $class2;

    /**
     * constructor to create a card object
     */

    public function __construct(int|string $num, string $suits)
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

    /**
     * method to get card in a string format
     */
    public function getAsString(): string
    {
        return "[{$this->number}:{$this->suits}]";
    }
}
