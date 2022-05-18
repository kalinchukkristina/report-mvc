<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Game\Game;
use App\Game\GameHandler;

/**
 * @SuppressWarnings(PHPMD.ElseExpression)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
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
        $flag = "Player";
        $gameOn = true;
        $winner = false;

        $getNewCard = $request->request->get("card");
        $getNewCardBank = $request->request->get("cardBank");
        $stop = $request->request->get("stop");
        $stopBank = $request->request->get("stopBank");
        $restart = $request->request->get("restart");

        $game = new Game();
        $gameHandler = new GameHandler();

        $banken = $game->banken;
        $player = $game->player;
        $playerPoints = $player->getPoints($session);
        $bankenPoints = $banken->getPoints($session);

        if ($getNewCard) {
            $gameHandler->playerGetCard($session, $player, $game);
            $playerPoints = $player->getPoints($session);
            if ($playerPoints > 21) {
                $winner = "Banken";
                $gameOn = false;
            } elseif ($playerPoints == 21) {
                $gameOn = false;
                $winner = "Player";
            }
        } elseif ($stop) {
            $flag = "Banken";
        } elseif ($getNewCardBank) {
            $flag = "Banken";
            $gameHandler->bankenGetCard($session, $banken, $game);
            $bankenPoints = $banken->getPoints($session);
            if ($bankenPoints > 21) {
                $gameOn = false;
                $winner = "Player";
            } elseif ($bankenPoints == $playerPoints or $bankenPoints > $playerPoints) {
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
        } elseif ($restart) {
            return $this->redirectToRoute('game');
        }

        $playerHand = $player->getHand($session);
        $bankenHand = $banken->getHand($session);

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
    public function clear(): Response
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
