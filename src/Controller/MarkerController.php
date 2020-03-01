<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marker")
 */
class MarkerController extends AbstractController
{
    /**
     * @Route("/add", name="marker_add")
     */
    public function add()
    {
        return $this->render('marker/add.html.twig', [
            'controller_name' => 'MarkerController',
        ]);
    }

    /**
     * @Route("/edit", name="marker_edit")
     */
    public function edit()
    {
        return $this->render('marker/add.html.twig', [
            'controller_name' => 'MarkerController',
        ]);
    }

    /**
     * @Route("/delete", name="marker_delete")
     */
    public function delete()
    {
        return $this->render('marker/add.html.twig', [
            'controller_name' => 'MarkerController',
        ]);
    }
}
