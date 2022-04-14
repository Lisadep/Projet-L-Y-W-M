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
        $voyages = $repository->findby(["active" => 1]); {
            return $this->render('accueil/accueil.html.twig', [
                'voyages' => $voyages,
            ]);
        }
    }
}
