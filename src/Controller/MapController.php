<?php

namespace App\Controller;

use App\Entity\Marker;
use App\Repository\MarkerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MapController extends AbstractController
{
    /**
     * @var MarkerRepository
     */
    private $markerRepository;

    public function __construct(MarkerRepository $markerRepository)
    {
        $this->markerRepository = $markerRepository;
    }

    /**
     * @Route("/", name="map_index")
     */
    public function index(AuthenticationUtils $authUtils)
    {
        $user = $this->getUser();
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        
        $markers = $this->markerRepository->findBy(
            ['users' => $user, ],
            ['createAt' => 'DESC'],
        );

        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',
            'last_username' => $lastUsername,
            'error' => $error,
            'user' => $user,
            'markers' => $markers,
        ]);
    }

    /**
     * @Route("/logout", name="map_logout")
     */
    public function logout() 
    {

    }
}
