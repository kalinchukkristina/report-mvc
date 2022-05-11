<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetricsController extends AbstractController
{
    /**
     * @Route("/metrics", name="metrics")
     */
    public function mertics(): Response
    {
        $data = [
            'title' => 'Metrics'
        ];

        return $this->render('metrics\metrics.html.twig', $data);
    }
}
