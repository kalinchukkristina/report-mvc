<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Deck\Deck;

class CardController extends AbstractController
{
    public function createDeck()
    {
        $numbers = [2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K", "A"];
        $suits = ["diamonds", "clubs", "hearts", "spades"];
        $newDeck = new \App\Deck\Deck();

        for ($z = 0; $z <= count($suits) - 1; $z += 1) {
            for ($x = 0; $x <= count($numbers) - 1; $x += 1) {
                $newDeck->add(new \App\Card\Card($numbers[$x], $suits[$z]));
            }
        };

        return $newDeck;
    }


    /**
     * @Route("/card", name="card")
     */
    public function card(): Response
    {
        $data = [
            'title' => 'Card'
        ];

        return $this->render('lek\card.html.twig', $data);
    }

    /**
     * @Route("/card/deck", name="deck")
     */
    public function deck(): Response
    {
        $deck = $this->createDeck();

        $data = [
            'title' => 'Deck',
            'deck' => $deck->deck,
        ];

        return $this->render('lek\deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/shuffle", name="shuffle")
     */
    public function shuffle(SessionInterface $session): Response
    {
        $deck = $this->createDeck();
        $session->clear();

        $data = [
            'title' => 'Shuffle',
            'deck' => $deck->shuffle(),
        ];

        return $this->render('lek\deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw", name="draw")
     */
    public function draw(SessionInterface $session): Response
    {
        if ($session->has("deck")) {
            $deck = $session->get("deck");
            if (count($deck) > 0) {
                shuffle($deck);
                $randomNumber = random_int(0, count($deck) - 1);

                $randomCard = $deck[$randomNumber];
                unset($deck[$randomNumber]);
                $deck2 = array_values($deck);

                var_dump(count($deck2));

                $session->set("deck", $deck2);
                $flag = 'false';
            } else {
                $flag = 'true';
            }
        } else {
            $deckObj = $this->createDeck();
            $deck = $deckObj->shuffle();
            $randomNumber = random_int(0, count($deck) - 1);
            $randomCard = $deck[$randomNumber];
            unset($deck[$randomNumber]);
            $deck2 = array_values($deck);
            var_dump(count($deck2));
            $session->set("deck", $deck2);
            $flag = 'false';
        }

        $data = [
            'title' => 'Draw',
            'randomCard' => $randomCard,
            'deck' => $deck2,
            'flag' => $flag
        ];

        return $this->render('lek\draw.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw/{numToDraw}", name="drawNumber")
     */
    public function drawNumber(SessionInterface $session, int $numToDraw): Response
    {
        $randomCards = array();

        if ($session->has("deck")) {
            for ($i = 0; $i < $numToDraw; $i++) {
                $deck = [];
                $deck = $session->get("deck");
                $randomNumber = random_int(0, count($deck) - 1);
                shuffle($deck);
                if (count($deck) >= $numToDraw) {
                    $randomCard = $deck[$randomNumber];
                    array_push($randomCards, $randomCard);
                    array_splice($deck, $randomNumber, 1);
                    $session->set("deck", $deck);
                    $flag = 'false';
                } else {
                    $flag = 'true';
                }
            }
        } else {
            $deckObj = $this->createDeck();
            $deck = $deckObj->shuffle();
            $session->set("deck", $deck);
            for ($i = 0; $i < $numToDraw; $i++) {
                $deck = [];
                $deck = $session->get("deck");
                $randomNumber = random_int(0, count($deck) - 1);
                shuffle($deck);
                if (count($deck) >= $numToDraw) {
                    $randomCard = $deck[$randomNumber];
                    array_push($randomCards, $randomCard);
                    array_splice($deck, $randomNumber, 1);
                    $session->set("deck", $deck);
                    $flag = 'false';
                } else {
                    $flag = 'true';
                }
            }
        }

        var_dump(count($deck));

        $data = [
            'title' => 'DrawNumber',
            'randomCards' => $randomCards,
            'deck' => $deck,
            'flag' => $flag
        ];

        return $this->render('lek\drawNumber.html.twig', $data);
    }

    /**
     * @Route("/card/deck/deal/{players}/{cards}", name="deal")
     */
    public function deal(SessionInterface $session, int $players, int $cards): Response
    {
        if ($session->has("deck2")) {
            $deck = $session->get("deck2");
            shuffle($deck);
        } else {
            $deckObj = $this->createDeck();
            $deck = $deckObj->shuffle();
        }

        $listPlayers = [];

        if (count($deck) >= ($cards * $players)) {
            for ($i = 1; $i < $players + 1; $i++) {
                $player = new \App\Card\Player($i);
                array_push($listPlayers, $player);

                for ($j = 0; $j < $cards; $j++) {
                    $randomNumber = random_int(0, count($deck) - 1);
                    $randomCard = $deck[$randomNumber];
                    $player->add($randomCard);
                    array_splice($deck, $randomNumber, 1);
                    $session->set("playerHand", $player->hand);
                }
            }
            $flag = 'false';
        } else {
            $flag = 'true';
        }

        $session->set("deck2", $deck);

        var_dump(count($deck));

        $data = [
            'title' => 'Deal',
            'players' => $listPlayers,
            'deck' => $deck,
            'flag' => $flag,
        ];

        return $this->render('lek\deal.html.twig', $data);
    }



    /**
     * @Route("/card/deck2", name="deck2")
     */
    public function deck2(): Response
    {
        $numbers = [2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K", "A"];
        $suits = ["diamonds", "clubs", "hearts", "spades"];
        $newDeck = new \App\DeckJoker\DeckWith2Jokers();

        for ($z = 0; $z <= count($suits) - 1; $z += 1) {
            for ($x = 0; $x <= count($numbers) - 1; $x += 1) {
                $newDeck->add(new \App\Card\Card($numbers[$x], $suits[$z]));
            }
        };

        $newDeck->addJoker();
        $newDeck->addJoker();

        $data = [
            'title' => 'Deck',
            'deck' => $newDeck->deck,
        ];

        return $this->render('lek\deckJoker.html.twig', $data);
    }


    /**
     * @Route("/card/api/deck")
     */
    public function number(): Response
    {
        $this->deck = $this->createDeck();

        $data = [
            'deck' => $this->deck
        ];

        return new JsonResponse($data);
    }
}
