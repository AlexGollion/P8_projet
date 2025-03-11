<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Enum\TaskStatut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class TaskFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 9; $i++) {
            $task = new Task();
            $task->setTitle($faker->company);
            $task->setDescription($faker->text);
            $task->setDate(new \DateTime());
            $j = rand(1, 3);
            switch ($j) {
                case 1:
                    $task->setStatut(TaskStatut::ToDo);
                    break;
                case 2: 
                    $task->setStatut(TaskStatut::Doing);
                    break;
                case 3:
                    $task->setStatut(TaskStatut::Done);
                    break;
            }
            $manager->persist($task);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
