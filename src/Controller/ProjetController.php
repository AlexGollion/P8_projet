<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Projet;
use App\Repository\ProjetRepository;
use App\Repository\TacheRepository;
use App\Repository\EmployeRepository;

final class ProjetController extends AbstractController
{

    public function __construct(private ProjetRepository $projetRepository, private TacheRepository $tacheRepository, private EmployeRepository $employeRepository) {
    }

    #[Route('/projet/{id}', name: 'app_projet_affichage', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function index(int $id): Response
    {

        $projet = $this->projetRepository->find($id);
        $taches = $this->tacheRepository->findBy(['projet' => $projet]);
        //$idEmploye = $taches[0]->getEmploye()->getId();
        //$employes = $this->employeRepository->findBy(['projet' => $projet]);

        return $this->render('projet/projet.html.twig', [
            'controller_name' => 'ProjetController',
            'projet' => $projet,
            'taches' => $taches,
        ]);
    }
    
    #[Route('/projet/edit/{id}', name: 'app_projet_update_page', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function update_page(int $id): Response
    {

        $projet = $this->projetRepository->find($id);

        return $this->render('projet/update.html.twig', [
            'controller_name' => 'ProjetController',
            'projet' => $projet,
        ]);
    }
}
