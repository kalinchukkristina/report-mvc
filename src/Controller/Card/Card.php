<?php

namespace App\Card;

class Card
{
    public int|string $number;
    public string $suits;
    public string $class1;
    public string $class2;

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

    public function getAsString(): string
    {
        return "[{$this->number}:{$this->suits}]";
    }
}
