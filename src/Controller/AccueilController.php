<?php

namespace App\Controller;

use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/')]
    public function locaVoiture()
    {
        return $this->redirectToRoute('app_accueil');
    }

    #[Route('/accueil', name: 'app_accueil')]
    public function listeDesVoyages(VoyageRepository $repository): Response
    {
        $voyages1 = $repository->findby(["active" => 1, "pays" => "Mexique"]);

        $voyages2 = $repository->findby(["active" => 1, "pays" => "Etats-Unis"]);
            
        $voyages3 = $repository->findby(["active" => 1, "pays" => "Espagne/Majorque"]);

        return $this->render('accueil/accueil.html.twig', [

            'voyages1' => $voyages1,
            'voyages2' => $voyages2,
            'voyages3' => $voyages3,

        ]);
    }
}