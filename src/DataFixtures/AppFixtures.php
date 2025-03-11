<?php

namespace App\DataFixtures;

use App\Entity\Tache;
use App\Entity\Projet;
use App\Entity\Employe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $employes = $manager->getRepository(Employe::class)->findAll();
        $projets = $manager->getRepository(Projet::class)->findAll();
        $taches = $manager->getRepository(Tache::class)->findAll();

        foreach ($taches as $tache) {
            $employe = $employes[array_rand($employes)];
            $projet = $projets[array_rand($projets)];
            $tache->setEmploye($employe);
            $tache->setProjet($projet);
            $manager->persist($tache);

            $employe->addProjet($projet);
            $manager->persist($employe);

            $projet->addEmploye($employe);
            $projet->addTach($tache);
            $manager->persist($projet);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group2'];
    }
}
