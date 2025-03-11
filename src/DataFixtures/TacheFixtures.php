<?php

namespace App\DataFixtures;

use App\Entity\Tache;
use App\Enum\TacheStatut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class TacheFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 9; $i++) {
            $tache = new Tache();
            $tache->setTitre($faker->company);
            $tache->setDescription($faker->text);
            $tache->setDate(new \DateTime());
            $j = rand(1, 3);
            switch ($j) {
                case 1:
                    $tache->setStatut(TacheStatut::ToDo);
                    break;
                case 2: 
                    $tache->setStatut(TacheStatut::Doing);
                    break;
                case 3:
                    $tache->setStatut(TacheStatut::Done);
                    break;
            }
            $manager->persist($tache);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
