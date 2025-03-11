<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProjetFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 3; $i++) {
            $projet = new Projet();
            $projet->setTitre($faker->company);
            $projet->setArchiver(false); 
            $manager->persist($projet);

        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
