<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SmartPageController extends AbstractController
{
    #[Route('/smart/energy', name: 'smart_energy')]
    public function energypage(): Response
    {
        return $this->render('smart_page/smartenergy.html.twig', [
            'controller_name' => 'SmartEnergyController',
        ]);
    }

    #[Route('/smart/home', name: 'smart_home')]
    public function homepage(): Response
    {
        return $this->render('smart_page/smarthome.html.twig', [
            'controller_name' => 'SmartHomeController',
        ]);
    }

    #[Route('/smart/building', name: 'smart_building')]
    public function buildingpage(): Response
    {
        return $this->render('smart_page/smartbuilding.html.twig', [
            'controller_name' => 'SmartBuildingController',
        ]);
    }

    #[Route('/smart/industry', name: 'smart_industry')]
    public function industrypage(): Response
    {
        return $this->render('smart_page/smartindustry.html.twig', [
            'controller_name' => 'SmartIndustryController',
        ]);
    }


}






