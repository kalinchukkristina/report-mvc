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
    public function game(SessionInterface $session): Response
    {
        $data = [
            'title' => 'Game'
        ];
        $session->clear();

        return $this->render('game\landning.html.twig', $data);
    }

    /**
     * @Route("/game/play", name="play", methods={"GET", "POST"})
     */
    public function play(SessionInterface $session, Request $request): Response
    {
        $winner = false;
        $getNewCard = $request->request->get("card");
        $getNewCardBank = $request->request->get("cardBank");
        $stop = $request->request->get("stop");
        $stopBank = $request->request->get("stopBank");

        $game = new Game();
        $player = $game->player;
        $playerHand = $player->getHand($session);
        $playerPoints = $player->getPoints($session);

        $banken = $game->banken;
        $bankenHand = $banken->getHand($session);
        $bankenPoints = $banken->getPoints($session);
        $flag = "Player";

        $restart = $request->request->get("restart");
        $gameOn = true;

        if ($getNewCard) {
            $randomCard = $game->drawACard($session);
            $cardValue = $game->getCardValue($randomCard);

            $player->addCardToHand($randomCard, $session);
            $player->addPoints($cardValue, $session);
            $playerHand = $player->getHand($session);
            $playerPoints = $player->getPoints($session);

            if ($playerPoints > 21) {
                $winner = "Banken";
                $gameOn = false;
            } elseif ($playerPoints == 21) {
                $winner = "Player";
                $gameOn = false;
            }
        } elseif ($stop) {
            $session->set("playerPoints", $playerPoints);
            $flag = "Banken";
        } elseif ($getNewCardBank) {
            $flag = "Banken";
            $randomCard = $game->drawACard($session);
            $cardValue = $game->getCardValue($randomCard);

            $banken->addCardToHand($randomCard, $session);
            $banken->addPoints($cardValue, $session);
            $bankenHand = $banken->getHand($session);
            $bankenPoints = $banken->getPoints($session);

            if ($bankenPoints > 21) {
                $winner = "Player";
                $gameOn = false;
            } elseif ($bankenPoints == $playerPoints || $bankenPoints > $playerPoints) {
                $winner = "Banken";
                $gameOn = false;
            }
        } elseif ($stopBank) {
            if ($bankenPoints == $playerPoints or $bankenPoints > $playerPoints) {
                $winner = "Banken";
                $gameOn = false;
            } else {
                $winner = "Player";
                $gameOn = false;
            }
            $session->set("bankenPoints", $bankenPoints);
        } elseif ($restart) {
            return $this->redirectToRoute('game');
        }

        $data = [
            'title' => 'Play',
            'currentDeck' => $game->currentDeck,
            'playerHand' => $playerHand,
            'bankenHand' => $bankenHand,
            'points' => $playerPoints,
            'pointsB' => $bankenPoints,
            'flag' => $flag,
            'gameOn' => $gameOn,
            'winner' => $winner,
        ];



        return $this->render('game\play.html.twig', $data);
    }

    /**
     * @Route("/game/clear", name="clear")
     */
    public function clear(SessionInterface $session): Response
    {
        return $this->redirectToRoute('game');
    }

    /**
     * @Route("/game/doc", name="doc")
     */
    public function doc(): Response
    {
        $data = [
            'title' => 'Documentation'
        ];

        return $this->render('game\doc.html.twig', $data);
    }
}
