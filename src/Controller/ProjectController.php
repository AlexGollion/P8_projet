<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use App\Repository\EmployeeRepository;

final class ProjectController extends AbstractController
{

    public function __construct(private ProjectRepository $projectRepository, private TaskRepository $taskRepository, private EmployeeRepository $employeeRepository) {
    }

    #[Route('/project/{id}', name: 'app_project_affichage', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function index(int $id): Response
    {

        $project = $this->projectRepository->find($id);
        $tasks = $this->taskRepository->findBy(['project' => $project]);

        return $this->render('project/project.html.twig', [
            'controller_name' => 'ProjectController',
            'project' => $project,
            'tasks' => $tasks,
        ]);
    }
    
    #[Route('/project/edit/{id}', name: 'app_project_update_page', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function update_page(int $id): Response
    {

        $project = $this->projectRepository->find($id);

        return $this->render('project/update.html.twig', [
            'controller_name' => 'ProjectController',
            'project' => $project,
        ]);
    }
}
