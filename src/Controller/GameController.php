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
    public function game(): Response
    {
        $data = [
            'title' => 'Game'
        ];

        return $this->render('game\landning.html.twig', $data);
    }

    /**
     * @Route("/play", name="play", methods={"GET", "POST"})
     */
    public function play(SessionInterface $session, Request $request): Response
    {
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

        if ($getNewCard) {
            $randomCard = $game->drawACard($session);
            $cardValue = $game->getCardValue($randomCard);

            $player->addCardToHand($randomCard, $session, $cardValue);
            $player->addPoints($cardValue, $session);
            $playerHand = $player->getHand($session);
            $playerPoints = $player->getPoints($session);

            if ($playerPoints > 21) {
                $winner = "Banken";
            }

        } elseif ($stop) {
            $session->set("playerPoints", $playerPoints);
            $flag = "Banken";
        } elseif ($getNewCardBank) {
            $flag = "Banken";
            $randomCard = $game->drawACard($session);
            $cardValue = $game->getCardValue($randomCard);

            $banken->addCardToHand($randomCard, $session, $cardValue);
            $banken->addPoints($cardValue, $session);
            $bankenHand = $banken->getHand($session);
            $bankenPoints = $banken->getPoints($session);

            if ($bankenPoints > 21) {
                $winner = "Player";
            }
        } elseif ($stopBank) {
            $game->flag = "Stop";
            $session->set("bankenPoints", $bankenPoints);
        }

        var_dump($flag);
        $data = [
            'title' => 'Play',
            'currentDeck' => $game->currentDeck,
            'playerHand' => $playerHand,
            'bankenHand' => $bankenHand,
            'points' => $playerPoints,
            'pointsB' => $bankenPoints,
            'flag' => $flag,
        ];
        


        return $this->render('game\play.html.twig', $data);
    }

    /**
     * @Route("/clear", name="clear")
     */
    public function clear(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute('game');
    }
}
