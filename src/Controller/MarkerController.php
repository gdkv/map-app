<?php

namespace App\Controller;

use App\Entity\Marker;
use App\Form\MarkerType;
use App\Repository\MarkerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marker")
 */
class MarkerController extends AbstractController
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
     * @Route("/list.json", name="marker_list")
     */
    public function list()
    {
        $collection = [
            "type" => "FeatureCollection",
            "features" => [],
        ];

        $currentUser = $this->getUser();
        $markers = $this->markerRepository->findBy(
            ['users' => $currentUser ],
        );
        foreach ($markers as $marker) {
            $collection["features"][] = [
                "type" => 'Feature',
                "geometry" => [
                    "type" => 'Point',
                    "coordinates" => [$marker->getLat(), $marker->getLon()]
                ],
                "properties" => [
                    "title" => $marker->getTitle(),
                    "description" => $marker->getDescription(),
                ],
            ];
        }

        $response = new JsonResponse();
        $response->setData($collection);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/add", name="marker_add")
     */
    public function add(Request $request)
    {
        $marker = new Marker();
        $currentUser = $this->getUser();
        $form = $this->createForm(MarkerType::class, $marker);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $marker->setUsers($currentUser);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($marker);
            $entityManager->flush();

            return $this->redirectToRoute('map_index');
        }
        return $this->render('marker/add.html.twig', [
            'markerForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="marker_edit")
     */
    public function edit(Request $request, Marker $marker)
    {
        $currentUser = $this->getUser();

        $form = $this->createForm(MarkerType::class, $marker);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $marker->setUsers($currentUser);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('map_index');
        }
        return $this->render('marker/add.html.twig', [
            'markerForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="marker_delete")
     */
    public function delete(Marker $marker)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($marker);
        $entityManager->flush();
        return $this->redirectToRoute('map_index');
    }
}
