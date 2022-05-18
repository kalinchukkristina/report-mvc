<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EnergyShareWorldRepository;
use App\Repository\EnergyShareSwedenRepository;
use App\Repository\EnergySourceRepository;

/**
 * @SuppressWarnings(PHPMD.CamelCaseParameterName)
 * @SuppressWarnings(PHPMD.CamelCaseVariableName)
 */
class ProjektController extends AbstractController
{
    /**
     * @Route("/proj", name="proj")
     */
    public function project(
        EnergyShareWorldRepository $EnergyShareWorldRepository,
        EnergyShareSwedenRepository $EnergyShareSwedenRepository,
        EnergySourceRepository $EnergySourceRepository
    ): Response {
        $percentageData = $EnergyShareWorldRepository->findAll();
        $percentageDataSweden = $EnergyShareSwedenRepository->findAll();
        $energySource = $EnergySourceRepository->findAll();
        $data = [
            'title' => 'Project',
            'energy' => $percentageData,
            'energySweden' => $percentageDataSweden,
            'energySource' => $energySource
        ];

        return $this->render('project\project.html.twig', $data);
    }

    /**
     * @Route("/proj/about", name="about_proj")
     */
    public function aboutProject(): Response
    {
        $data = [
            'title' => 'About project'
        ];

        return $this->render('project\about.html.twig', $data);
    }
}
