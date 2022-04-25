<?php

namespace App\Controller;

use App\Repository\VoyageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function mex1(VoyageRepository $repository, Request $req): Response
    {
        $idVoyageChoisi = $req->get('id');

        $idVoyageChoisi = $repository->findOneById($idVoyageChoisi);

        return $this->render('article/article.html.twig', [
            'idVoyageChoisi' => $idVoyageChoisi
        ]);
    }
}
