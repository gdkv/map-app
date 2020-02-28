<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    /**
     * @Route("/", name="map_index")
     */
    public function index()
    {
        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',
        ]);
    }
}
