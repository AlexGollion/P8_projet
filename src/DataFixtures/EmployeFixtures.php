<?php

namespace App\DataFixtures;

use App\Entity\Employe;
use App\Enum\EmployeStatut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EmployeFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 4; $i++) {
            $employe = new Employe();
            $employe->setNom($faker->lastName);
            $employe->setPrenom($faker->firstName);
            $employe->setEmail($faker->email);
            $employe->setDateEntre($faker->dateTimeBetween('-10 years', 'now'));
            $j = rand(1, 3);
            switch ($j) {
                case 1:
                    $employe->setStatut(EmployeStatut::cdd);
                    break;
                case 2: 
                    $employe->setStatut(EmployeStatut::cdi);
                    break;
                case 3:
                    $employe->setStatut(EmployeStatut::freelance);
                    break;
            }
            $manager->persist($employe);
        } 


        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
