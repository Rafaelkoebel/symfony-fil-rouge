<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    #[Route('/infos', name: 'app_infos')]
    public function infos(): Response
    {
        return $this->render('page/infos.html.twig', [
            'controller_name' => 'InfosController',
        ]);
    }

    #[Route('/minuteur', name: 'app_minuteur')]
    public function minuteur(): Response
    {
        return $this->render('page/minuteur.html.twig', [
            'controller_name' => 'MinuteurController',
        ]);
    }

    #[Route('/recette', name: 'app_recette')]
    public function recette(): Response
    {
        return $this->render('page/recette.html.twig', [
            'controller_name' => 'RecetteController',
        ]);
    }

    #[Route('/saisons', name: 'app_saisons')]
    public function saisons(): Response
    {
        return $this->render('page/saisons.html.twig', [
            'controller_name' => 'SaisonsController',
        ]);
    }

}
