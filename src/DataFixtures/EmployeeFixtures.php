<?php

namespace App\DataFixtures;

use App\Entity\employee;
use App\Enum\employeeStatut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EmployeeFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 4; $i++) {
            $employee = new Employee();
            $employee->setName($faker->lastName);
            $employee->setFirst_name($faker->firstName);
            $employee->setEmail($faker->email);
            $employee->setDate($faker->dateTimeBetween('-10 years', 'now'));
            $j = rand(1, 3);
            switch ($j) {
                case 1:
                    $employee->setStatut(EmployeeStatut::cdd);
                    break;
                case 2: 
                    $employee->setStatut(EmployeeStatut::cdi);
                    break;
                case 3:
                    $employee->setStatut(EmployeeStatut::freelance);
                    break;
            }
            $manager->persist($employee);
        } 


        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
