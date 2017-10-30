<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/trainers")
     */
    public function trainerListAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:User');

        return $this->render('default/trainers.html.twig', [
            'items' => $repo->findBy(['enabled' => true])
        ]);
    }

    /**
     * @Route("/trainingen")
     */
    public function trainingListAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Training');

        return $this->render('default/trainings.html.twig', [
            'items' => $repo->findBy([])
        ]);
    }

    /**
     * @Route("/trainers/{slug}")
     */
    public function trainerdetailAction(Request $request, $slug)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:User');

        return $this->render('default/trainer_detail.html.twig', [
            'item' => $repo->findOneBy(['enabled' => true, 'slug' => $slug])
        ]);
    }

    /**
     * @Route("/trainingen/{slug}")
     */
    public function trainingdetailAction(Request $request, $slug)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Training');

        return $this->render('default/training_detail.html.twig', [
            'item' => $repo->findOneBy(['slug' => $slug])
        ]);
    }

    /**
     * @Route("/trainers/{slug}/bewerken")
     */
    public function editProfileAction(Request $request, $slug)
    {
        /* Haalt user repository op */
        $repo = $this->getDoctrine()->getRepository('AppBundle:User');

        return $this->render('default/edit_profile.html.twig', [
            /* Haalt een user uit de database. Als gebruiker enabled is, geef slug */
            'item' => $repo->findOneBy(['enabled' => true, 'slug' => $slug])
        ]);
    }

    /**
     * @Route("/over-ons")
     */
    public function overOnsAction()
    {
        return $this->render('default/over_ons.html.twig');
    }


    /**
     * @Route("/zoekresultaten")
     */
    public function searchResultsPageListAction(Request $request)
    {
        $TrainingRepo = $this->getDoctrine()->getRepository('AppBundle:Training');
        $UserRepo = $this->getDoctrine()->getRepository('AppBundle:User');

        return $this->render('default/searchresults.html.twig', [
            'trainingItem' => $TrainingRepo->findBy([]),
            'userItem' => $UserRepo->findBy([]),

            // Haal alle users op uit de database en stop ze in een array / lijst
            'users' => $UserRepo->findAll(),
            // Haal alle actieve users op als lijst
            'activeUsers' => $UserRepo->findBy(['enabled' => true]),
            // Haal de 1e actieve user in de database op
            'firstActiveUser' => $UserRepo->findOneBy(['enabled' => true]),
            // Haal user nummer 5 op
            // 'userFive' => $UaserRepo->find(5)
        ]);

    }


    /**
     * @Route("/mijn-trainingen")
     */
    public function myTrainingsListAction(Request $request)
    {
        $TrainingRepo = $this->getDoctrine()->getRepository('AppBundle:Training');
        $UserRepo = $this->getDoctrine()->getRepository('AppBundle:User');

        return $this->render('default/my_trainings.html.twig', [
            'trainingItem' => $TrainingRepo->findBy([]),
            'userItem' => $UserRepo->findBy([]),

            // Haal alle users op uit de database en stop ze in een array / lijst
            'users' => $UserRepo->findAll(),
            // Haal alle actieve users op als lijst
            'activeUsers' => $UserRepo->findBy(['enabled' => true]),
            // Haal de 1e actieve user in de database op
            'firstActiveUser' => $UserRepo->findOneBy(['enabled' => true]),
            // Haal user nummer 5 op
            // 'userFive' => $UaserRepo->find(5)
        ]);

    }



}
