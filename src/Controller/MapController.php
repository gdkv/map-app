<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MapController extends AbstractController
{
    /**
     * @Route("/", name="map_index")
     */
    public function index(AuthenticationUtils $authUtils)
    {
        $user = $this->getUser();
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        
        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',
            'last_username' => $lastUsername,
            'error' => $error,
            'user' => $user,
        ]);
    }

    /**
     * @Route("/logout", name="map_logout")
     */
    public function logout() 
    {

    }
}
