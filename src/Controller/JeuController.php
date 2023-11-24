<?php

namespace App\Controller;

use App\Entity\Jeu;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuController extends AbstractController
{
    #[Route('/jeu', name: 'app_jeu')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $jeux = $doctrine->getRepository(Jeu::class)->findBy([], ["Titre" => "ASC"]);

        return $this->render('jeu/index.html.twig', [
            'jeux' => $jeux,
        ]);
    }
}
