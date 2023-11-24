<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Form\JeuType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[
        Route('/jeu/add', name: 'add_jeu'),
        Route('/jeu/edit/{id}', name: 'edit_jeu')
    ]
    public function add(ManagerRegistry $doctrine, Jeu $jeu = null, Request $request): Response
    {

        if (!$jeu) {
            $jeu = new Jeu();
        }

        $form = $this->createForm(JeuType::class, $jeu); // crée mon formulaire à partir du builder EntrepriseType
        $form->handleRequest($request); // quand une action est effectué sur le formulaire, récupère les données

        if ($form->isSubmitted() && $form->isValid()) { // is valid = sécurité des champs

            $jeu = $form->getData(); // récupère les données du formulaire et les envoie dans entreprise
            //vers la bdd

            $entityManager = $doctrine->getManager();
            $entityManager->persist($jeu); // constituer l'objet / prepare
            $entityManager->flush(); // ajout en bdd / insert into 

            return $this->redirectToRoute('app_jeu');
        }

        // vue pour formulaire
        return $this->render('jeu/add.html.twig', [
            'formAddJeu' => $form->createView(),
            'edit' => $jeu->getId(), //important pour verifier si employe existe et mettre une condition sur la view
        ]);
    }
}
