<?php

namespace App\Game;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Game\Game;
use App\Game\Player;
use App\Game\Banken;

class GameHandler {
    /**
     * @param SessionInterface $session to draw a card from deck that is stored in session
     * @param Player $player a player object
     * @param Game $game a game object
     * @return void
     */
    public function playerGetCard(SessionInterface $session, $player, $game) {
        $randomCard = $game->drawACard($session);
        $cardValue = $game->getCardValue($randomCard);

        $player->addCardToHand($randomCard, $session);
        $player->addPoints($cardValue, $session);
    }

    /**
     * @param SessionInterface $session to draw a card from deck that is stored in session
     * @param Banken $banken a banken object
     * @param Game $game a game object
     * @return void
     */
    public function bankenGetCard(SessionInterface $session, $banken, $game) {
        $randomCard = $game->drawACard($session);
        $cardValue = $game->getCardValue($randomCard);

        $banken->addCardToHand($randomCard, $session);
        $banken->addPoints($cardValue, $session);
    }

}