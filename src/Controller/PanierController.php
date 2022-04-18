<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Repository\UserRepository;
use App\Repository\PanierRepository;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function listeChoixPanier(PanierRepository $repo1, VoyageRepository $repo2, UserRepository $repo3, Request $req, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $panier = $repo1->findOneBy(['user' => $user], ['id' => 'DESC']);
        $idVoyageChoix = $req->get('id');

        if(($panier == null) && ($idVoyageChoix !== null)):
            $infoVoyageChoix = $repo2->findOneById($idVoyageChoix);
            $panier = new Panier;
            $panier->addVoyage($infoVoyageChoix);
            $panier->setUser($user);
            $infoVoyageChoix->setActive(false);
            $em->persist($panier);
            $em->flush();
        elseif(($panier !== null) && ($idVoyageChoix !== null)):
            $infoVoyageChoix = $repo2->findOneById($idVoyageChoix);
            $panier->addVoyage($infoVoyageChoix);
            $panier->setUser($user);
            $infoVoyageChoix->setActive(false);
            $PanierListeChoixVoyage = $repo1->findOneBy(['user' => $user]);
            $listeChoixVoyage = $panier->getVoyage($PanierListeChoixVoyage);
            $tableauPrixTotal=[];
            foreach($listeChoixVoyage as $key => $voyage):
                $prixVoyage = $voyage->getPrix();
                array_push($tableauPrixTotal, $prixVoyage);
            endforeach;
            $totalPrix = array_sum($tableauPrixTotal);
            $panier->setPrixTotal($totalPrix);

            $em->persist($panier);
            $em->flush();
        endif;

        $PanierListeChoixVoyage = $repo1->findOneBy(['user' => $user]);
        $panier->getVoyage($PanierListeChoixVoyage);
        if($panier == null || $panier->getPrixTotal() == 0.00):
             return $this->redirectToRoute('panierVide');
        endif;

        return $this->render('panier/panier.html.twig', [
            'panier' => $panier,
        ]);  
    }
    
    #[Route('/panierVide', name: 'panierVide')]
    public function panierVide(): Response
    {
        return $this->render('panier/panierVide.html.twig', [   
        ]);
    }

    #[Route('/accueil/supprimerVoyagePanier', name: 'supprimerVoyagePanier')]
    public function supprimerUnVoyageDuPanier(PanierRepository $repo1, VoyageRepository $repo2, EntityManagerInterface $em, Request $req)
    {
        $user = $this->getUser();
        $panier = $repo1->findOneBy(['user' => $user], ['id' => 'DESC']);
        $idVoyageChoixSupprimer = $req->get('id');
        $infoVoyageChoixSupprimer = $repo2->findOneById($idVoyageChoixSupprimer);
        $panier->removeVoyage($infoVoyageChoixSupprimer);
        $infoVoyageChoixSupprimer->setActive(true);

        $PanierListeChoixVoyage = $repo1->findOneBy(['user' => $user]);
        $listeChoixVoyage = $panier->getVoyage($PanierListeChoixVoyage);
        $tableauPrixTotal=[];
        foreach($listeChoixVoyage as $key => $voyage):
            $prixVoyage = $voyage->getPrix();
            array_push($tableauPrixTotal, $prixVoyage);
        endforeach;
        $totalPrix = array_sum($tableauPrixTotal);
        $panier->setPrixTotal($totalPrix);

        $em->persist($panier);
        $em->flush();
        if($totalPrix == 0.00):
            return $this->redirectToRoute('panierVide');
        endif;
        return $this->redirectToRoute('app_panier');
    }
}