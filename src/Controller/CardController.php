<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Card\Card;
use App\Card\Deck;
use App\Card\CardHandler;
use App\Card\DeckWithTwoJokers;
use App\Card\PlayerCard;

/**
 * @SuppressWarnings(PHPMD.ElseExpression)
 * @SuppressWarnings(PHPMD.UnusedPrivateField)
 */
class CardController extends AbstractController
{
    /**
     * @var array<mixed> an array containing a flag variable, a random card object and the length of the remaining deck
     */
    private $randomCardInfo; /** @phpstan-ignore-line */

    /**
     * @var Deck a deck of cards
     */
    private $deck;

    /**
     * @var string a flag contaning tru or false to indicate in there are cards left in the deck
     */
    private $flag; /** @phpstan-ignore-line */

    /**
     * @Route("/card", name="card")
     */
    public function card(): Response
    {
        $data = [
            'title' => 'Card'
        ];

        return $this->render('card\card.html.twig', $data);
    }

    /**
     * @Route("/card/deck", name="deck")
     */
    public function deck(): Response
    {
        $deck = new Deck();

        $data = [
            'title' => 'Deck',
            'deck' => $deck->deck,
        ];

        return $this->render('card\deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/shuffle", name="shuffle")
     */
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new Deck();
        $session->clear();

        $data = [
            'title' => 'Shuffle',
            'deck' => $deck->shuffle(),
        ];

        return $this->render('card\deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw", name="draw")
     */
    public function draw(SessionInterface $session): Response
    {
        $handler = new CardHandler();

        if ($session->has("deck")) {
            $deck = $session->get("deck");
            $randomCardInfo = $handler->drawACardFromSessionDeck($deck, $session);
        } else {
            $randomCardInfo = $handler->drawACardSessionEmpty($session);
        }

        $data = [
            'title' => 'Draw',
            'randomCard' => $randomCardInfo[1],
            'flag' => $randomCardInfo[0],
            'remainingCards' => $randomCardInfo[2]
        ];

        return $this->render('card\draw.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw/{numToDraw}", name="drawNumber")
     */
    public function drawNumber(SessionInterface $session, int $numToDraw): Response
    {
        $randomCards = array();
        $flag = 'false';
        $handler = new CardHandler();

        for ($i = 0; $i < $numToDraw; $i++) {
            if ($session->has("deck")) {
                $deck = $session->get("deck");
                $randomCardInfo = $handler->drawACardFromSessionDeck($deck, $session);
                if ($randomCardInfo[2] < $numToDraw) {
                    $flag = 'true';
                } else {
                    array_push($randomCards, $randomCardInfo[1]);
                }
            } else {
                $randomCardInfo = $handler->drawACardSessionEmpty($session);
                array_push($randomCards, $randomCardInfo[1]);
            }
        }

        $data = [
            'title' => 'DrawNumber',
            'randomCards' => $randomCards,
            'remainingCards' => $randomCardInfo[2], /** @phpstan-ignore-line */
            'flag' => $flag
        ];

        return $this->render('card\drawNumber.html.twig', $data);
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
            $deckObj = new Deck();
            $deck = $deckObj->shuffle();
        }

        $listPlayers = [];

        if (count($deck) >= ($cards * $players)) {
            for ($i = 1; $i < $players + 1; $i++) {
                $player = new PlayerCard($i);
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
        $remainingCards = count($deck);

        $data = [
            'title' => 'Deal',
            'players' => $listPlayers,
            'remainingCards' => $remainingCards,
            'flag' => $flag,
        ];

        return $this->render('card\deal.html.twig', $data);
    }



    /**
     * @Route("/card/deck2", name="deck2")
     */
    public function deck2(): Response
    {
        $deck = new DeckWithTwoJokers();

        $deck->addJoker();
        $deck->addJoker();

        $data = [
            'title' => 'DeckJoker',
            'deck' => $deck->deck,
        ];

        return $this->render('card\deckJoker.html.twig', $data);
    }


    /**
     * @Route("/card/api/deck", name="api")
     */
    public function number(): Response
    {
        $this->deck = new Deck();

        $data = [
            'deck' => $this->deck
        ];

        return new JsonResponse($data);
    }
}
