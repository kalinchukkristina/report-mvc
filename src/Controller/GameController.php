<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Game\Game;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function game(): Response {

        $data = [
            'title' => 'Game'
        ];

        return $this->render('game\landning.html.twig', $data);
    }

    /**
     * @Route("/play", name="play", methods={"GET", "POST"})
     */
    public function play(SessionInterface $session, Request $request): Response {
        $getNewCard = $request->request->get("card");
        $stop = $request->request->get("stop");

        $game = new Game();
        $player = $game->player;
        $playerHand = $player->getHand($session);
        $playerPoints = $player->points;

        if ($getNewCard) {
            $randomCard = $game->drawACard($session);
            $cardValue = $game->getCardValue($randomCard);

            $player->addCardToHand($randomCard, $session, $cardValue);
            $player->addPoints($cardValue, $session);
            $playerHand = $player->getHand($session);
            $playerPoints = $player->getPoints($session);
        } elseif ($stop) {
            
        }


        $data = [
            'title' => 'Play',
            'currentDeck' => $game->currentDeck,
            'playerHand' => $playerHand,
            'points' => $playerPoints,
        ];


        return $this->render('game\play.html.twig', $data);
    }

    /**
     * @Route("/clear", name="clear")
     */
    public function clear(SessionInterface $session): Response {
        $session->clear();
        return $this->redirectToRoute('game');
    }
}