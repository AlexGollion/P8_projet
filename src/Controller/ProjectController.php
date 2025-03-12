<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use App\Repository\EmployeeRepository;
use App\Form\ProjectType;
use Symfony\Component\HttpFoundation\Request;


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
            'project' => $project,
            'tasks' => $tasks,
        ]);
    }
    
    #[Route('/project/edit/{id}', name: 'app_project_update_page', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function update_page(Request $request, int $id, EntityManagerInterface $manager): Response
    {

        $project = $this->projectRepository->find($id);
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            foreach($formData->getEmployees() as $employee)
            {
                $employeeProjects = $employee->getProject();
                if(!($employeeProjects->contains($project)))
                {
                    $employee->addProject($project);
                }
            }
            $manager->flush();
            
            return $this->redirectToRoute('app_project_affichage', ['id' => $project->getId()]);
        }

        return $this->render('project/update.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }
}
