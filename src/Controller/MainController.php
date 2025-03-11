<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Projet;
use App\Repository\ProjetRepository;

final class MainController extends AbstractController
{

    public function __construct(private ProjetRepository $projetRepository) {
    }

    #[Route('/', name: 'app_main_home')]
    public function index(): Response
    {
        $projets = $this->projetRepository->findAll();

        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
            'projets' => $projets,
        ]);
    }
}
